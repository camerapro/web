<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use api\models\LoginForm;
/**
 * Site controller
 */
class AccountController extends Controller
{
	public $enableCsrfValidation = false;
	private $api_key ='43S4342342Asfd';
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
			
           return ['error_code'=>0,'message'=>'Logined','data'=>['userid'=>Yii::$app->user->identity->id,'username'=>Yii::$app->user->identity->username]];
        }
		if($post = Yii::$app->request->post()){
			
			if(!$this->validateToken($post)){
				return ['error_code'=>1,'message'=>'Validate token fail'];
			}
			$model = new LoginForm();
			if ($model->load(['LoginForm' => Yii::$app->request->post()]) && $model->login()) {
				return ['error_code'=>0,'message'=>'Logined','data'=>['userid'=>Yii::$app->user->identity->id,'username'=>Yii::$app->user->identity->username]];
			} else {
				return ['error_code'=>1,'message'=>'Login fail'];
			}
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
	
	public function actionToken()
    {
		if($data = Yii::$app->request->post())
        {
			Yii::$app->session['token'] =  hash('sha256',time().session_id());
			return ['error_code'=>0,'message'=>'Success','data'=>['token'=>Yii::$app->session['token']]];
		}
		exit();
    }
	private function validateToken($post)
    {
		$token_sv = Yii::$app->session['token'];
		$hash_sv = hash("sha256",$token_sv.'@'.$this->api_key);
		$token = isset($post['token'])?$post['token']:'';
		$hash = isset($post['hash'])?$post['hash']:'';
		if($hash_sv ==$hash)
			return true;
		
		return false;
    }

}
