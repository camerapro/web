<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use api\models\RelationsCamUser;
use api\models\Camera;
use api\components\ApiController;

/**
 * Site controller
 */
class RecorderController extends ApiController
{
	public $enableCsrfValidation = false;
	private $api_key ='43S4342342Asfd';
	public $layout =false;
	public function init()
    {
        \Yii::$app->response->format = 'json';
    }
    public function actionGet()
    {
		 if (Yii::$app->user->isGuest) {
           return ['error_code'=>1,'message'=>'Not login'];
        }
        $cam_info = [];
        $message = '';
        $id = isset(Yii::$app->request->get()['id']) ? Yii::$app->request->get()['id'] : '';
        $user_id = isset(Yii::$app->request->get()['user_id']) ? Yii::$app->request->get()['user_id'] : '';
        
		$cams = \common\models\Recorder::getRecorder($id,$user_id);
	
		if(!empty($cams)){
			$cam_info = $cams;
			return ['error_code'=>0,'message'=>'Success','data'=>$cam_info];
		}
		if(empty($cam_info)){
			return ['error_code'=>401,'message'=>'Data empty','data'=>[]];
		}
    }
    public function actionAdd()
    {
		 if (Yii::$app->user->isGuest) {
           return ['error_code'=>1,'message'=>'Not login'];
         }
          if($data = Yii::$app->request->post())
            {
            $camera = new Camera();
			if(!isset($data['cam_name']) )
				 return  array(
                    'error_code'=>1,
                    'message'=>'Parameters are missing'
                );
                // Recorder
                if(!isset($data['recorder_id']) || (int)$data['recorder_id'] ==0 ){
                    $recorder = new \common\models\Recorder();
                    $recorder->name = isset($data['recorder_name'])?$data['recorder_name']:'Undefined';
                    $recorder->ip = isset($data['ip'])?$data['ip']:'';
                    $recorder->category_id = isset($data['category_id'])?$data['category_id']:'';
                    $recorder->username = isset($data['username'])?$data['username']:'';
                    $recorder->password = isset($data['password'])?$data['password']:'';
                    $recorder->protocol = isset($data['protocol'])?$data['protocol']:'';
                    $recorder->port = isset($data['port'])?$data['port']:'';
                    $recorder->media_port = isset($data['media_port'])?$data['media_port']:'';
                    $recorder->params = isset($data['params'])?$data['params']:'';
                    $recorder->activation_time = isset($data['activationtime'])?$data['activationtime']:date('Y-m-d H:i:s');
                    $recorder->created_time = isset($data['created_time'])?$data['created_time']:date('Y-m-d H:i:s');
                    $recorder->order = isset($data['order'])?$data['order']:0;
                    $recorder->user_id = isset($data['user_id'])?$data['user_id']:Yii::$app->user->identity->id;
                    $recorder->agency_id = isset($data['agency_id'])?$data['agency_id']:0;
                    $recorder->model = isset($data['model'])?$data['model']:0;
                    if($recorder->save(false)){
                        $recorder_id = $recorder->id;
                    }
                }
                else{
					 $recorder_id = $data['recorder_id'];
					 $recorder = \common\models\Recorder::findOne($recorder_id);
				}
                   
            $camera->name = isset($data['cam_name'])?$data['cam_name']:$recorder->name;
            $camera->channel = $data['channel'];
            $camera->created_time = isset($data['activationtime'])?$data['activationtime']:date('Y-m-d H:i:s');
            $camera->updated_time = date('Y-m-d H:i:s');
            $camera->recorder_id =$recorder_id;
            $camera->activation_time = isset($data['activationtime'])?$data['activationtime']:date('Y-m-d H:i:s');
            if(  $recorder->protocol  == 'http')
                $camera->streaming_url = $recorder->ip;
            elseif ( $recorder->protocol  == 'rtsp')
                $camera->streaming_url = 'rtsp://' .$recorder->ip. ':' . $recorder->media_port . '/user=' .  $recorder->username . '&password='.$recorder->password . '&channel=' . $data['channel'] . '&stream=1.sdp';
            $save = $camera->save(false);
            if($save){
                $camera_user = new RelationsCamUser();
                $camera_user->cam_id = $camera->id;
                $camera_user->created_by_id =  $recorder->user_id;
                $camera_user->user_id =  $recorder->user_id;
                $camera_user->created_by_name = Yii::$app->user->identity->username;
                $camera_user->created_time = date('Y-m-d H:i:s');
                $camera_user->save();
                $return = array(
                    'error_code'=>0,
                    'message'=>'Success',
                    'data'=>['recorder_id'=>$recorder_id],
                );
            }else{
                $return = array(
                    'error_code'=>1,
                    'message'=>'Add fail'
                );
            }
		}else{
            $return = array(
                'error_code'=>1,
                'message'=>'Method not supported!'
            );
        }
        echo json_encode($return);
        exit;
        
    }
	public function actionDelete()
    {
		 if (Yii::$app->user->isGuest) {
           return ['error_code'=>1,'message'=>'Not login'];
         }
          if($data = Yii::$app->request->post())
          {
            $camera = new Camera();
			if(!isset($data['recorder_id']) )
				 return  array(
                    'error_code'=>1,
                    'message'=>'Parameters are missing'
                );
             $id =    $data['recorder_id'];
			$recorder = \common\models\Recorder::find()->where(['user_id'=>Yii::$app->user->identity->id,'id'=>$id])->one();

			if($recorder){
				 $recorder->delete();
				 $return = array(
                    'error_code'=>0,
                    'message'=>'Deleted'
                );
			}else{
                $return = array(
                    'error_code'=>1,
                    'message'=>'Recorder not found or no permission'
                );
            }
            
            
		}else{
            $return = array(
                'error_code'=>1,
                'message'=>'Method not supported!'
            );
        }
        echo json_encode($return);
        exit;
        
    }
	public function actionDeletecam()
    {
		 if (Yii::$app->user->isGuest) {  
		 
           return ['error_code'=>1,'message'=>'Not login'];
         }
          if($data = Yii::$app->request->post())
          {
			if(!isset($data['cam_id']) )
				 return  array(
                    'error_code'=>1,
                    'message'=>'Parameters are missing'
                );
             $id =    $data['cam_id'];
			$camera = \common\models\Camera::find()->where(['id'=>$id])->one();

			if($camera){
				 $camera->delete();
				 $return = array(
                    'error_code'=>0,
                    'message'=>'Deleted'
                );
			}else{
                $return = array(
                    'error_code'=>1,
                    'message'=>'Camera not found or no permission'
                );
            }
            
            
		}else{
            $return = array(
                'error_code'=>1,
                'message'=>'Method not supported!'
            );
        }
        echo json_encode($return);
        exit;
        
    }
	   /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
		if (Yii::$app->user->isGuest) {
           return ['error_code'=>1,'message'=>'Not login'];
         }
        if($data = Yii::$app->request->post())
        {
			$id =  $data['recorder_id'];
			$recorder = \common\models\Recorder::find()->where(['user_id'=>Yii::$app->user->identity->id,'id'=>$id])->one();
			if($recorder){
				 $recorder->name = isset($data['recorder_name'])?$data['recorder_name']:$recorder->name;
		
				$recorder->ip = isset($data['ip'])?$data['ip']:$recorder->ip;
				$recorder->category_id = isset($data['category_id'])?$data['category_id']:$recorder->category_id;
				$recorder->username = isset($data['username'])?$data['username']:$recorder->username;
				$recorder->password = isset($data['password'])?$data['password']:$recorder->password;
				$recorder->protocol = isset($data['protocol'])?$data['protocol']:$recorder->protocol;
				$recorder->port = isset($data['port'])?$data['port']:$recorder->port ;
				$recorder->media_port = isset($data['media_port'])?$data['media_port']:$recorder->media_port;
				$recorder->params = isset($data['params'])?$data['params']:$recorder->params;
				$recorder->activation_time = isset($data['activationtime'])?$data['activationtime']:$recorder->activation_time ;
				$recorder->created_time = isset($data['created_time'])?$data['created_time']:$recorder->created_time;
				$recorder->updated_time = date('Y-m-d H:i:s');
				$recorder->order = isset($data['order'])?$data['order']:$recorder->order;
				$recorder->agency_id = isset($data['agency_id'])?$data['agency_id']:$recorder->agency_id;
				$recorder->model = isset($data['model'])?$data['model']:$recorder->model;
				if($recorder->save(false)){
					$recorder_id = $recorder->id;
					$return = array(
						'error_code'=>0,
						'message'=>'Success',
						'data'=>['recorder_id'=>$recorder_id],
					);
				}
			}else{
                $return = array(
                    'error_code'=>1,
                    'message'=>'Recorder not found or no permission'
                );
            }
			
		      
		}else{
            $return = array(
                'error_code'=>1,
                'message'=>'Method not supported!'
            );
        }
        echo json_encode($return);
        exit;

    }
	   /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdatecam()
    {
		if (Yii::$app->user->isGuest) {
           return ['error_code'=>1,'message'=>'Not login'];
         }
        if($data = Yii::$app->request->post())
        {
			$id =  $data['cam_id'];
			$camera = \common\models\Camera::find()->where(['user_id'=>Yii::$app->user->identity->id,'id'=>$id])->one();
			if($camera){
				$camera->name = $data['cam_name'];
				$camera->channel = $data['channel'];
				$camera->updated_time = date('Y-m-d H:i:s');
				if($camera->save(false)){
					$camera_id = $camera->id;
					$return = array(
						'error_code'=>0,
						'message'=>'Success',
						'data'=>['camera_id'=>$camera_id],
					);
				}
			}else{
                $return = array(
                    'error_code'=>1,
                    'message'=>'Camera not found or not permission'
                );
            }
			
		      
		}else{
            $return = array(
                'error_code'=>1,
                'message'=>'Method not supported!'
            );
        }
        echo json_encode($return);
        exit;

    }
    
}
