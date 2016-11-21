<?php

namespace frontend\controllers;

use common\components\FrontendController;
use frontend\models\Permission;
use Yii;
use frontend\models\PermissionGroup;
use frontend\models\search\PermissionGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PerController implements the CRUD actions for PermissionGroup model.
 */
class PerController extends FrontendController
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
     * Lists all PermissionGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermissionGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(Yii::$app->user->identity->level <4){
            $dataProvider->query->orWhere(['id'=>Yii::$app->user->identity->permission_group_id])->orWhere(['created_by_id'=>Yii::$app->user->identity->id]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PermissionGroup model.
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
     * Creates a new PermissionGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PermissionGroup();
        $list_permission = Permission::getAll();
        if(Yii::$app->user->identity->level <4){
            //laylist permision cua user nay
            $permission_gr = Yii::$app->user->identity->permission_group_id;
            $list_permission_ids = PermissionGroup::findOne($permission_gr)->permission_ids;
            $list_permission = Permission::getAllByIds($list_permission_ids);
        }
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if ($model->load(Yii::$app->request->post())) {
            if(isset( Yii::$app->request->post()['permission'])){
                $permission = Yii::$app->request->post()['permission'];
                $item_ids = [];
                foreach ($permission as $items){
                    foreach ($items as $item) {
                        $item_ids [] = $item;
                    }
                }
                $permission_ids = implode(',', $item_ids);
                $model->permission_ids = $permission_ids;
                $model->created_time = date('Y-m-d H:i:s');
                $model->created_by_name = Yii::$app->user->identity->username;
                $model->created_by_id = Yii::$app->user->identity->id;
                $model->save();
                return $this->redirect(['index']);
            }

//            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'list_permission'=>$list_permission,
        ]);

    }

    /**
     * Updates an existing PermissionGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $list_permission = Permission::getAll();
        $list_permission_by_group = explode(',', $model->permission_ids);
        if(Yii::$app->user->identity->level <4){
            //laylist permision cua user nay
            $permission_gr = Yii::$app->user->identity->permission_group_id;
            $list_permission_ids = PermissionGroup::findOne($permission_gr)->permission_ids;
            $list_permission = Permission::getAllByIds($list_permission_ids);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $permission = Yii::$app->request->post()['permission'];
            $item_ids = [];
            foreach ($permission as $items){
                foreach ($items as $item) {
                    $item_ids [] = $item;
                }
            }
            $permission_ids = implode(',', $item_ids);
            $model->permission_ids = $permission_ids;
            $model->created_time = date('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'list_permission'=>$list_permission,
                'list_permission_by_group'=>$list_permission_by_group
            ]);
        }
    }

    /**
     * Deletes an existing PermissionGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PermissionGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PermissionGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PermissionGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
