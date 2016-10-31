<?php
/**
 * Created by PhpStorm.
 * User: KOIGIANG
 * Date: 10/14/2016
 * Time: 10:44 AM
 */

namespace frontend\controllers;
use common\components\Common;
use common\models\User;
use frontend\models\Camera;
use frontend\models\RelationsCamUser;
use frontend\models\RelationsUserPermissionGroup;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\LoginForm;

class AjaxController extends Controller
{
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    public function init()
    {
        $this->layout = false;
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function actionCreate(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $camera = new Camera();
            $camera->encoder_name = $data['title_encoder'];
            $camera->name = $data['title_camera'];
            $camera->ip_address = $data['ip_address'];
            $camera->protocol = $data['protocol'];
            $camera->port = $data['port'];
            $camera->encoder_port = $data['port_http'];
            $camera->channel = $data['channel'];
            $camera->encoder_username = $data['username'];
            $camera->encoder_password = isset($data['password'])? $data['password'] : NULL;
            $camera->created_time = date('Y-m-d H:i:s');
            $camera->updated_time = date('Y-m-d H:i:s');
            $camera->encoder_model = $data['encoder_type'];
            if($data['protocol'] == 'http')
                $camera->streaming_url = $data['ip_address'];
            elseif ($data['protocol'] == 'rtsp')
                $camera->streaming_url = 'rtsp://' .$data['ip_address']. ':' . $data['port'] . '/user=' . $data['username'] . '&password='.$data['password'] . '&channel=' . $data['channel'] . '&stream=1.sdp';
            $save = $camera->save();
            if($save){
                $camera_user = new RelationsCamUser();
                $camera_user->cam_id = $camera->id;
                $camera_user->created_by_id = Yii::$app->user->identity->id;
                $camera_user->user_id = Yii::$app->user->identity->id;
                $camera_user->created_by_name = Yii::$app->user->identity->username;
                $camera_user->created_time = date('Y-m-d H:i:s');
                $camera_user->owner = 1;
                $camera_user->save();
                $return = array(
                    'return_code'=>0,
                    'message'=>'Thêm mới thành công'
                );
            }else{
                $return = array(
                    'return_code'=>1,
                    'message'=>'Thêm mới không thành công thành công'
                );
            }
        }else{
            $return = array(
                'return_code'=>1,
                'message'=>'Not Ajax request!'
            );
        }
        echo json_encode($return);
        exit;

    }

    public function actionCamera(){
        $data = Yii::$app->request->post();
        $camera = new User();
        $camera->fullname = $data['fullname'];
        $camera->username = $data['user_name'];
        $camera->password = md5($data['password']);
        $camera->phone = $data['phone_number'];
        $camera->email = $data['email'];
        $camera->status = 1;
        try{
            $save = $camera->save(false);
//            $save = true;
            if($save){
                $return = array(
                    'return_code'=>0,
                    'message'=>'Thêm mới thành công'
                );
            }    else{
                $return = array(
                    'return_code'=>1,
                    'message'=>'Thêm mới không thành công'
                );
            }
        }catch (Exception $ex){
            $return = array(
                'return_code'=>1,
                'message'=>'Thêm mới không thành công'
            );
        }

        echo json_encode($return);
        exit;
    }

    public function actionCheck_username(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $username = $data['user_name'];
            $phone_number = $data['phone_number'];
            $mail = $data['email'];
            $check = User::findByUsername($username);
            if($check){
                $return = array(
                    'return_code'=>1,
                    'message'=>'Người dùng đã tồn tại'
                );
                echo json_encode($return);
                exit;
            }
            if(!Common::validatePhone($phone_number)){
                $return = array(
                    'return_code'=>1,
                    'message'=>'Số điện thoại không hợp lệ'
                );
                echo json_encode($return);
                exit;
            }
            if(!Common::validateEmail($mail)){
                $return = array(
                    'return_code'=>1,
                    'message'=>'Email không hợp lệ'
                );
                echo json_encode($return);
                exit;
            }
            $return = array(
                'return_code'=>0,
                'message'=>'Người dùng không tồn tại'
            );
            echo json_encode($return);
            exit;
        }

    }

    public function actionCreate_and_login(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $user_name = trim($data['user_name']);
            $password = trim($data['password']);
            $user = new User();
            $user->fullname = $data['fullname'];
            $user->username = $user_name;
            $user->password = md5($password);
            $user->phone = $data['phone_number'];
            $user->email = $data['email'];
            $user->status = 1;
            $user->level = 1;
            try{
                //$save = $user->save(false);
                $save = $user->save();
                if($save){
                    $permission_user = new RelationsUserPermissionGroup();
                    $permission_user->user_id =  $user->id;
                    $permission_user->permission_group_id = 1;
                    $permission_user->save();
                    $model = new LoginForm();
                    $model->username = $user_name;
                    $model->password = $password;
                    if ($model->login()) {
                        $return = array(
                            'return_code'=>0,
                            'message'=>'Đăng nhập thành công'
                        );
                    } else {
                        User::deleteAll(['username'=>$user_name]);
                        $return = array(
                            'return_code'=>1,
                            'message'=>'Đăng nhập không thành công'
                        );
                    }
                }else{
                    User::deleteAll(['username'=>$user_name]);
                    $return = array(
                        'return_code'=>1,
//                        'message'=>'Đăng nhập không thành công đâu nhé'
                        'message'=>$user->getErrors(),
                    );
                }
            }catch (Exception $ex){
                $return = array(
                    'return_code'=>1,
                    'message'=>'Đăng nhập không thành công'
                );
            }
        }else{
            $return = array(
                'return_code'=>1,
                'message'=>'Not ajax request!'
            );
        }

        echo json_encode($return);
        exit;
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            $return = array(
                'return_code'=>0,
                'message'=>'Bạn đã đăng nhập trước đó'
            );
            echo json_encode($return);
            exit;
        }
        try{
            $data = Yii::$app->request->post();
            $user_name = $data['user_name'];
            $password = $data['password'];
            $model = new LoginForm();
            $model->username = trim($user_name);
            $model->password = trim($password);
            if ($model->login()) {
                $return = array(
                    'return_code'=>0,
                    'message'=>'Đăng nhập không thành công'
                );
            } else {
                $return = array(
                    'return_code'=>1,
                    'message'=>'Đăng nhập không thành công'
                );
            }
        }catch (Exception $ex){
            $return = array(
                'return_code'=>1,
                'message'=>'Đăng nhập không thành công'
            );
        }

        echo json_encode($return);
        exit;
    }

    public function actionUpdate_cam(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $cam_id = $data['cam_id'];
            $check = Camera::getListCamId($cam_id);
            if($check){
                if($check->status == 1 )  {
                    $check_status = 0;
                }
                else{
                    $check_status = 1;
                }
                $check->status = $check_status;
                $save = $check->save();
                $return = array(
                    'return_code'=>0,
                    'check_status'=>$check_status
                );
            }    else{
                $return = array(
                    'return_code'=>1,
//                    'check_status'=>$check_status
                );
            }
            echo json_encode($return);
            exit;
        }
    }

    public function actionPlay(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $cam_id = $data['cam_id'];
            $cam_info = Camera::getListCamId($cam_id);
            if($cam_info){
                $html =  $this->renderAjax('_play', [ 'cam_id' => $cam_id, 'cam_info'=>$cam_info]);
                $return =[
                    'return_code'=>0,
                    'return_html'=> $html
                ];
            }    else{
                $return = array(
                    'return_code'=>1,
                );
            }
            echo json_encode($return);
            exit;
        }
    }

    public function actionGrandcam(){
        if (Yii::$app->request->isAjax) {
            $session = Yii::$app->session;
            $data = Yii::$app->request->post();
            $cam_ids = isset($data['cam_ids']) ? $data['cam_ids'] : null;
            $user_id = Yii::$app->user->identity->id;

            if(empty($cam_ids)){
                RelationsCamUser::deleteAll(['user_id'=>$user_id, 'created_by_id'=>$session['user_id']]);
                $return =[
                    'return_code'=>0,
                ];
                echo json_encode($return);
                exit;
            }
            $res = false;
            RelationsCamUser::deleteAll(['user_id'=>$user_id, 'created_by_id'=>$session['user_id']]);
            foreach ($cam_ids as $cam_id){
                $cam_user = new RelationsCamUser();
                $cam_user->cam_id = $cam_id;
                $cam_user->user_id = $user_id;
                $cam_user->created_by_id = $session['user_id'];
                $cam_user->created_by_name = $session['user_name'];
                $cam_user->created_time = date('Y-m-d H:i:s');
                $res = $cam_user->save();
            }
            if($res)
            {
                $return =[
                    'return_code'=>0,
                ];
            }else{
                $return =[
                    'return_code'=>1,
                ];
            }
            echo json_encode($return);
            exit;
        }
    }

    public function actionLoginajax(){
        try{
            $data = Yii::$app->request->post();
            $user_name = trim($data['username_login']);
            $password = trim($data['password_login']);
            $login = \frontend\models\User::findOne(['username'=>$user_name, 'password'=>md5($password)]);

            if ($login) {
                $session = Yii::$app->session;
                $session['user_id'] = $login->id;
                $session['user_name'] = $login->username;
                $return = array(
                    'return_code'=>0,
                    'message'=>'Đăng nhập thành công',
                    'session'=>$_SESSION['user_id'],
                );
            } else {
                $return = array(
                    'return_code'=>1,
                    'message'=>'Đăng nhập không thành công, vui lòng đăng nhập lại'
                );
            }
        }catch (Exception $ex){
            $return = array(
                'return_code'=>1,
                'message'=>'Đăng nhập không thành công, vui lòng đăng nhập lại'
            );
        }

        echo json_encode($return);
        exit;
    }

}