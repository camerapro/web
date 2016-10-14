<?php

namespace frontend\models;

use common\models\CameraBase;
use Yii;


class Camera extends CameraBase
{
    public static function getListCam(){
        return self::findAll(['status' => 1]);
    }
}
