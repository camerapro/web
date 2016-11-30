<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Staff;
use common\components\KLogger;

/**
 * Site controller
 */
class StaffController extends Controller
{
    public $enableCsrfValidation = false;
    private $api_key = '43S4342@342Asfd';
    public $layout = false;
    public $logger;

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
        $this->logger->LogInfo("actionAdd staff data  :" . json_encode(Yii::$app->request->post()));

        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
		
        if ($data = Yii::$app->request->post()) {

            //check card_code existed 
			$card_code = isset($data['card_code']) ? $data['card_code'] : '';
			$company_id = isset($data['company_id']) ? $data['company_id'] : '';
			$staff = \common\models\Staff::getStaffFromCardCode($card_code,$company_id);
			if($staff){
				$return = array(
                    'error_code' => 1,
                    'message' => 'Card code is existed'
                );
			}
			//check card_id existed 
			if(empty($card_code)){
				$att_code = isset($data['att_code]']) ? $data['att_code]'] :'';
				if(!$att_code)
					$att_code = isset($data['att_code']) ? $data['att_code'] :'';
				$company_id = isset($data['company_id']) ? $data['company_id'] : '';
				$staff = \common\models\Staff::getStaffFromAttCode($att_code,$company_id);
				
			}
			if(!$staff){
				$staff = new Staff();
			}
            $staff->name = isset($data['name']) ? $data['name'] : '';
            $staff->phone = isset($data['phone']) ? $data['phone'] : '';
            $staff->email = isset($data['email']) ? $data['email'] : '';
            $staff->card_code = isset($data['card_code']) ? $data['card_code'] : '';
            $staff->card_id = isset($data['card_id']) ? $data['card_id'] : '';
            $staff->att_code = $att_code;
			
			$department_id = isset($data['department_id']) ? $data['department_id'] : 0;
			$department = \common\models\Department::getDepartmentByLocalId($department_id);
			if($department)
				$department_id = $department->id;
            $staff->department_id = $department_id;
			
            $image = isset($data['image']) ? $data['image'] : '';
            $staff->image = '';
            $staff->created_by = isset($data['created_by']) ? $data['created_by'] : Yii::$app->user->identity->id;
            $staff->company_id = isset($data['company_id']) ? $data['company_id'] : '';
            $staff->description = isset($data['description']) ? $data['description'] : '';
            $staff->created_time = date("Y-m-d H:i:s");
            $staff->order = isset($data['order']) ? $data['order'] : '';
            $save = $staff->save(false);
            if ($save) {
                if ($image) {
                    //upload image
                    $path = Yii::$app->params['images']['staff']['path'] . '/' . $staff->company_id;
                    $option = ['width' => 120, 'height' => 120];
                    \common\components\Common::uploadFile($image, $path, $staff, '.png', $option, true);
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
        $this->logger->LogInfo("actionInfo staff data  :" . json_encode(Yii::$app->request->get()));

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
            $staff->image = \common\components\Common::getImage($staff, 'staff');
        return ['error_code' => 0, 'message' => 'Success', 'data' => $staff];

    }

    /**
     * @return array
     */
    public function actionGet()
    {
        $this->logger->LogInfo("actionInfo staff data  :" . json_encode(Yii::$app->request->get()));
        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        $staff = [];
        $message = '';
        $user_id = isset(Yii::$app->request->get()['user_id']) ? Yii::$app->request->get()['user_id'] : '';
        $company_id = isset(Yii::$app->request->get()['company_id']) ? Yii::$app->request->get()['company_id'] : '';
        $staff = Staff::getStaff($user_id, $company_id);
        if (!empty($staff)) {
            return ['error_code' => 0, 'message' => 'Success', 'data' => $staff];
        }
        return ['error_code' => 401, 'message' => 'Data empty', 'data' => []];
    }


}
