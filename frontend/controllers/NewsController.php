<?php

namespace frontend\controllers;

use common\models\Menu;
use frontend\models\Permission;
use frontend\models\RelationsPermissionRule;
use Yii;
use frontend\models\News;
use frontend\models\search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
//        if ($model->load(Yii::$app->request->post()) ) {
            //tao phan menu
            $menu = new Menu();
            $menu->name = $model->title;
            $menu->parrent_id = 19;
            $menu->controller = 'guide';
            $menu->action = 'index';
            $menu->params = 'id=' . $model->id;
            $menu->created_time = date('Y-m-d H:i:s');
            $menu->created_by = Yii::$app->user->identity->id;
            $menu->status = 1;
            $menu->save(false);
            //tao quyen
            $permission = new Permission();
            $permission->name = $model->title;
            $permission->parent_id = '39';
            $permission->created_time = date('Y-m-d H:i:s');
            $permission->status = 1;
            $permission->save(false);
            //tao quyen rule
            $permission_rule = new RelationsPermissionRule();
            $permission_rule->permission_id = $permission->id;
            $permission_rule->controller_name = 'guide';
            $permission_rule->action_name = 'index';
            $permission_rule->params = 'id=' . $model->id;
            $permission_rule->save(false);

            return $this->redirect(['index']);
//            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $menu = Menu::findOne(['controller'=>'guide', 'action'=>'index', 'params'=>'id=' . $model->id]);
            $menu->name = $model->title;
            $menu->updated_time = date('Y-m-d H:i:s');
            $menu->updated_by = Yii::$app->user->identity->id;
            $menu->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        //xoa menu

        $menu = Menu::findOne(['controller'=>'guide', 'action'=>'index', 'params'=>'id=' . $id]);
        $menu->delete();

        //xoa rule
        $permission_rule = RelationsPermissionRule::findOne(['controller_name'=>'guide', 'action_name'=>'index', 'params'=>'id=' . $id]);
        $permission_id = $permission_rule->permission_id;
        $permission = Permission::deleteAll(['id'=>$permission_id]);
        $permission_rule->delete();


        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
