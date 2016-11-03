<?php

namespace common\components;

use common\models\_base\CameraBase;
use frontend\models\Camera;

class Common
{
    public static function validatePhone($phone) {
        $phone = trim($phone);
        if(strpos($phone,"84")===0){
            $phone = "0".substr($phone,"2");
        }else if(strpos($phone,"0")!==0){
            $phone = "0".$phone;
        }
        $pattern = "/^(089|086|088|090|091|092|093|094|095|096|097|098|099|0121|0122|0123|0124|0125|0126|0127|0128|0129|0121|0120||0161|0162|0163|0164|0165|0166|0167|0168|0169)([0-9]{7})$/";
        return preg_match($pattern,$phone);
    }

    public static function validateEmail($email){
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$";

        if (eregi($pattern, $email)){
            return true;
        }
        else {
            return false;
        }
    }

    public static function getLinkStream($camera_id){
        $camera_model = CameraBase::findOne($camera_id);
        if($camera_model->protocol == 'http')
            return $camera_model->ip_address;
        elseif ($camera_model->protocol == 'rtsp'){
            if($camera_model->encoder_model == 'DAHUA'){
                return 'rtsp://' . $camera_model->encoder_username . ':' . $camera_model->encoder_password . '@' . $camera_model->ip_address. ':' . $camera_model->port . '/cam/realmonitor?channel=1&subtype=0';
            }
            return 'rtsp://' .$camera_model->ip_address. ':' . $camera_model->port . '/user=' . $camera_model->encoder_username . '&password='. $camera_model->encoder_password . '&channel=' . $camera_model->channel . '&stream='. $camera_model->quality .'.sdp';
        }
    }

    public static function getLinkStreamByQuality($camera_id, $quality){
        $camera_model = CameraBase::findOne($camera_id);
        if($camera_model->protocol == 'http')
            return $camera_model->ip_address;
        elseif ($camera_model->protocol == 'rtsp')
            return 'rtsp://' .$camera_model->ip_address. ':' . $camera_model->port . '/user=' . $camera_model->encoder_username . '&password='. $camera_model->encoder_password . '&channel=' . $camera_model->channel . '&stream='. $quality .'.sdp';
    }

    public static function getLinkStreamByModelDAHUA($camera_id){
        $camera_model = CameraBase::findOne($camera_id);
        return 'rtsp://' . $camera_model->encoder_username . ':' . $camera_model->encoder_password . '@' . $camera_model->ip_address . 'cam/realmonitor?channel=1&subtype=0';

}

}