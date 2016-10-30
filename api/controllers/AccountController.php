<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
/**
 * Site controller
 */
class AccountController extends Controller
{
	public $enableCsrfValidation = false;
	private $api_key ='43S4342@342Asfd';
	public $layout =false;
	public function init()
    {
        \Yii::$app->response->format = 'json';
    }
    /**
     * @inheritdoc
     */
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => false,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }*/

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
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

     public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
           return ['error_code'=>0,'message'=>'Logined'];
        }
		$model = new LoginForm();
        if ($model->load(['LoginForm' => Yii::$app->request->post()]) && $model->login()) {
            return ['error_code'=>0,'message'=>'Logined','data'=>['userid'=>Yii::$app->user->identity->id,'username'=>Yii::$app->user->identity->username]];
        } else {
            return ['error_code'=>1,'message'=>'Login fail'];
        }
        
    }
	    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
		if (Yii::$app->user->isGuest) {
           return ['error_code'=>0,'message'=>'Logout'];
        }
    }
	
	public function actionValidate()
    {
        
    }
	public function actionRecoderGet()
    {
        $cam_info = [];
        $message = '';
        $cam_id = isset(Yii::$app->request->get()['id']) ? Yii::$app->request->get()['id'] : '';
        if(!empty($cam_id)){
            $cam_info = Camera::getOneCamById($cam_id);
            if(!$cam_info){
                return ['error_code'=>1,'message'=>'No permistion'];
            }
        }else{
            $cams = \frontend\models\Camera::getListCam();
            if(!empty($cams)){
                $cam_info = $cams;
				return ['error_code'=>0,'message'=>'Success','data'=>$cam_info];
            }
            if(empty($cam_info)){
                return ['error_code'=>401,'message'=>'Data empty','data'=>[]];
            }
        }
    }
}
