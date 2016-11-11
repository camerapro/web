<?php

namespace frontend\models;;

use common\models\Recorder;
use Yii;



class FrontendRecorder extends Recorder
{
	public static function getRecorderById($user_id = 0){
        if(empty($user_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }
	    $recoder = Recorder::find()->where(['user_id'=>$user_id])->asArray()->all();
        return $recoder;
    }


    public function attributeLabels()
    {
        return [
            'name' => 'Tên đầu ghi',
            'ip' => 'Ip Address/Domain',
            'username' => 'Tên truy cập',
            'password' => 'Mật khẩu',
            'protocol' => 'Giao thức',
            'media_port' => 'Cổng media',
            'port_stream' => 'Cổng Rtsp',
//            'port' => 'Port',
//            'params' => 'Params',
//            'activation_time' => 'Activation Time',
            'created_time' => 'Ngày tạo',
//            'updated_time' => 'Updated Time',
//            'order' => 'Order',
//            'status' => 'Status',
//            'user_id' => 'User ID',
//            'agency_id' => 'Agency ID',
//            'model' => 'Model',
            'channels' => 'Kênh',
        ];
    }

}
