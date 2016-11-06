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
		$tat = Tat::getTats($id,$user_id);
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

            if (isset($data['camera_main_ip'])) {
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

            }
            if (isset($data['camera_secondary_id'])) {
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
            }

            $tat_params = [
                'ip' => isset($data['ip']) ? $data['ip'] : '',
                'port'=>isset($data['port']) ? $data['ip'] : '',
                'category_id'=>isset($data['category_id']) ? $data['category_id'] : '',
                'protocol'=>isset($data['protocol']) ? $data['protocol'] : '',
                'description'=>isset($data['description']) ? $data['description'] : '',
                'order'=>isset($data['order']) ? $data['order'] : '',
                'user_id'=>isset($data['user_id']) ? $data['user_id'] : Yii::$app->user->identity->id,
                'agency_id'=>isset($data['agency_id']) ? $data['agency_id'] : 0,
                'camera_main_id'=>isset($camera_main_ip) ? $camera_main_ip : '',
                'camera_secondary_id'=>isset($camera_secondary_id) ? $camera_secondary_id : '',
                'created_time'=>date('Y-m-d H:i:s'),
                'updated_time'=>date('Y-m-d H:i:s')

            ];

            $save = Tat::add($tat_params);

            if ($save) {
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
        } else {
            $return = array(
                'error_code' => 1,
                'message' => 'Method not supported!'
            );
        }
        echo json_encode($return);
        exit;

    }

}
