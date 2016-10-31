<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Timekeeping;

/**
 * Site controller
 */
class TimekeepingController extends Controller
{
    public $enableCsrfValidation = false;
    private $api_key = '43S4342@342Asfd';
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

    public function actionAdd()
    {
        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        if ($data = Yii::$app->request->post()) {

            $params = [
                'card_code' => isset($data['card_code']) ? $data['card_code'] : '',
                'staff_id' => isset($data['staff_id']) ? $data['staff_id'] : '',
                'tap_id' => isset($data['tap_id']) ? $data['tap_id'] : '',
                'image' => isset($data['image']) ? $data['image'] : '',
                'type' => isset($data['type']) ? $data['type'] : '',
                'created_by' => isset($data['user_id']) ? $data['user_id'] : Yii::$app->user->identity->id,
                'description' => isset($data['description']) ? $data['description'] : '',
                'created_time' => isset($data['created_time']) ? $data['created_time'] : date('Y-m-d H:i:s'),
            ];

            $save = Timekeeping::add($params);

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
    public function actionGet()
    {
        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        $staff = [];
        $message = '';
        $card_code = isset(Yii::$app->request->get()['card_code']) ? Yii::$app->request->get()['card_code'] : '';
        $staff_name = isset(Yii::$app->request->get()['staff_name']) ? Yii::$app->request->get()['staff_name'] : '';
        $staff = Timekeeping::search($card_code,$staff_name);
        return ['error_code' => 0, 'message' => 'Success', 'data' => $staff];

    }
    /**
     * @return array
     */
    public function actionUpdate()
    {
        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        if ($data = Yii::$app->request->post()) {
            return ['error_code' => 0, 'message' => 'Success'];
        }
        exit();

    }
    /**
     * @return array
     */
    public function actionDelete()
    {
        if (Yii::$app->user->isGuest) {
            return ['error_code' => 1, 'message' => 'Not login'];
        }
        $id = isset(Yii::$app->request->get()['id']) ? Yii::$app->request->get()['id'] : '';
        if ($data = Yii::$app->request->post()) {
            $this->findModel($id)->delete();
            return ['error_code' => 0, 'message' => 'Success'];
        }
        else{
            return array(
                'error_code'=>1,
                'message'=>'Method not supported!'
            );
        }
        return ['error_code' => 1, 'message' => 'Fail'];
        exit();

    }
    /**
     * Finds the Camera model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Camera the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Timekeeping::findOne($id)) !== null) {
            return $model;
        } else {
            return ['error_code' => 1, 'message' => 'Fail'];
        }
    }
    /**
     * @return array
     */
    public function actionGet22()
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
