<?php

namespace api\models;

use common\models\_base\CameraBase;
use Yii;


class Camera extends CameraBase
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
	//public $activation_time;
	//public $model;
    public static function getListAllCam($user_id = NULL){
        if(empty($user_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }
        $query = Camera::find()
            -> leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
            ->where(['=', 'relations_cam_user.user_id', $user_id])
            ->all();
        return $query;
    }
    
    public static function getListCam($user_id = NULL,$recorder_id =0,$recorder=null){
        if(empty($user_id) && empty($recorder_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false; 
        }
		$return =[];
        if($recorder_id){
            $rec = self::find()
                ->select(['id','name','channel','params','camera.status','camera.recorder_id','streaming_url','relations_cam_user.user_id','quality','camera.activation_time'])
                ->leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
                ->where(['camera.status'=>1,'recorder_id'=>$recorder_id])
                ->andWhere(['=', 'relations_cam_user.user_id', $user_id])
                ->all();
			foreach($rec as $camera ){
				$camera->streaming_url = Camera::getStreamingUrl($camera,$recorder);
				$return[] = $camera;
	
			}
			return $return;
        }
        $rec = self::find()
		   ->select(['id','name','protocol','channel','params','camera.order','camera.status','camera.recorder_id','relations_cam_user.user_id','agency_id','quality','camera.activation_time'])
            ->leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
            ->where(['camera.status'=>1])
            ->andWhere(['=', 'relations_cam_user.user_id', $user_id])
            ->all();
			foreach($rec as $camera ){
				$records->streaming_url = self::getStreamingUrl($camera,$recorder);
				$return[] = $records;
	
			}
			return $return;
    }
	public static  function getStreamingUrl($camera,$recorder){
		if(!$camera)
			return '';
		$protocol = isset($recorder->protocol)?$recorder->protocol:'';
		if($protocol =='tcp')
			$protocol = 'rtsp';
		$ip = isset($recorder->ip)?$recorder->ip:'';
		$username = isset($recorder->username)?$recorder->username:'';
		$password = isset($recorder->password)?$recorder->password:'';
		$channel = isset($camera->channel)?$camera->channel:'';
		$quality = isset($camera->quality)?$camera->quality:0;
		$stream = $protocol."://".$ip."/?user=".$username."?password=".$password.'&channel='.$channel.'&stream='.$quality .'.sdp';
        return $stream ;
    }
    public static function getAllCamByGrandId($grand_id){
        $query = Camera::find()
            -> leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
            ->where(['=', 'camera.status', 1])
            ->andWhere(['=', 'relations_cam_user.user_id', $grand_id])
            ->all();
        return $query;
    }

    public static function getAllCamGranded($grand_id, $user_id){
        $query = Camera::find()
            -> leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
            ->where(['=', 'camera.status', 1])
            ->andWhere(['=', 'relations_cam_user.user_id', $user_id])
            ->andWhere(['=', 'relations_cam_user.created_by_id', $grand_id])
            ->all();
        return $query;
    }

    public static function getOneCamById($cam_id, $user_id = NULL){
        if(empty($user_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }
        $query = Camera::find()
            -> leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
            ->where(['=', 'camera.status', 1])
            ->andWhere(['=', 'relations_cam_user.user_id', $user_id])
            ->andWhere(['=', 'relations_cam_user.cam_id', $cam_id])
            ->one();
        return $query;
    }

    public static function getListCamId($id){
        return self::findOne($id);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên camera',
            'encoder_name' => 'Tên đầu ghi',
            'name' => 'Name camera',
            'streaming_url' => 'Link streaming',
            'protocol' => 'Giao thức',
            'port' => 'Cổng',
            'channel' => 'Kênh',
            'ip_address' => 'Địa chỉ Ip',
            'encoder_username' => 'Username đầu ghi',
            'encoder_password' => 'Mật khẩu đầu ghi',
            'protocol' => 'Giao thức',
            'port' => 'Cổng',
            'channel' => 'Kênh',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'order' => 'Sắp xếp',
            'status' => 'Trạng thái',
        ];
    }
}
