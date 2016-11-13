<?php

namespace frontend\models;

use Yii;
use common\models\Tat;

/**
 * This is the model class for table "tat".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $ip
 * @property integer $port
 * @property string $protocol
 * @property string $created_time
 * @property string $updated_time
 * @property string $description
 * @property integer $order
 * @property integer $camera_main_id
 * @property integer $camera_secondary_id
 * @property integer $user_id
 * @property integer $agency_id
 * @property integer $status
 */
class TatFrontend extends Tat
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên máy',
            'category_id' => 'Danh mục',
            'ip' => 'IP',
            'port' => 'Cổng',
            'protocol' => 'Giao thức',
            'created_time' => 'Ngày tạo',
            'updated_time' => 'Cập nhật',
            'description' => 'Mô tả',
            'order' => 'Order',
            'camera_main_id' => 'Camera chính',
            'camera_secondary_id' => 'Camera phụ',
            'user_id' => 'User ID',
            'agency_id' => 'Agency ID',
            'status' => 'Status',
            'camera_ip' => 'Camera IP',
            'camera_port' => 'Camera Port',
            'camera_channel' => 'Kênh',
            'camera_username' => 'Tên đăng nhập',
            'camera_password' => 'Mật khẩu',
            'camera_model' => 'Loại thiết bị',
            'expired_time' => 'Hết hạn',
            'company' => 'Công ty',
        ];
    }
}
