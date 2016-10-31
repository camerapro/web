<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "camera".
 *
 * @property integer $id
 * @property string $name
 * @property string $encoder_name
 * @property integer $category_id
 * @property string $streaming_url
 * @property string $ip_address
 * @property string $encoder_username
 * @property string $encoder_password
 * @property string $protocol
 * @property integer $encoder_port
 * @property integer $port
 * @property string $channel
 * @property string $params
 * @property string $created_time
 * @property string $updated_time
 * @property integer $order
 * @property integer $status
 * @property integer $thumb_version
 * @property integer $user_id
 * @property integer $agency_id
 * @property string $encoder_model
 */
class CameraBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'camera';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'encoder_port', 'port', 'order', 'status', 'thumb_version', 'user_id', 'agency_id'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'encoder_name', 'streaming_url', 'ip_address', 'encoder_username', 'encoder_password', 'channel', 'params', 'encoder_model'], 'string', 'max' => 255],
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
            'encoder_name' => 'Encoder Name',
            'category_id' => 'Category ID',
            'streaming_url' => 'Streaming Url',
            'ip_address' => 'Ip Address',
            'encoder_username' => 'Encoder Username',
            'encoder_password' => 'Encoder Password',
            'protocol' => 'Protocol',
            'encoder_port' => 'Encoder Port',
            'port' => 'Port',
            'channel' => 'Channel',
            'params' => 'Params',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'order' => 'Order',
            'status' => 'Status',
            'thumb_version' => 'Thumb Version',
            'user_id' => 'User ID',
            'agency_id' => 'Agency ID',
            'encoder_model' => 'Encoder Model',
        ];
    }
}
