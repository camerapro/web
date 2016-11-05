<?php

namespace common\models;


use Yii;
use common\models\_base\RecorderBase;


/**
 * This is the model class for table "tat".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $streaming_url
 * @property string $ip_address
 * @property integer $port
 * @property string $protocol
 * @property string $created_time
 * @property string $updated_time
 * @property integer $order
 * @property integer $camera_id
 * @property integer $user_id
 * @property integer $agency_id
 * @property integer $status
 */
class Recorder extends RecorderBase
{
    public static  function add($params){
        $recorder = new self;
        $recorder->attributes = $params;
        $rt = $recorder->save(false);
        return $recorder;
    }
    public static  function add($params){
        $recorder = new self;
        $recorder->attributes = $params;
        $rt = $recorder->save(false);
        return $recorder;
    }
}
