<?php

namespace frontend\controllers;

use common\components\FrontendController;
use Yii;
use frontend\models\TimekeepingFrontend;
use frontend\models\search\TimekeepingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TimekeepingController implements the CRUD actions for TimekeepingFrontend model.
 */
class TimekeepingController extends FrontendController
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
     * Lists all TimekeepingFrontend models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TimekeepingSearch();
		$params = Yii::$app->request->queryParams;
		$params['deleted']=0;
		$params['from_time']= isset($params['TimekeepingSearch']['from_time'])?$params['TimekeepingSearch']['from_time']:'';
		$params['to_time']= isset($params['TimekeepingSearch']['to_time'])?$params['TimekeepingSearch']['to_time']:'';
		$params['deleted']=0;
        $dataProvider = $searchModel->search($params);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
 /**
     * Lists all TimekeepingFrontend models.
     * @return mixed
     */
    public function actionRestore()
    {
        $searchModel = new TimekeepingSearch();
		$params = Yii::$app->request->queryParams;
		$params['deleted']=1;
		$params['from_time']= isset($params['TimekeepingSearch']['from_time'])?$params['TimekeepingSearch']['from_time']:'';
		$params['to_time']= isset($params['TimekeepingSearch']['to_time'])?$params['TimekeepingSearch']['to_time']:'';
        $dataProvider = $searchModel->search($params);

        return $this->render('restore', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionAutoConfirm()
    {
		
        $this->verifyAjax();
		if ($data = Yii::$app->request->post()) {
			$ids = Yii::$app->request->post()['ids'];
			$status = Yii::$app->request->post()['status'];
			$condition =['in', 'id', $ids];
			if($status ==0)
				$status =3;
			TimekeepingFrontend::updateAll([
				'status' =>$status,
			], $condition);
			echo json_encode(['error'=>0,'message'=>'Xử lý thành công']);
			exit();
		}
		echo json_encode(['error'=>1,'message'=>'Xử lý thất bại']);
		exit();
		
		
		
    }
	public function actionManualConfirm()
    {
		
        $this->verifyAjax();
		if ($data = Yii::$app->request->post()) {
			$ids = Yii::$app->request->post()['ids'];
			$status = Yii::$app->request->post()['status'];
			$condition =['in', 'id', $ids];
			if($status ==0)
				$status =3;
			TimekeepingFrontend::updateAll([
				'status' =>$status,
			], $condition);
			echo json_encode(['error'=>0,'message'=>'Xử lý thành công']);
			exit();
		}
		echo json_encode(['error'=>1,'message'=>'Xử lý thất bại']);
		exit();	
    }
	public function actionDeleteMulti()
    {
		
        $this->verifyAjax();
		if ($data = Yii::$app->request->post()) {
			$ids = Yii::$app->request->post()['ids'];
			$status =1;
			$condition =['in', 'id', $ids];
			TimekeepingFrontend::updateAll([
				'deleted' =>$status,
			], $condition);
			echo json_encode(['error'=>0,'message'=>'Xử lý thành công']);
			exit();
		}
		echo json_encode(['error'=>1,'message'=>'Xử lý thất bại']);
		exit();	
    }
	public function actionRestoreConfirm()
    {
		
        $this->verifyAjax();
		if ($data = Yii::$app->request->post()) {
			$ids = Yii::$app->request->post()['ids'];
			$status = Yii::$app->request->post()['status'];
			$condition =['in', 'id', $ids];
			TimekeepingFrontend::updateAll([
				'deleted' =>$status,
			], $condition);
			echo json_encode(['error'=>0,'message'=>'Xử lý thành công']);
			exit();
		}
		echo json_encode(['error'=>1,'message'=>'Xử lý thất bại']);
		exit();
		
		
		
    }
	private function verifyAjax(){
        if(Yii::$app->request->isAjax){
			$this->layout = false;
            return true;
        }
		return false;
    }
    /**
     * Displays a single TimekeepingFrontend model.
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
     * Creates a new TimekeepingFrontend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TimekeepingFrontend();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TimekeepingFrontend model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TimekeepingFrontend model.
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
     * Finds the TimekeepingFrontend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TimekeepingFrontend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TimekeepingFrontend::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
