<?php

namespace common\models;

use common\models\_base\TimekeepingBase;
use Yii;

/**
 * This is the model class for table "timekeeping".
 *
 * @property integer $id
 * @property integer $status
 * @property string $card_code
 * @property string $staff_name
 * @property integer $tap_id
 * @property string $type
 * @property string $created_time
 * @property string $image
 * @property integer $staff_id
 */
class Timekeeping extends TimekeepingBase
{
    public static  function add($params){
        $tat = new self;
        $tat->attributes = $params;
        return $tat->save(false);
    }
    public static  function getByUserId($userId=0){
        $return = self::find()->where(['created_by'=>$userId])->all();
        $rt = array();
        foreach ($return as $value)
        {
            $value->image = 'http://api.thietbianninh.com/kute.jpg';
            $rt[] = $value;
        }
        return $rt;
    }
}
