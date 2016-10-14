<?php
/**
 * Created by PhpStorm.
 * User: KOIGIANG
 * Date: 10/14/2016
 * Time: 10:44 AM
 */

namespace frontend\controllers;
use frontend\models\Camera;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

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

}