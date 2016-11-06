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
	public static  function getTats($tat_id =0,$user_id=0){
        if(empty($user_id) && empty($tat_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }
        if($tat_id){
            $tat = self::find()
                ->where(['status'=>1,'id'=>$tat_id,'user_id'=>$user_id])->asArray()
                ->one();
            return $tat;
			
        }
		 $tat = self::find()
            ->where(['status'=>1,'user_id'=>$user_id])
            ->all();
        $rt = [];
		//echo "data";
		$cam = [];
        if($tat) {
			$i =0;
            foreach ($tat as $tats) {
				$camera_main_id = $tats->camera_main_id;
				if($camera_main_id){
					$cam_main = \api\models\Camera::findOne($camera_main_id);
					$cam['camera_main_ip'] = $cam_main->ip_address;
					$cam['cam_main_name'] = $cam_main->name;
					$cam['port_main'] = $cam_main->port;
					$cam['category_main_id'] = $cam_main->category_id;
					$cam['channel_main'] = $cam_main->channel;
					$cam['protocol_main'] = $cam_main->protocol;
					$cam['order_main'] = $cam_main->order;
				}
                $rest =array_merge($cam,$tats);
				$i++;
				//break;
            }
            return $rest;
        }
        $tat = self::find()
            ->where(['status'=>1,'user_id'=>$user_id])
            ->all();
            return $tat;


    }
}
