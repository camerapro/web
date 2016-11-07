<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use api\models\LoginForm;
use common\models\Permission;

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

    public function actionLogin_bk()
    {
        if (!Yii::$app->user->isGuest) {
			
			$permission_group_id = Yii::$app->user->identity->permission_group_id;
			//$permission = \common\models\Permission::getListPermissionById(Yii::$app->user->identity->id);
			$permission = null;
			return ['error_code'=>0,'message'=>'Logined','data'=>['userid'=>Yii::$app->user->identity->id,'username'=>Yii::$app->user->identity->username,'permission_group_id'=>$permission_group_id,'permission'=>$permission]];
			
        }
		if($post = Yii::$app->request->post()){
			
			if(!$this->validateToken($post)){
				return ['error_code'=>1,'message'=>'Validate token fail'];
			}
			$model = new LoginForm();
			if ($model->load(['LoginForm' => Yii::$app->request->post()]) && $model->login()) {
				$permission_group_id = Yii::$app->user->identity->permission_group_id;
				//$permission = \common\models\Permission::getListPermissionById(Yii::$app->user->identity->id);
				$permission = null;
				return ['error_code'=>0,'message'=>'Logined','data'=>['userid'=>Yii::$app->user->identity->id,'username'=>Yii::$app->user->identity->username,'permission_group_id'=>$permission_group_id,'permission'=>$permission]];
			} else {
				return ['error_code'=>1,'message'=>'Login fail'];
			}
		}
	
		
        
    }
	public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
			
			$permission_group_id = Yii::$app->user->identity->permission_group_id;
			$user_permission = \common\models\Permission::getListPermissionByGroup($permission_group_id);
			$list_permissions = Permission::getAllPermission();

			return ['error_code'=>0,'message'=>'Logined','data'=>['userid'=>Yii::$app->user->identity->id,'username'=>Yii::$app->user->identity->username,'permission_group_id'=>$permission_group_id,'user_permission'=>$user_permission,'list_permission'=>$list_permissions]];
			
        }
		if($post = Yii::$app->request->post()){
			
			if(!$this->validateToken($post)){
				return ['error_code'=>1,'message'=>'Validate token fail'];
			}
			$model = new LoginForm();
			if ($model->load(['LoginForm' => Yii::$app->request->post()]) && $model->login()) {
				$permission_group_id = Yii::$app->user->identity->permission_group_id;
				$user_permission = \common\models\Permission::getListPermissionByGroup($permission_group_id);
				$list_permissions = Permission::getAllPermission();

				return ['error_code'=>0,'message'=>'Logined','data'=>['userid'=>Yii::$app->user->identity->id,'username'=>Yii::$app->user->identity->username,'permission_group_id'=>$permission_group_id,'user_permission'=>$user_permission,'list_permission'=>$list_permissions]];
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
