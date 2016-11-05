<?php

namespace common\models;


use Yii;
use common\models\_base\RecorderBase;


/**
 * This is the model class for table "tat".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $streaming_url
 * @property string $ip_address
 * @property integer $port
 * @property string $protocol
 * @property string $created_time
 * @property string $updated_time
 * @property integer $order
 * @property integer $camera_id
 * @property integer $user_id
 * @property integer $agency_id
 * @property integer $status$re
 */
class Recorder extends RecorderBase
{
    public static  function add($params){
        $recorder = new self;
        $recorder->attributes = $params;
        $rt = $recorder->save(false);
        return $recorder;
    }
    public static  function getRecorder($recorder_id =0,$user_id=0){
        if(empty($user_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }
        if($recorder_id){
            $recorder = self::find()
                ->where(['status'=>1,'id'=>$recorder_id,'user_id'=>$user_id])->asArray()
                ->one();
            if($recorder){
                $channel = \api\models\Camera::getListCam($user_id,$recorder_id);
                $recorder['channels'] = $channel;
            }
            return $recorder;
        }
        $recorder = self::find()
            ->where(['status'=>1,'user_id'=>$user_id])
            ->all();
        $rt = [];
        if($recorder) {
            foreach ($recorder as $records) {
                $rt = $records;
                $channel = \api\models\Camera::getListCam($user_id, $records->id);
                $rt['channels'] = $channel;

            }
            return $rt;
        }
        return false;


    }

}
