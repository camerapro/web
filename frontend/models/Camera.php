<?php

namespace frontend\models;

use common\models\_base\CameraBase;
use Yii;


class Camera extends CameraBase
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    
    public static function getListCam($user_id = NULL, $protocol = 'http'){
        if(empty($user_id)){

            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }

//        return self::findAll(['protocol'=>$protocol,'status'=>1]);
        $query = Camera::find()
            -> leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
            ->where(['=', 'camera.protocol', $protocol])
            ->andWhere(['=', 'camera.status', 1])
            ->andWhere(['=', 'relations_cam_user.user_id', $user_id])
            ->all();
        return $query;
    }
    public static function getAllCamByGrandId($grand_id, $protocol = 'http'){
        //  return self::findAll(['protocol'=>$protocol, '']);
        $query = Camera::find()
            -> leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
            ->where(['=', 'camera.protocol', $protocol])
            ->andWhere(['=', 'camera.status', 1])
            ->andWhere(['=', 'relations_cam_user.user_id', $grand_id])
            ->all();
        return $query;
    }

    public static function getAllCamGranded($grand_id, $user_id, $protocol = 'http'){
        //  return self::findAll(['protocol'=>$protocol, '']);
        $query = Camera::find()
            -> leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
            ->where(['=', 'camera.protocol', $protocol])
            ->andWhere(['=', 'camera.status', 1])
            ->andWhere(['=', 'relations_cam_user.user_id', $user_id])
            ->andWhere(['=', 'relations_cam_user.created_by_id', $grand_id])
            ->all();
        return $query;
    }

    public static function getListCamId($id){
        return self::findOne($id);
    }
}
