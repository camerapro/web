<?php

namespace common\models\_base;

use Yii;

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
            [['category_id', 'port', 'order', 'camera_id', 'user_id', 'agency_id', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'streaming_url', 'ip_address'], 'string', 'max' => 255],
            [['protocol'], 'string', 'max' => 15],
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
            'streaming_url' => 'Streaming Url',
            'ip_address' => 'Ip Address',
            'port' => 'Port',
            'protocol' => 'Protocol',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'order' => 'Order',
            'camera_id' => 'Camera ID',
            'user_id' => 'User ID',
            'agency_id' => 'Agency ID',
            'status' => 'Status',
        ];
    }
}
