<?php

namespace common\models\_base;

use Yii;

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
 * @property integer $user_id
 * @property integer $status
 * @property string $camera_ip
 * @property integer $camera_port
 * @property integer $camera_channel
 * @property string $camera_username
 * @property string $camera_password
 * @property string $camera_model
 * @property string $expired_time
 * @property integer $company
 */
class TatBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'port', 'order', 'user_id', 'status', 'camera_port', 'camera_channel', 'company'], 'integer'],
            [['created_time', 'updated_time', 'expired_time'], 'safe'],
            [['name', 'ip'], 'string', 'max' => 255],
            [['protocol'], 'string', 'max' => 15],
            [['description'], 'string', 'max' => 500],
            [['camera_ip'], 'string', 'max' => 50],
            [['camera_username', 'camera_password', 'camera_model'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
            'ip' => 'Ip',
            'port' => 'Port',
            'protocol' => 'Protocol',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'description' => 'Description',
            'order' => 'Order',
            'user_id' => 'User ID',
            'status' => 'Status',
            'camera_ip' => 'Camera Ip',
            'camera_port' => 'Camera Port',
            'camera_channel' => 'Camera Channel',
            'camera_username' => 'Camera Username',
            'camera_password' => 'Camera Password',
            'camera_model' => 'Camera Model',
            'expired_time' => 'Expired Time',
            'company' => 'Company',
        ];
    }
}
