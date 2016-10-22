<?php

namespace frontend\models;

use common\models\_base\CameraBase;
use Yii;


class Camera extends CameraBase
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    
    public static function getListCam($protocol = 'http'){
        return self::findAll(['protocol'=>$protocol,'status'=>1]);
    }



    public static function getListCamId($id){
        return self::findOne($id);
    }
}
