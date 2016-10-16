<?php
/**
 * Created by PhpStorm.
 * User: KOIGIANG
 * Date: 10/14/2016
 * Time: 10:44 AM
 */

namespace frontend\controllers;
use common\models\User;
use frontend\models\Camera;
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
    public function actionCreate(){
        $data = Yii::$app->request->post();
        $camera = new Camera();
        $camera->name = $data['title_encoder'];
        $camera->encoder_name = $data['title_camera'];
        $camera->streaming_url = $data['ip_address'];
        $camera->protocol = $data['protocol'];
        $camera->port = $data['port'];
        $camera->channel = $data['channel'];
        $save = $camera->save(false);
        if($save){
            $return = array(
                'return_code'=>0,
                'message'=>'Thêm mới thành công'
            );
        }    else{
            $return = array(
                'return_code'=>1,
                'message'=>'Thêm mới không thành công thành công'
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
            $check = User::findByUsername($username);
            if($check){
                $return = array(
                    'return_code'=>1,
                    'message'=>'Người dùng đã tồn tại'
                );
            }    else{
                $return = array(
                    'return_code'=>0,
                    'message'=>'Người dùng không tồn tại'
                );
            }
            echo json_encode($return);
            exit;
        }

    }

    public function actionCreate_and_login(){
        $data = Yii::$app->request->post();
        $user_name = trim($data['user_name']);
        $password = trim($data['password']);
        $camera = new User();
        $camera->fullname = $data['fullname'];
        $camera->username = $user_name;
        $camera->password = md5($password);
        $camera->phone = $data['phone_number'];
        $camera->email = $data['email'];
        $camera->status = 1;
        try{
            $save = $camera->save(false);
//            $save = true;
            if($save){
                $model = new LoginForm();
                $model->username = $user_name;
                $model->password = $password;
                if ($model->login()) {
                    $return = array(
                        'return_code'=>0,
                        'message'=>'Đăng nhập không thành công'
                    );
                } else {
                    $user_name = User::findByUsername($user_name);
                    $user_name->delete();
                    $return = array(
                        'return_code'=>1,
                        'message'=>'Đăng nhập không thành công'
                    );
                }
            }else{
                $user_name = User::findByUsername($user_name);
                $user_name->delete();
                $return = array(
                    'return_code'=>1,
                    'message'=>'Đăng nhập khôngsss thành công'
                );
            }
        }catch (Exception $ex){
            $return = array(
                'return_code'=>1,
                'message'=>'Đăng nhập không thành côngdd'
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
            $status = (int) $data['status'];
            $check = Camera::getListCamId($cam_id);
            if($check){
                $check->status = $status;
                $save = $check->save();
                $return = array(
                    'return_code'=>0,
                    'message'=>'Success'
                );
            }    else{
                $return = array(
                    'return_code'=>1,
                    'message'=>'UnSuccess'
                );
            }
            echo json_encode($return);
            exit;
        }

    }

}