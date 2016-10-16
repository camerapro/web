<?php

namespace frontend\models;

use common\models\CameraBase;
use Yii;


class Camera extends CameraBase
{
    public static function getListCam($protocol = 'http'){
        return self::findAll(['protocol'=>$protocol]);
    }
    public static function getListCamId($id){
        return self::findOne(['id' => $id]);
    }
}
