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

	public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
			
			$permission_group_id = Yii::$app->user->identity->permission_group_id;
			$user_permission = \common\models\Permission::getListPermissionByGroup($permission_group_id);
			$list_permission_group = \common\models\Permission::getAllPermissionGroup();
			$list_permissions = Permission::getAllPermission();

			return ['error_code'=>0,'message'=>'Logined','data'=>['userid'=>Yii::$app->user->identity->id,'username'=>Yii::$app->user->identity->username,'permission_group_id'=>$permission_group_id,'list_permission_group'=>$list_permission_group,'user_permission'=>$user_permission,'list_permission'=>$list_permissions]];
			
        }
		if($post = Yii::$app->request->post()){
			
			if(!$this->validateToken($post)){
				return ['error_code'=>1,'message'=>'Validate token fail'];
			}
			$model = new LoginForm();
			if ($model->load(['LoginForm' => Yii::$app->request->post()]) && $model->login()) {
				$permission_group_id = Yii::$app->user->identity->permission_group_id;
				$user_permission = \common\models\Permission::getListPermissionByGroup($permission_group_id);
				$list_permission_group = \common\models\Permission::getAllPermissionGroup();
				$list_permissions = Permission::getAllPermission();

				return ['error_code'=>0,'message'=>'Logined','data'=>['userid'=>Yii::$app->user->identity->id,'username'=>Yii::$app->user->identity->username,'permission_group_id'=>$permission_group_id,'list_permission_group'=>$list_permission_group,'user_permission'=>$user_permission,'list_permission'=>$list_permissions]];
			} else {
				return ['error_code'=>1,'message'=>'Login fail'];
			}
		}

    }
    public function actionCreate()
    {


        $error= '';
//        print_r(Yii::$app->request->get());exit;
        ;
        if($data = (Yii::$app->request->post())) {
            if(!$this->validateToken($data)){
                return ['error_code'=>1,'message'=>'Validate token fail'];
            }
            if (empty($data['username']) || empty($data['name']) || empty($data['phone']) || empty($data['email'])){
                return ['error_code' => 1, 'message' => 'Fill full the information'];
                exit();
            }
            $model = new \common\models\User();
            $user_name = trim($data['username']);
            $check_exits = \common\models\User::findOne(['username'=>$user_name]);
            if($check_exits){
               return  ['error_code'=>1,'message'=>'Account existed'];
            }
            $email = $data['email'];
            $password = $data['password'];
            $model->email = $email;
            $model->username = $user_name;
            $model->phone = isset($data['phone'])?$data['phone']:'';
            $model->password = md5($password);
            $model->fullname = isset($data['name'])?$data['name']:'';
            $model->created_time = date('Y-m-d H:i:s');
            $model->updated_time = date('Y-m-d H:i:s');
            $model->status = 1;
            $model->permission_group_id =  isset($data['permission']) ? $data['permission'] : 1;
            if ($model->save(false)) {
                return ['error_code'=>0,'message'=>'Success','data'=>['userid'=>$model->id,'username'=>$user_name]];

            }else{
                return ['error_code'=>1,'message'=>'Create fail'];

            }
        }else{
            $return = array(
                'error_code'=>1,
                'message'=>'Method not supported!'
            );
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
