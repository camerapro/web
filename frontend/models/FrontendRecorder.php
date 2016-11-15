<?php

namespace frontend\models;;

use common\models\Recorder;
use common\models\User;
use Yii;



class FrontendRecorder extends Recorder
{

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
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
            'created_time' => 'Thời gian tạo',
            'channels' => 'Kênh',
            'model'=>'Loại thiết bị'
        ];
    }

}
