<?php
namespace frontend\controllers;

use frontend\models\Camera;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\RelationsCamUser;
/**
 * Site controller
 */
class AppController extends Controller
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
            'error' => [
                'class' => 'yii\web\ErrorAction',
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
        die('HELLO API');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
           return ['error_code'=>0,'message'=>'Logined'];
        }
		$model = new LoginForm();
		var_dump(Yii::$app->request->post());
        if ($model->load(['LoginForm' => Yii::$app->request->post()]) && $model->login()) {
            return ['error_code'=>0,'message'=>'Logined','data'=>['userid'=>Yii::$app->user->identity->id,'username'=>Yii::$app->user->identity->username]];
        } else {
            return ['error_code'=>1,'message'=>'Login fail'];
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
    public function actionRecoderAdd()
    {
          if($data = Yii::$app->request->post())
            {
            $camera = new Camera();
            $camera->name = $data['name'];
            $camera->ip_address = $data['ip'];
            $camera->protocol = $data['protocol'];
            $camera->port = $data['port'];
            $camera->channel = $data['channel'];
            $camera->encoder_username = $data['username'];
            $camera->encoder_password = $data['password'];
            $camera->created_time = date('Y-m-d H:i:s');
            $camera->updated_time = date('Y-m-d H:i:s');
            $camera->user_id = Yii::$app->user->identity->id;
			
            if($data['protocol'] == 'http')
                $camera->streaming_url = $data['ip'];
            elseif ($data['protocol'] == 'rtsp')
                $camera->streaming_url = 'rtsp://' .$data['ip']. ':' . $data['port'] . '/user=' . $data['username'] . '&password='.$data['password'] . '&channel=' . $data['channel'] . '&stream=1.sdp';
            $save = $camera->save(false);
            if($save){
               /* $camera_user = new RelationsCamUser();
                $camera_user->cam_id = $camera->id;
                $camera_user->created_by_id = Yii::$app->user->identity->id;
                $camera_user->user_id = Yii::$app->user->identity->id;
                $camera_user->created_by_name = Yii::$app->user->identity->username;
                $camera_user->created_time = date('Y-m-d H:i:s');
                $camera_user->save();*/
                $return = array(
                    'error_code'=>0,
                    'message'=>'Success'
                );
            }else{
                $return = array(
                    'error_code'=>1,
                    'message'=>'Add fail'
                );
            }
		}else{
            $return = array(
                'error_code'=>1,
                'message'=>'Method not supported!'
            );
        }
        echo json_encode($return);
        exit;
        
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

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionWatch(){
        return $this->render('watch');
    }

    public function actionCreate(){
        $data = Yii::$app->request->get();
        print_r($data);exit;
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */

}
