<?php
/**
 * Created by PhpStorm.
 * User: KOIGIANG
 * Date: 10/14/2016
 * Time: 10:44 AM
 */

namespace frontend\controllers;
use common\components\Common;
use common\models\Recorder;
use common\models\User;
use frontend\models\FrontendCamera;
use frontend\models\FrontendRecorder;
use frontend\models\FrontendUser;
use frontend\models\LoginForm;
use frontend\models\RelationsCamUser;
use frontend\models\RelationsUserPermissionGroup;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

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
            $data = Yii::$app->request->get();
            if(!isset($data['recorder_id']) || (int)$data['recorder_id'] ==0 ){
                $recorder = new FrontendRecorder();
                $recorder->name = isset($data['title_encoder'])?$data['title_encoder']:'Undefined';
                $recorder->ip = isset($data['ip_address'])?$data['ip_address']:'';
                $recorder->username = isset($data['username'])?$data['username']:'';
                $recorder->password = isset($data['password'])?$data['password']:'';
                $recorder->protocol = isset($data['protocol'])?$data['protocol']:'';
                $recorder->media_port = isset($data['port'])?$data['port']:'';
                $recorder->port = isset($data['port_http'])?$data['port_http']:'';
                $recorder->created_time = date('Y-m-d H:i:s');
                $recorder->user_id = Yii::$app->user->identity->id;
                $recorder->model = isset($data['encoder_model'])?$data['encoder_model']:0;
                if($recorder->save(false)){
                    $recorder_id = $recorder->id;
                }
            } else{
                $recorder_id = $data['recorder_id'];
            }
            $camera = new FrontendCamera();
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
            $camera->encoder_model = $data['encoder_model'];
            $camera->recorder_id = $recorder_id;
            $camera->user_id = Yii::$app->user->identity->id;
            $save = $camera->save(false);
            if($save){
                $camera->streaming_url = Common::getLinkStream($camera->id);
                $camera->update();
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
        $data = Yii::$app->request->get();
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
            $user->permission_group_id = 1;
            $user->created_time = date('Y-m-d H:i:s');
            try{
                //$save = $user->save(false);
                $save = $user->save();
                if($save){
                    $model = new LoginForm();
                    $model->username = $user_name;
                    $model->password = $password;
                    try{
                        $login = $model->login();
                    }
                    catch (Exception $ex){
                        User::deleteAll(['username'=>$user_name]);
                        $return = array(
                            'return_code'=>1,
                            'message'=>'Đăng nhập không thành công'
                        );
                        echo json_encode($return);
                        exit;
                    }
                    if ($login) {
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
            $check = FrontendCamera::getListCamId($cam_id);
            if($check){
                if($check->status == 1 )  {
                    $check_status = 0;
                }
                else{
                    $check_status = 1;
                }
                $check->status = $check_status;
                $check->save();
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
            $cam_info = FrontendCamera::getListCamId($cam_id);
            $recorder_info = FrontendRecorder::findOne($cam_info->recorder_id);
            $streaming_url = Common::getLinkStream($cam_id);
            if($cam_info){
                $html =  $this->renderAjax('_play', [ 'cam_id' => $cam_id, 'cam_info'=>$cam_info, 'streaming_url'=>$streaming_url, 'recorder_info'=>$recorder_info]);
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

    public function actionPlay_quality(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $cam_id = $data['cam_id'];
            $quality_value = $data['quality_value'];
            if($quality_value == 1) $require_quality = 0;
            else $require_quality = 1;
            $cam_info = FrontendCamera::getListCamId($cam_id);
            $streaming_url = Common::getLinkStreamByQuality($cam_id, $require_quality);
            if($cam_info){
                $html =  $this->renderAjax('_play', [ 'cam_id' => $cam_id, 'cam_info'=>$cam_info, 'streaming_url'=>$streaming_url]);
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
                $cam_user->owner = 0;
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
            $login = FrontendUser::findOne(['username'=>$user_name, 'password'=>md5($password)]);

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

    public function actionEncorder_info(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id_recoder = trim($data['id_recoder']);
            $res = Recorder::find()->where(['id'=>$id_recoder])->asArray()->one();
            if($res)
            {
                $return =[
                    'return_code'=>0,
                    'data'=>$res,
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

    public function actionAdd_form_cam(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $number_cam_show = $data['number_cam_show'];

            if($number_cam_show <16){
                $html =  $this->renderAjax('_add_form_cam', [ 'number_cam_show' => $number_cam_show]);
                $return =[
                    'return_code'=>0,
                    'return_html'=> $html,
                    'number_cam_show' => (int) $number_cam_show + 1
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
    public function actionCreate_recorder(){
        if (Yii::$app->request->isAjax) {
            $transaction = Yii::$app->db->beginTransaction();
            $data = Yii::$app->request->post();
            try{
                if(!isset($data['recorder_id']) || (int)$data['recorder_id'] ==0 ){
                    $recorder = new FrontendRecorder();
                    foreach ($data['recorder'] as $item){
                        $recorder->$item['name'] = $item['value'];
                    }
                    $recorder->created_time = date('Y-m-d H:i:s');
                    $recorder->user_id = Yii::$app->user->identity->id;
                    if($recorder->save(false)){
                        $recorder_id = $recorder->id;
                    }
                } else{
                    //check recoder info
                    $recorder = FrontendRecorder::findOne($data['recorder_id']);
                    foreach ($data['recorder'] as $item){
                        if($item['name']=='ip' && $recorder->ip != $item['value']){
                            $return = array(
                                'return_code'=>1,
                                'message'=>'IP/Domain không chính xác'
                            );
                            echo json_encode($return);
                            exit;
                        }
                        if($item['name']=='username' && $recorder->username != $item['value']){
                            $return = array(
                                'return_code'=>1,
                                'message'=>'Tên truy cập không chính xác!'
                            );
                            echo json_encode($return);
                            exit;
                        }
                        if($item['name']=='password' && $recorder->password != $item['value']){
                            $return = array(
                                'return_code'=>1,
                                'message'=>'Mật khẩu không chính xác!'
                            );
                            echo json_encode($return);
                            exit;
                        }
                    }
                        $recorder_id = $data['recorder_id'];
                }
                for ($i = 0; $i<count($data['camera']); $i=$i+2){
                    $camera = new FrontendCamera();
                    if(!empty($data['camera'][$i]['value']) && !empty($data['camera'][$i+1]['value'])){
                        $camera->$data['camera'][$i]['name'] = $data['camera'][$i]['value'];
                        $camera->$data['camera'][$i+1]['name'] = $data['camera'][$i+1]['value'];
                        $camera->created_time = date('Y-m-d H:i:s');
                        $camera->updated_time = date('Y-m-d H:i:s');
                        $camera->recorder_id = $recorder_id;
                        $save = $camera->save(false);
                        if($save){
                            $camera_user = new RelationsCamUser();
                            $camera_user->cam_id = $camera->id;
                            $camera_user->user_id = Yii::$app->user->identity->id;
                            $camera_user->created_by_name = Yii::$app->user->identity->username;
                            $camera_user->created_by_id = Yii::$app->user->identity->id;
                            $camera_user->owner = 1;
                            $camera_user->created_time = date('Y-m-d H:i:s');
                            $camera_user->save();
                        }else{
                            $return = array(
                                'return_code'=>1,
                                'message'=>'Thêm mới không thành công thành công'
                            );
                            $transaction->rollBack();
                            echo json_encode($return);
                            exit;
                        }
                    }

                }
                $return = array(
                    'return_code'=>0,
                    'message'=>'Thêm mới thành công'
                );
                $transaction->commit();
            } catch (\Exception $e) {
                $return = array(
                    'return_code'=>1,
                    'message'=>'Thêm mới không thành công thành công'
                );
                $transaction->rollBack();
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

    public function actionUpdate_recorder(){
        if (Yii::$app->request->isAjax) {
            $transaction = Yii::$app->db->beginTransaction();
            $data = Yii::$app->request->post();
            try{
                if(!isset($data['recorder_id']) || (int)$data['recorder_id'] ==0 ){
                    $return = array(
                        'return_code'=>1,
                        'message'=>'Không tìm thấy thông tin đầu ghi!'
                    );
                    echo json_encode($return);
                    exit;
                } else{
                    //check recoder info
                    $recorder = FrontendRecorder::findOne($data['recorder_id']);
                    foreach ($data['recorder_old'] as $item){
                        if($item['name']=='ip' && $recorder->ip != $item['value']){
                            $return = array(
                                'return_code'=>1,
                                'message'=>'IP/Domain không chính xác'
                            );
                            echo json_encode($return);
                            exit;
                        }
                        if($item['name']=='username' && $recorder->username != $item['value']){
                            $return = array(
                                'return_code'=>1,
                                'message'=>'Tên truy cập không chính xác!'
                            );
                            echo json_encode($return);
                            exit;
                        }
                        if($item['name']=='password' && $recorder->password != $item['value']){
                            $return = array(
                                'return_code'=>1,
                                'message'=>'Mật khẩu không chính xác!'
                            );
                            echo json_encode($return);
                            exit;
                        }
                    }


                    foreach ($data['recorder_new'] as $item){
                        $recorder->$item['name'] = $item['value'];
                    }
                    $recorder->updated_time = date('Y-m-d H:i:s');
//                    $recorder->user_id = Yii::$app->user->identity->id;
                    if($recorder->save(false)){
                        $return = array(
                            'return_code'=>0,
                            'message'=>'Cập nhật thành công'
                        );
                        $transaction->commit();
                    }

                }

            } catch (\Exception $e) {
                $return = array(
                    'return_code'=>1,
                    'message'=>'Thêm mới không thành công thành công'
                );
                $transaction->rollBack();
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

    public function actionUpdate_camera(){
        if (Yii::$app->request->isAjax) {
            $transaction = Yii::$app->db->beginTransaction();
            $data = Yii::$app->request->post();
            try{
                $recorder_id = $data['recorder_id'];
                if(!isset($recorder_id) || (int)$recorder_id ==0 ){
                    $return = array(
                        'return_code'=>1,
                        'message'=>'Lỗi không tìm thấy thông tin đầu ghi!'
                    );
                    echo json_encode($return);
                    exit;
                } else{
                    //check recoder info
                    $recorder = FrontendRecorder::findOne($data['recorder_id']);
                    foreach ($data['recorder'] as $item){
                        if($item['name']=='ip' && $recorder->ip != $item['value']){
                            $return = array(
                                'return_code'=>1,
                                'message'=>'IP/Domain không chính xác'
                            );
                            echo json_encode($return);
                            exit;
                        }
                        if($item['name']=='username' && $recorder->username != $item['value']){
                            $return = array(
                                'return_code'=>1,
                                'message'=>'Tên truy cập không chính xác!'
                            );
                            echo json_encode($return);
                            exit;
                        }
                        if($item['name']=='password' && $recorder->password != $item['value']){
                            $return = array(
                                'return_code'=>1,
                                'message'=>'Mật khẩu không chính xác!'
                            );
                            echo json_encode($return);
                            exit;
                        }
                    }
                }
                //xoa het camera roi tao lai
                //get all cam by id
                $cams = FrontendCamera::findAll(['recorder_id'=>$recorder_id]);
                foreach ($cams as $cam){
                    RelationsCamUser::deleteAll(['user_id'=>$recorder->user_id, 'cam_id'=>$cam->id]);
                }
                FrontendCamera::deleteAll(['recorder_id'=>$recorder_id]);

                for ($i = 0; $i<count($data['camera']); $i=$i+2){
                    $camera = new FrontendCamera();
                    if(!empty($data['camera'][$i]['value']) && !empty($data['camera'][$i+1]['value'])){
                        $camera->$data['camera'][$i]['name'] = $data['camera'][$i]['value'];
                        $camera->$data['camera'][$i+1]['name'] = $data['camera'][$i+1]['value'];
                        $camera->created_time = date('Y-m-d H:i:s');
                        $camera->updated_time = date('Y-m-d H:i:s');
                        $camera->recorder_id = $recorder_id;
                        $save = $camera->save(false);
                        if($save){
                            $camera_user = new RelationsCamUser();
                            $camera_user->cam_id = $camera->id;
                            $camera_user->user_id = Yii::$app->user->identity->id;
                            $camera_user->created_by_name = Yii::$app->user->identity->username;
                            $camera_user->created_by_id = Yii::$app->user->identity->id;
                            $camera_user->owner = 1;
                            $camera_user->created_time = date('Y-m-d H:i:s');
                            $camera_user->save();
                        }else{
                            $return = array(
                                'return_code'=>1,
                                'message'=>'Thêm mới không thành công'
                            );
                            $transaction->rollBack();
                            echo json_encode($return);
                            exit;
                        }
                    }

                }
                $return = array(
                    'return_code'=>0,
                    'message'=>'Cập nhật thông tin camera thành công'
                );
                $transaction->commit();
            } catch (\Exception $e) {
                $return = array(
                    'return_code'=>1,
                    'message'=>'Cập nhậ không thành công'
                );
                $transaction->rollBack();
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

}