<?php

namespace frontend\models;

use common\models\CameraBase;
use Yii;


class Camera extends CameraBase
{
    public static function getListCam($protocol = 'http'){
        return self::findAll(['status' => 1, 'protocol'=>$protocol]);
    }
    public static function getListCamId($id){
        return self::findOne(['id' => $id]);
    }
}
