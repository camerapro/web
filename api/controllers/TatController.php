<?php
namespace api\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use api\components\ApiController;
use common\models\Tat;
use common\models\Camera;
use common\models\CameraType;

/**
 * Site controller
 */
class TatController extends ApiController
{
    public $enableCsrfValidation = false;
    public $layout = false;

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
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        $tat = [];
        $message = '';
        $id = isset(Yii::$app->request->get()['id']) ? Yii::$app->request->get()['id'] : '';
        $user_id = isset(Yii::$app->request->get()['user_id']) ? Yii::$app->request->get()['user_id'] : '';
        $company_id = isset(Yii::$app->request->get()['company_id']) ? Yii::$app->request->get()['company_id'] : '';
		$tat = Tat::getTats($id,$user_id,$company_id);
		if (!empty($tat)) {
			return ['error_code' => 0, 'message' => 'Success', 'data' => $tat];
		}
		if (empty($tat)) {
			return ['error_code' => 401, 'message' => 'Data empty', 'data' => []];
		}
    }

    public function actionAdd()
    {
        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        if ($data = Yii::$app->request->post()) {

           /* if (isset($data['camera_main_ip'])) {
                $cam_params = [
                    'name' => isset($data['name_main'])? $data['name_main'] : '',
                    'encoder_name'=>isset($data['cam_main_name']) ? $data['cam_main_name'] : '',
                    'category_id'=>isset($data['category_main_id']) ? $data['category_main_id'] : '',
                    'ip_address'=>isset($data['camera_main_ip']) ? $data['camera_main_ip'] : '',
                    'port'=>isset($data['port_main']) ? $data['port_main'] : '',
                    'channel'=>isset($data['channel_main']) ? $data['channel_main'] : '',
                    'protocol'=>isset($data['protocol_main']) ? $data['protocol_main'] : '',
                    'order'=>isset($data['order_main']) ? $data['order_main'] : 0,
                    'user_id'=>isset($data['user_id']) ? $data['user_id'] : Yii::$app->user->identity->id,
                    'agency_id'=>isset($data['agency_id']) ? $data['agency_id'] : 0,
                 ];
                $cam = \common\models\Camera::add($cam_params);
                if ($cam)
                    $camera_main_ip = $cam->id;

            }*/
          /*  if (isset($data['camera_secondary_id'])) {
                $cam_params = [
                    'name' => isset($data['name']) ? $data['name'] : '',
                     'encoder_name'=>isset($data['cam_2nd_name']) ? $data['cam_2nd_name'] : '',
                    'category_id'=>isset($data['category_2nd_id']) ? $data['category_2nd_id'] : '',
                    'ip_address'=>isset($data['camera_main_ip']) ? $data['camera_2nd_ip'] : '',
                    'port'=>isset($data['port_main']) ? $data['port_2nd'] : '',
                    'channel'=>isset($data['channel_2nd']) ? $data['channel_2nd'] : '',
                    'protocol'=>isset($data['protocol_2nd']) ? $data['protocol_2nd'] : '',
                    'order'=>isset($data['order_2nd']) ? $data['order_2nd'] : 0,
                    'user_id'=>isset($data['user_id']) ? $data['user_id'] : Yii::$app->user->identity->id,
                    'agency_id'=>isset($data['agency_id']) ? $data['agency_id'] : 0
                 ];
                 $cam = \common\models\Camera::add($cam_params);
                if ($cam)
                    $camera_secondary_id = $cam->id;
            }*/

            $tat_params = [
				'name' => isset($data['name']) ? $data['name'] : '',
                'ip' => isset($data['ip']) ? $data['ip'] : '',
                'port'=>isset($data['port']) ? $data['port'] : '',
                'category_id'=>isset($data['category_id']) ? $data['category_id'] : '',
                'protocol'=>isset($data['protocol']) ? $data['protocol'] : '',
                'description'=>isset($data['description']) ? $data['description'] : '',
                'order'=>isset($data['order']) ? $data['order'] : '',
                'user_id'=>isset($data['user_id']) ? $data['user_id'] : Yii::$app->user->identity->id,
                'status'=>isset($data['status']) ? $data['status'] : 0,
                'camera_ip'=>isset($data['camera_ip']) ? $data['camera_ip'] : '',
                'camera_port'=>isset($data['camera_port']) ? $data['camera_port'] : '',
                'camera_channel'=>isset($data['camera_channel']) ? $data['camera_channel'] : '',
                'camera_username'=>isset($data['camera_username']) ? $data['camera_username'] : '',
                'camera_password'=>isset($data['camera_password']) ? $data['camera_password'] : '',
                'camera_model'=>isset($data['camera_model']) ? $data['camera_model'] : '',
                'expired_time'=>isset($data['expired_time']) ? $data['expired_time'] : '',
                'company'=>isset($data['company_id']) ? $data['company_id'] : '',
                'created_time'=>date('Y-m-d H:i:s'),
                'updated_time'=>date('Y-m-d H:i:s')

            ];
            $save = Tat::add($tat_params);

            if ($save) {
				$cam_type = CameraType::find()->where(['name'=>$tat_params['camera_model']])->one();
				if(!$cam_type){
					   $type_params = [
							'name' => isset($data['camera_model']) ? $data['camera_model'] : '',
							'description' => isset($data['description']) ? $data['description'] : ''
						];
					 CameraType::add($type_params);
				}
                $return = array(
                    'error_code' => 0,
                    'message' => 'Success',
					'tat_id'=>$save->id
                );
            } else {
                $return = array(
                    'error_code' => 1,
                    'message' => 'Add fail'
                );
            }
        } else {
            $return = array(
                'error_code' => 1,
                'message' => 'Method not supported!'
            );
        }
        echo json_encode($return);
        exit;

    }
	 public function actionUpdate()
    {
        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        if ($data = Yii::$app->request->post()) {
			$id = isset($data['id']) ? $data['id'] : 0;
			$tat = Tat::findOne(['id'=>$id]);
			if($tat){
				$cam_type = false;
				$tat->name =  isset($data['name']) ? $data['name'] : $tat->name ;
				$tat->ip=  isset($data['ip']) ? $data['ip'] : $tat->ip;
				$tat->port= isset($data['port']) ? $data['port'] : $tat->port;
				$tat->category_id= isset($data['category_id']) ? $data['category_id'] : $tat->category_id;
				$tat->protocol= isset($data['protocol']) ? $data['protocol'] : $tat->protocol;
				$tat->description= isset($data['description']) ? $data['description'] : $tat->description;
				$tat->order= isset($data['order']) ? $data['order'] : $tat->order;
				$tat->user_id= isset($data['user_id']) ? $data['user_id'] : $tat->user_id;
				$tat->status= isset($data['status']) ? $data['status'] : $tat->status;
				$tat->camera_ip= isset($data['camera_ip']) ? $data['camera_ip'] : $tat->camera_ip;
				$tat->camera_port= isset($data['camera_port']) ? $data['camera_port'] : $tat->camera_port;
				$tat->camera_channel= isset($data['camera_channel']) ? $data['camera_channel'] : $tat->camera_channel;
				$tat->camera_username= isset($data['camera_username']) ? $data['camera_username'] : $tat->camera_username;
				$tat->camera_password= isset($data['camera_password']) ? $data['camera_password'] : $tat->camera_password;
				$tat->camera_model= isset($data['camera_model']) ? $data['camera_model'] : $tat->camera_model;
				$tat->expired_time= isset($data['expired_time']) ? $data['expired_time'] : $tat->expired_time;
				$tat->company = isset($data['company_id']) ? $data['company_id'] : $tat->company;
				$tat->updated_time= date('Y-m-d H:i:s');
				$save = $tat->save(false);
				 if ($save && $tat->camera_model) {
					$cam_type = CameraType::find()->where(['name'=>$tat->camera_model])->one();
				if(!$cam_type && $tat->camera_model){
					   $type_params = [
							'name' => isset($data['camera_model']) ? $data['camera_model'] : '',
							'description' => isset($data['description']) ? $data['description'] : ''
						];
					 CameraType::add($type_params);
				}
                $return = array(
                    'error_code' => 0,
                    'message' => 'Success'
                );
            } else {
                $return = array(
                    'error_code' => 1,
                    'message' => 'Add fail'
                );
            }
			}
			else{
				 $return = array(
                    'error_code' => 1,
                    'message' => 'Not found'
                );
			}
			

           
        } else {
            $return = array(
                'error_code' => 1,
                'message' => 'Method not supported!'
            );
        }
        echo json_encode($return);
        exit;

    }
	public function actionDelete()
    {
		$this->logger->LogInfo("actionDelete TAT data  :" .json_encode(Yii::$app->request->post()));
		 if (Yii::$app->user->isGuest) {
           return ['error_code'=>1,'message'=>'Not login'];
         }
       if ($data = Yii::$app->request->post()) {
             $id =    $data['id'];
			$tat = Tat::find()->where(['id'=>$id])->one();

			if($tat){
				 $tat->delete();
				 $return = array(
                    'error_code'=>0,
                    'message'=>'Deleted'
                );
			}else{
                $return = array(
                    'error_code'=>1,
                    'message'=>'Not found or no permission'
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
