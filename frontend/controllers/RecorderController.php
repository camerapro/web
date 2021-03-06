<?php

namespace frontend\controllers;

use frontend\models\FrontendCamera;
use Yii;
use frontend\models\FrontendRecorder;
use frontend\models\RecorderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RecorderController implements the CRUD actions for FrontendRecorder model.
 */
class RecorderController extends Controller
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
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all FrontendRecorder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecorderSearch();
        if(Yii::$app->user->identity->level < 4){
            $searchModel->user_id = Yii::$app->user->identity->id;
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FrontendRecorder model.
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
     * Creates a new FrontendRecorder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FrontendRecorder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FrontendRecorder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = false;
        $model = $this->findModel($id);
        if(Yii::$app->user->identity->level <3){
            $model->ip = '';
            $model->username = '';
            $model->password = '';
        }
        return $this->render('update_popup',  ['model'=>$model]);
    }

    /**
     * Deletes an existing FrontendRecorder model.
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
     * Finds the FrontendRecorder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FrontendRecorder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FrontendRecorder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionNew(){
        $this->layout = false;
        return $this->render('new');
    }

    public function actionSetcam($id)
    {
        $this->layout = false;
        $model = $this->findModel($id);
        if(Yii::$app->user->identity->level <3){
            $model->ip = '';
            $model->username = '';
            $model->password = '';
        }
        $cams  = FrontendCamera::getListCam($model->user_id, $id);
        return $this->render('setcam_popup',  ['model'=>$model, 'cams'=>$cams]);
    }

    public function actionDel($id){
        $this->layout = false;
        $model = $this->findModel($id);
        if(Yii::$app->user->identity->level <3){
            $model->ip = '';
            $model->username = '';
            $model->password = '';
        }
        $cams  = FrontendCamera::getListCam($model->user_id, $id);
        return $this->render('del_popup',  ['model'=>$model, 'cams'=>$cams]);
    }

}
