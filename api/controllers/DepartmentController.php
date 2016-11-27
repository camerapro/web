<?php
namespace api\controllers;
use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use api\components\ApiController;
use common\models\Department;
use common\components\KLogger;

/**
 * Site controller
 */
class DepartmentController extends ApiController
{
    public $enableCsrfValidation = false;
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

    public function actionGet()
    {
        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        $department = [];
        $message = '';
        $id = isset(Yii::$app->request->get()['id']) ? Yii::$app->request->get()['id'] : '';
        $staff_id = isset(Yii::$app->request->get()['staff_id']) ? Yii::$app->request->get()['staff_id'] : '';
		$department = Department::getList($id,$staff_id);
		if (!empty($department)) {
			return ['error_code' => 0, 'message' => 'Success', 'data' => $department];
		}
		if (empty($department)) {
			return ['error_code' => 401, 'message' => 'Data empty', 'data' => []];
		}
    }
    public function actionAdd()
    {
        $this->logger->LogInfo("actionAdd department data  :" . json_encode(Yii::$app->request->post()));

        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        if ($data = Yii::$app->request->post()) {

            $staff = new Department();
            $staff->name = isset($data['name']) ? $data['name'] : '';
            $staff->company_id = isset($data['company_id']) ? $data['company_id'] : '';
            $staff->parent_id = isset($data['parent_id']) ? $data['parent_id'] : '';
            $staff->local_department_id = isset($data['local_department_id']) ? $data['local_department_id'] : '';
            $staff->created_time = date("Y-m-d H:i:s");
            $staff->order = isset($data['order']) ? $data['order'] : '';
            $save = $staff->save(false);

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
