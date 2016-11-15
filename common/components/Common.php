<?php

namespace common\components;

use common\models\_base\CameraBase;
use common\models\Recorder;
use frontend\models\Camera;
use Yii;

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
    public static function getImage($data,$type ='staff')
    {
        $company_id = isset($data->company_id)?$data->company_id :'';
        return Yii::$app->params['images'][$type]['url'].'/'.  $company_id.'/'.$data->id.'.png';
    }
    public static function uploadFile($file, $target, $object, $extension, $options = array(), $endcode = false)
    {
        $fileName =  'test'. $extension;
        $upload = $target . '/' . $fileName;

        if ($endcode) {
            $width = 120;
            $height = 120;
            if ($options) {
                $width = $options['width'];
                $height = $options['height'];
            }

            $imgEncode = $file;
            $data = str_replace('data:image/png;base64,', '', $imgEncode);
            $data = str_replace('data:image/jpeg;base64,', '', $data);
            $data = str_replace(' ', '+', $data);
            $data = base64_decode($data);
            if (!file_exists($target)) {
                mkdir($target, 0755, true);
            }

            if (is_file($upload))
                unlink($upload);
            file_put_contents($upload, $data);

            $success = Common::copyAndResizeImage($upload, $upload, $width, $height);
            if ($success)
                return $fileName;
        }

        if ($file) {
            if (!file_exists($target)) {
                mkdir($target, 0755, true);
            }
            if (is_file($upload))
                unlink($upload);

            $source = $file['tmp_name'];
            if ($options) {
                $width = $options['width'];
                $height = $options['height'];
                move_uploaded_file($source, $upload);
                $success = Common::copyAndResizeImage($upload, $upload, $width, $height);
                if ($success)
                    return $fileName;
            } else {
                if (move_uploaded_file($source, $upload))
                    return $fileName;
            }
        }

        return null;

    }
    /**
     * @param $fileSource
     * @param $fileDest
     * @param int $newWidth
     * @param int $newHeight
     * @return bool
     */
    public static function copyAndResizeImage($fileSource, $fileDest, $newWidth = 0, $newHeight = 0)
    {
        if (!file_exists($fileSource)) {
            return false;
        }

        $sourceFileInfo = getimagesize($fileSource);
        $width = $sourceFileInfo[0];
        $height = $sourceFileInfo[1];
        $mime = $sourceFileInfo["mime"];
        if (!$newWidth) $newWidth = $width;
        if (!$newHeight) $newHeight = $height;

        $xR = $newWidth / $width;
        $yR = $newHeight / $height;
        if ($xR < $yR) {
            $newHeight = floor($height * $xR);
        } elseif ($xR > $yR) {
            $newWidth = floor($width * $yR);
        }

        $thumbnail = imagecreatetruecolor($newWidth, $newHeight);
        switch ($mime) {
            case "image/jpeg":
                $source = imagecreatefromjpeg($fileSource);
                break;
            case "image/gif":
                $source = imagecreatefromgif($fileSource);
                break;
            case "image/png":
                $source = imagecreatefrompng($fileSource);
                break;
        }
        $white = imagecolorallocate($thumbnail, 255, 255, 255);
        imagefill($thumbnail, 0, 0, $white);
        if (!imagecopyresized($thumbnail, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height)) {
            return false;
        }
        if (!imagejpeg($thumbnail, $fileDest)) return false;
        if (!imagedestroy($source)) return false;
        return true;
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
        $recorder_model = Recorder::findOne($camera_model->recorder_id);
        if($recorder_model->protocol == 'http')
            return $recorder_model->ip;
        elseif ($recorder_model->protocol == 'rtsp'){
            $channel = (int) $camera_model->channel + 1;
            if(strtoupper($recorder_model->model) == 'DAHUA'){
                return 'rtsp://' . $recorder_model->username . ':' . $recorder_model->password . '@' . $recorder_model->ip. ':' . $recorder_model->port_stream . '/cam/realmonitor?channel='.$channel.'&subtype='.  $camera_model->quality;
            }
            return 'rtsp://' .$recorder_model->ip. ':' . $recorder_model->port_stream . '/user=' . $recorder_model->username . '&password='. $recorder_model->password . '&channel=' . $channel . '&stream='. $camera_model->quality .'.sdp';
        }
    }

    public static function getLinkStreamByQuality($camera_id, $quality){
        $camera_model = CameraBase::findOne($camera_id);
        if($camera_model->protocol == 'http')
            return $camera_model->ip_address;
        elseif ($camera_model->protocol == 'rtsp'){
            if(strtoupper($camera_model->encoder_model) == 'DAHUA'){
                return 'rtsp://' . $camera_model->encoder_username . ':' . $camera_model->encoder_password . '@' . $camera_model->ip_address. ':' . $camera_model->port . '/cam/realmonitor?channel='.$camera_model->channel.'&subtype='.  $quality;
            }else{
                return 'rtsp://' .$camera_model->ip_address. ':' . $camera_model->port . '/user=' . $camera_model->encoder_username . '&password='. $camera_model->encoder_password . '&channel=' . $camera_model->channel . '&stream='. $quality .'.sdp';
            }
        }
    }

    public static function getLinkStreamByModelDAHUA($camera_id){
        $camera_model = CameraBase::findOne($camera_id);
        return 'rtsp://' . $camera_model->encoder_username . ':' . $camera_model->encoder_password . '@' . $camera_model->ip_address . 'cam/realmonitor?channel=1&subtype=0';

}

}