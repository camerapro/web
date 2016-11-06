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
                ->all();
			
        }
		else{
			 $tat = self::find()
            ->where(['status'=>1,'user_id'=>$user_id])->asArray()
            ->all();
		}
		
        $rt = [];
		//echo "data";
		
        if($tat) {
			$i =0;
			$rest = [];
            foreach ($tat as $tats) {
				$cam_main = [];
				$cam_2nd = [];
				$camera_main_id = $tats['camera_main_id'];
				$camera_2nd_id = $tats['camera_secondary_id'];
				if(!empty($camera_main_id)){
					$cam = \api\models\Camera::findOne($camera_main_id);
					$cam_main['camera_main_ip'] = $cam->ip_address;
					$cam_main['cam_main_name'] = $cam->name;
					$cam_main['port_main'] = $cam->port;
					$cam_main['category_main_id'] = $cam->category_id;
					$cam_main['channel_main'] = $cam->channel;
					$cam_main['protocol_main'] = $cam->protocol;
					$cam_main['order_main'] = $cam->order;
				}
				if(!empty($camera_2nd_id)){
					$cam = \api\models\Camera::findOne($camera_2nd_id);
					$cam_2nd['camera_2nd_ip'] = $cam->ip_address;
					$cam_2nd['cam_2nd_name'] = $cam->name;
					$cam_2nd['port_2nd'] = $cam->port;
					$cam_2nd['category_2nd_id'] = $cam->category_id;
					$cam_2nd['channel_2nd'] = $cam->channel;
					$cam_2nd['protocol_2nd'] = $cam->protocol;
					$cam_2nd['order_2nd'] = $cam->order;
				}
				//var_dump($tats,$cam_main,$cam_2nd);die();
                $rest[] =array_merge($tats,$cam_2nd,$cam_main);
				$i++;
				//break;
            }
            return $rest;
        }
		return false;


    }
}
