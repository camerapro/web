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

    public static function getListCam($user_id = NULL,$recorder_id =0){
        if(empty($user_id) && empty($recorder_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }
        if($recorder_id){
            return self::find()
//                ->select(['id','name','protocol','channel','params','camera.order','camera.status','relations_cam_user.user_id','agency_id','quality','camera.activation_time'])
                ->leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
                ->where(['camera.status'=>1,'recorder_id'=>$recorder_id])
                ->andWhere(['=', 'relations_cam_user.user_id', $user_id])
                ->all();
        }
        return self::find()
//            ->select(['id','name','protocol','channel','params','camera.order','camera.status','relations_cam_user.user_id','agency_id','quality','camera.activation_time'])
            ->leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
            ->where(['camera.status'=>1])
            ->andWhere(['=', 'relations_cam_user.user_id', $user_id])
            ->all();

    }
}
