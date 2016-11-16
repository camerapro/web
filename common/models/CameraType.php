<?php

namespace common\models;


use Yii;
use common\models\_base\CameraTypeBase;
/**
 * This is the model class for table "camera_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $config_params
 * @property integer $status
 * @property string $created_time
 */
class CameraType extends CameraTypeBase{
	
	public static  function add($params){
        $tat = new self;
        $tat->attributes = $params;
         $tat->save(false);
		 return $tat;
    }
}
