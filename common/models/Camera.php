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
}
