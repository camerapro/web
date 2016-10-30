<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use api\components\ApiController;
/**
 * Site controller
 */
class TatController extends ApiController
{
	public $enableCsrfValidation = false;
	public $layout =false;
	public function init()
    {
        \Yii::$app->response->format = 'json';
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
       die("HELLO API");
    }

    public function actionGet()
    {
		 if (Yii::$app->user->isGuest) {
           return ['error_code'=>1,'message'=>'Not login'];
        }
        $cam_info = [];
        $message = '';
        $cam_id = isset(Yii::$app->request->get()['id']) ? Yii::$app->request->get()['id'] : '';
        $user_id = isset(Yii::$app->request->get()['user_id']) ? Yii::$app->request->get()['user_id'] : '';
        if(!empty($cam_id)){
            $cam_info = Camera::getOneCamById($cam_id);
            if(!$cam_info){
                return ['error_code'=>1,'message'=>'No permistion'];
            }
        }else{
            $cams = \frontend\models\Camera::getListCam($user_id);
            if(!empty($cams)){
                $cam_info = $cams;
				return ['error_code'=>0,'message'=>'Success','data'=>$cam_info];
            }
            if(empty($cam_info)){
                return ['error_code'=>401,'message'=>'Data empty','data'=>[]];
            }
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
            $camera->name = $data['name'];
            $camera->ip_address = $data['ip'];
            $camera->protocol = $data['protocol'];
            $camera->port = $data['port'];
            $camera->channel = $data['channel'];
            $camera->encoder_username = isset($data['username'])?$data['username']:'';
            $camera->encoder_password = isset($data['password'])?$data['password']:'';
            $camera->created_time = date('Y-m-d H:i:s');
            $camera->updated_time = date('Y-m-d H:i:s');
            $camera->user_id =isset($data['user_id'])?$data['user_id']:0;
			
            if($data['protocol'] == 'http')
                $camera->streaming_url = $data['ip'];
            elseif ($data['protocol'] == 'rtsp')
                $camera->streaming_url = 'rtsp://' .$data['ip']. ':' . $data['port'] . '/user=' . $data['username'] . '&password='.$data['password'] . '&channel=' . $data['channel'] . '&stream=1.sdp';
            $save = $camera->save(false);
            if($save){
                $camera_user = new RelationsCamUser();
                $camera_user->cam_id = $camera->id;
                $camera_user->created_by_id = Yii::$app->user->identity->id;
                $camera_user->user_id = Yii::$app->user->identity->id;
                $camera_user->created_by_name = Yii::$app->user->identity->username;
                $camera_user->created_time = date('Y-m-d H:i:s');
                $camera_user->save();
                $return = array(
                    'error_code'=>0,
                    'message'=>'Success'
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

}
