<?php

namespace common\models;

use common\models\_base\TatBase;
use Yii;


class Tat extends TatBase
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    public static  function add($params){
        $tat = new self;
        $tat->attributes = $params;
        return $tat->save(false);
    }
	public static  function getTats($tat_id =0,$user_id=0,$company_id=0){
        if(empty($user_id) && empty($tat_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }
        if($tat_id){
            $tat = self::find()
                ->where(['status'=>1,'id'=>$tat_id,'user_id'=>$user_id])->asArray()
                ->all();
        }
		elseif($company_id){
            $tat = self::find()
                ->where(['status'=>1,'id'=>$company_id,'user_id'=>$user_id])->asArray()
                ->all();
        }
		else{
			 $tat = self::find()
            ->where(['status'=>1,'user_id'=>$user_id])->asArray()
            ->all();
		}
		//echo "data";
        return $tat;


    }
}
