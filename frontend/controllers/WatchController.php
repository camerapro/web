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

class WatchController extends Controller
{
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    public function actionCreate(){
        $data = Yii::$app->request->post();
        $camera = new Camera();
        $camera->name = $data['title_encoder'];
        $camera->streaming_url = $data['ip_address'];
        $camera->protocol = $data['protocol'];
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

    public function actionAjax()
    {

        if (!Yii::$app->user->isGuest) {
            $return = array(
                'return_code'=>0,
                'message'=>'Thêm mới thành công'
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

}