<?php

namespace frontend\models;

use common\models\Camera;
use Yii;


class FrontendCamera extends Camera
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static function getListAllCam($user_id = NULL){
        if(empty($user_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }
        if(Yii::$app->user->identity->level ==4){
            $query = Camera::find()->all();
        }else{
            $query = Camera::find()
                -> leftJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
                ->where(['=', 'relations_cam_user.user_id', $user_id])
                ->all();
        }
        return $query;
    }
    
    public static function getListCam($user_id = NULL){
        if(empty($user_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }
        $query = Camera::find()
            ->innerJoin('relations_cam_user', 'relations_cam_user.cam_id=camera.id')
            ->where(['=', 'camera.status', 1])
            ->andWhere(['=', 'relations_cam_user.user_id', $user_id])
            ->all();
			//var_dump($query);
        return $query;
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
            'channel' => 'Kênh',
            'ip_address' => 'Địa chỉ Ip',
            'encoder_username' => 'Username đầu ghi',
            'encoder_password' => 'Mật khẩu đầu ghi',
            'protocol' => 'Giao thức',
            'port' => 'Cổng rtsp',
            'encoder_port' => 'Cổng Media',
            'channel' => 'Kênh',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'order' => 'Sắp xếp',
            'status' => 'Trạng thái',
            'encoder_model' => 'Loại thiết bị',
            'quality' => 'Chất lượng',
        ];
    }
}
