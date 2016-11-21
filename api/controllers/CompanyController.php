<?php
namespace api\controllers;
use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use api\components\ApiController;
use common\models\Company;

/**
 * Site controller
 */
class CompanyController extends ApiController
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
        $company = [];
        $message = '';
        $id = isset(Yii::$app->request->get()['id']) ? Yii::$app->request->get()['id'] : '';
        $staff_id = isset(Yii::$app->request->get()['staff_id']) ? Yii::$app->request->get()['staff_id'] : '';
		$company = Company::getList($id,$staff_id);
		if (!empty($company)) {
			return ['error_code' => 0, 'message' => 'Success', 'data' => $company];
		}
		if (empty($company)) {
			return ['error_code' => 401, 'message' => 'Data empty', 'data' => []];
		}
    }
	
}
