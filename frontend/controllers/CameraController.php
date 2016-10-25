<?php

namespace frontend\controllers;

use frontend\models\RelationsCamUser;
use Yii;
use frontend\models\Camera;
use frontend\models\search\CameraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CameraController implements the CRUD actions for Camera model.
 */
class CameraController extends Controller
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
        $cams = Camera::getListAllCam();
        return $this->render('index',[
            'cams'=>$cams,
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
        $model = new Camera();
        $model->created_time = date('Y-m-d H:i:s');
        $model->updated_time = date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->protocol == 'http')
                $model->streaming_url = $model->ip_address;
            elseif ($model->protocol == 'rtsp')
                $model->streaming_url = 'rtsp://' .$model->ip_address. ':' . $model->port . '/user=' . $model->encoder_username . '&password='. $model->encoder_password . '&channel=' . $model->channel . '&stream=1.sdp';
            if($model->save()){
                $user_id = Yii::$app->user->identity->id;
                $camera_user = new RelationsCamUser();
                $camera_user->user_id = $user_id;
                $camera_user->created_by_id = $user_id;
                $camera_user->created_by_name = Yii::$app->user->identity->username;
                $camera_user->created_time = date('Y-m-d H:i:s');
                $camera_user->cam_id = $model->id;
                $camera_user->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
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
            if($model->protocol == 'http')
                $model->streaming_url = $model->ip_address;
            elseif ($model->protocol == 'rtsp')
                $model->streaming_url = 'rtsp://' .$model->ip_address. ':' . $model->port . '/user=' . $model->encoder_username . '&password='. $model->encoder_password . '&channel=' . $model->channel . '&stream=1.sdp';
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
        if (($model = Camera::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
