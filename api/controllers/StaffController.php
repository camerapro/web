<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Staff;

/**
 * Site controller
 */
class StaffController extends Controller
{
    public $enableCsrfValidation = false;
    private $api_key = '43S4342@342Asfd';
    public $layout = false;

    public function init()
    {
		$this->logger = new KLogger('api_' . date('Ymd'), KLogger::INFO);
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

    public function actionAdd()
    {
		$this->logger->LogInfo("actionAdd staff data  :" .json_encode(Yii::$app->request->post()));
		
        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        if ($data = Yii::$app->request->post()) {

            $params = [
                'name' => isset($data['name']) ? $data['name'] : '',
                'card_code' => isset($data['card_code']) ? $data['card_code'] : '',
                'card_id' => isset($data['card_id']) ? $data['card_id'] : '',
                'department' => isset($data['department']) ? $data['department'] : '',
                'image' => isset($data['image']) ? $data['image'] : '',
                'order' => isset($data['order']) ? $data['order'] : '',
                'created_by' => isset($data['user_id']) ? $data['user_id'] : Yii::$app->user->identity->id,
                'description' => isset($data['description']) ? $data['description'] : '',
                'created_time' => date('Y-m-d H:i:s'),
            ];
            $save = Staff::add($params);

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

    /**
     * @return array
     */
    public function actionInfo()
    {
		$this->logger->LogInfo("actionInfo staff data  :" .json_encode(Yii::$app->request->get()));
		
        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        $staff = [];
        $message = '';
        $id = isset(Yii::$app->request->get()['id']) ? Yii::$app->request->get()['id'] : '';
        $card_code = isset(Yii::$app->request->get()['card_code']) ? Yii::$app->request->get()['card_code'] : '';
        $staff = Staff::find()->where(['and', ['id' => $id]])
            ->orWhere(['card_code' => $card_code])->one();
        if ($staff)
            $staff->image = 'http://api.thietbianninh.com/kute.jpg';
        return ['error_code' => 0, 'message' => 'Success', 'data' => $staff];

    }

    /**
     * @return array
     */
    public function actionGet()
    {
        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        $staff = [];
        $message = '';
        $id = isset(Yii::$app->request->get()['id']) ? Yii::$app->request->get()['id'] : '';
        $user_id = isset(Yii::$app->request->get()['user_id']) ? Yii::$app->request->get()['user_id'] : '';
        if (!empty($id)) {
            $staff = Staff::findOne(['id' => $id]);
            if ($staff)
                $staff->image = 'http://api.thietbianninh.com/kute.jpg';
            return ['error_code' => 0, 'message' => 'Success', 'data' => $staff];
        } elseif (!empty($user_id)) {
            $staff = Staff::getStaffByUserId(['user_id' => $user_id]);
            if (!empty($staff)) {
                return ['error_code' => 0, 'message' => 'Success', 'data' => $staff];
            }

        }
        return ['error_code' => 401, 'message' => 'Data empty', 'data' => []];
    }


}
