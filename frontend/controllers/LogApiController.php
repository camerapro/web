<?php

namespace frontend\controllers;

use common\components\FrontendController;
use Yii;
use frontend\models\StaffFrontend;
use frontend\models\search\StaffSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StaffController implements the CRUD actions for StaffFrontend model.
 */
class LogApiController extends Controller
{
    public $enableCsrfValidation = false;
	
	
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
     * Lists all StaffFrontend models.
     * @return mixed
     */
    public function actionIndex()
    {
        $log_path = '/srv/www/cmr/runtime/';
		$date = isset(Yii::$app->request->get()['date']) ? Yii::$app->request->get()['date'] : date("Ymd");
		$file_name = $log_path.'api_'.$date;
        return $this->render('index', [
            'file_name' => $file_name
        ]);
    }

    
}
