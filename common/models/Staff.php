<?php

namespace common\models;

use common\models\_base\StaffBase;
use Yii;


class Staff extends StaffBase
{
	public static  function add($params){
        $tat = new self;
        $tat->attributes = $params;
        return $tat->save(false);
    }
    public static  function getStaffByUserId($userId=0){
        return self::find()->where(['created_by'=>$userId])->asArray()->all();
    }
}
