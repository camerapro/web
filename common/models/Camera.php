<?php

namespace common\models;


use Yii;
use common\models\_base\CameraBase;
use common\models\_base\RelationsCamUserBase;


class Camera extends CameraBase
{
    public static  function add($params){
        $cam = new self;
        $cam->attributes = $params;
        $rt = $cam->save(false);
        if($rt){
            $camera_user = new RelationsCamUserBase();
            $camera_user->cam_id = $cam->id;
            $camera_user->created_by_id = Yii::$app->user->identity->id;
            $camera_user->user_id = Yii::$app->user->identity->id;
            $camera_user->created_by_name = Yii::$app->user->identity->username;
            $camera_user->created_time = date('Y-m-d H:i:s');
            $camera_user->save(false);
        }
        return $cam;
    }

    public static function getListCam($user_id = NULL,$recorder_id =0,$recorder=null){
        if(empty($user_id) && empty($recorder_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }
        $return =[];
        if($recorder_id){
            $rec = self::find()
                ->select(['id','name','channel','params','camera.status','camera.recorder_id','streaming_url','relations_cam_user.user_id','quality','camera.activation_time'])
                ->leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
                ->where(['recorder_id'=>$recorder_id])
				->orWhere(['camera.status'=>0,'camera.status'=>1]);
                ->andWhere(['=', 'relations_cam_user.user_id', $user_id])
                ->all();
            foreach($rec as $camera ){
                $camera->streaming_url = Camera::getStreamingUrl($camera,$recorder);
                $return[] = $camera;

            }
            return $return;
        }
        $rec = self::find()
            ->select(['id','name','protocol','channel','params','camera.order','camera.status','camera.recorder_id','relations_cam_user.user_id','agency_id','quality','camera.activation_time'])
            ->leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
            ->where(['camera.status'=>1])
            ->andWhere(['=', 'relations_cam_user.user_id', $user_id])
            ->all();
        foreach($rec as $camera ){
            $camera->streaming_url = self::getStreamingUrl($camera,$recorder);
            $return[] = $camera;

        }
        return $return;


    }
    public static  function getStreamingUrl($camera,$recorder){
        if(!$camera)
            return '';
        $protocol = isset($recorder->protocol)?$recorder->protocol:'';
		if($protocol =='http')
		{
			 return $camera->streaming_url;
		}
        if($protocol =='tcp')
            $protocol = 'rtsp';
        $ip = isset($recorder->ip)?$recorder->ip:'';
        $username = isset($recorder->username)?$recorder->username:'';
        $password = isset($recorder->password)?$recorder->password:'';
        $channel = isset($camera->channel)?$camera->channel:'';
        $quality = 1;
        $stream = $protocol."://".$ip."/?user=".$username."?password=".$password.'&channel='.$channel.'&stream='.$quality .'.sdp';
        return $stream ;
    }
	
}
