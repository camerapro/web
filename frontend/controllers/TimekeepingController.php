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
		$params['from_time']= isset($params['TimekeepingSearch']['from_time'])?date("Y-m-d H:i",strtotime($params['TimekeepingSearch']['from_time'])):'';
		$params['to_time']= isset($params['TimekeepingSearch']['to_time'])?date("Y-m-d H:i",strtotime($params['TimekeepingSearch']['to_time'])):'';
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
    public function actionExport()
    {
		$searchModel = new TimekeepingSearch();
		$params = Yii::$app->request->queryParams;
		$params['deleted']=0;
		$params['from_time']= isset($params['TimekeepingSearch']['from_time'])?date("Y-m-d H:i",strtotime($params['TimekeepingSearch']['from_time'])):'';
		$params['to_time']= isset($params['TimekeepingSearch']['to_time'])?date("Y-m-d H:i",strtotime($params['TimekeepingSearch']['to_time'])):'';
		$params['deleted']=0;
        $dataProvider = $searchModel->search($params);
		$model = $dataProvider->getModels();
        \moonland\phpexcel\Excel::export([
			'models' => $model,
			 'fileName' => 'Timekeeping_export_'.date("Y-m-d_His"), 
			
				'columns' => [
						[
							'attribute' => 'staff_name',
							'header' => 'Tên nhân viên',
							'format' => 'raw',
							'headerOptions' => ['style'=>'text-align: center;width:150px'],
							'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
							'value' => function($data) {
				
								return isset($data->staff) ?$data->staff->name : null;
			   
							}
						 ],
						 [
							 'attribute' => 'phone',
							'header' => 'Điện thoại',
							'format' => 'raw',
							'options' => ['width' => '20px'],
							'headerOptions' => ['style'=>'text-align: center;'],
							'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
							'value' => function($data) {
				
								return isset($data->staff) ?$data->staff->phone : null;
			   
							}
						],

						[
							'attribute' => 'tat_name',
							'header' => 'Máy chấm công',
							'format' => 'raw',
							'options' => ['width' => '120px'],
							'headerOptions' => ['style'=>'text-align: center;'],
							'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
							'value' => function($data) {
								return ($data) ?
								  $data->tat->name:null; 
							}
						],
						[
							'attribute' => 'department_id',
							'header' => 'Phòng ban',
							'format' => 'raw',
							'filter' =>  yii\helpers\ArrayHelper::map(\frontend\models\DepartmentFrontend::findAll(['status' => 1]), 'id', 'name'),
							'options' => ['width' => '100px'],
							'contentOptions'=>['style'=>'text-align: center;'],
							'value' => function ($data) {
								$dep = \frontend\models\DepartmentFrontend::find()->where(['id' => $data->staff->department_id])->one();
								if (!empty($dep)) {
									return $dep->name;
								}
							},
							'headerOptions' => ['style' => 'text-align: center;'],
							'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;']
						],
				  
						[
							'attribute' => 'created_time',
							'header' => 'Thời gian',
							'format' => 'raw',
							'options' => ['width' => '120px'],
							'headerOptions' => ['style'=>'text-align: center;'],
							'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
							'value' => function($data) {
								return date("H:i:s d-m-Y",strtotime($data->created_time));
							}
						],   
						[
							'attribute' => 'type',
							'header' => 'Kiểu',
							'format' => 'raw',
							'options' => ['width' => '120px'],
							'headerOptions' => ['style'=>'text-align: center;'],
							'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
							'value' => function($data) {
								return $data->type;
							}
						],            [
							'header' => 'Trạng thái',
							'format' => 'raw',
							'options' => ['width' => '100px'],
							'headerOptions' => ['style'=>'text-align: center;'],
							'contentOptions'=>['style'=>'text-align: center; vertical-align:middle;'],
							'value' => function($data) {
								if($data->status ==1 )
								$status ='Đúng';
								if($data->status ==0 )
								$status ='Chưa xác nhận';
								if($data->status ==3 )
								$status ='Sai';
								return $status;
							}
						],
						
				],
				'headers' => [
					'created_at' => 'Test',
				],
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
        $params['from_time']= isset($params['TimekeepingSearch']['from_time'])?date("Y-m-d H:i",strtotime($params['TimekeepingSearch']['from_time'])):'';
        $params['to_time']= isset($params['TimekeepingSearch']['to_time'])?date("Y-m-d H:i",strtotime($params['TimekeepingSearch']['to_time'])):'';

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
     * Displays a single TimekeepingFrontend model.
     * @param integer $id
     * @return mixed
     */
    public function actionPopupConfirm($id =0)
    {
        $this->layout =false;
        $staff_timekeeping = \common\models\Timekeeping::searchData(0,0,0,0,0,0,0,0,$id);
        $staff_model = [];
        if($staff_timekeeping){
            foreach ($staff_timekeeping as $staff)
            {
                $staff_model = $staff;
                break;
            }
        }

        return $this->render('popupconfirm', [
            'model' =>$staff_model,
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
