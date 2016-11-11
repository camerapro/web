<?php

namespace common\models;


use Yii;
use common\models\_base\RecorderBase;


class Recorder extends RecorderBase
{
    public static  function add($params){
        $recorder = new self;
        $recorder->attributes = $params;
        $rt = $recorder->save(false);
        return $recorder;
    }
    public static  function getRecorder($recorder_id =0,$user_id=0){
        if(empty($user_id) && empty($recorder_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }
        if($recorder_id){
            $recorder = self::find()
                ->where(['status'=>1,'id'=>$recorder_id,'user_id'=>$user_id])->asArray()
                ->one();
            if($recorder){
                $channel = Camera::getListCam($user_id,$recorder_id, $recorder);
                $recorder['channels'] = $channel;
            }
            return $recorder;
			
        }
        $recorder = self::find()
            ->where(['status'=>1,'user_id'=>$user_id])
            ->all();
        $rt = [];
		//echo "data";
        if($recorder) {
			$i =0;
            foreach ($recorder as $records) {
               // $channel = \api\models\Camera::getListCam($user_id, $records->id,$records);
                $channel = Camera::getListCam($user_id, $records->id,$records);
				$rt[$i] = $records;
                $rt[$i]['channels'] = $channel;
				$i++;
				//break;
            }
            return $rt;
        }
        return false;


    }

}
