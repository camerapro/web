<?php

namespace frontend\controllers;

use common\components\Common;
use common\components\FrontendController;
use frontend\models\RelationsCamUser;
use Yii;
use frontend\models\FrontendCamera;
use frontend\models\search\CameraSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CameraController implements the CRUD actions for Camera model.
 */
class CameraController extends FrontendController
{
    /**
     * @inheritdoc
     */
    /*public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/

    /**
     * Lists all Camera models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$searchModel = new CameraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
        //$cams = Camera::getListAllCam();
        //set defaul for user demo
        /*if(Yii::$app->user->identity->username == 'demo'){
            $cams = Camera::find()
                -> leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
                ->where(['=', 'relations_cam_user.user_id', Yii::$app->user->identity->id])
                ->andWhere(['=', 'relations_cam_user.owner', 1])
                ->all();
        }*/
        if(Yii::$app->user->identity->level ==4){
            $query = FrontendCamera::find();
        }else{
            $query = FrontendCamera::find()
                -> leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
                ->where(['=', 'relations_cam_user.user_id', Yii::$app->user->identity->id]);
            if(Yii::$app->user->identity->username == 'demo'){
                $query->andWhere(['=', 'relations_cam_user.owner', 1]);
            }
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single Camera model.
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
     * Creates a new Camera model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FrontendCamera();
        $model->created_time = date('Y-m-d H:i:s');
        $model->updated_time = date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->streaming_url = Common::getLinkStream($model->id);
            if($model->save()){
                $user_id = Yii::$app->user->identity->id;
                $camera_user = new RelationsCamUser();
                $camera_user->user_id = $user_id;
                $camera_user->created_by_id = $user_id;
                $camera_user->created_by_name = Yii::$app->user->identity->username;
                $camera_user->created_time = date('Y-m-d H:i:s');
                $camera_user->owner = 1;
                $camera_user->cam_id = $model->id;
                $camera_user->save();
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Camera model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_time = date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->streaming_url = Common::getLinkStream($model->id);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Camera model.
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
     * Finds the Camera model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Camera the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FrontendCamera::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
