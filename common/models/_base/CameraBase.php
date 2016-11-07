<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "camera".
 *
 * @property integer $id
 * @property integer $recorder_id
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
 * @property integer $quality
 * @property integer $recorder_id
 * @property string $activation_time
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
<<<<<<< HEAD
            [['recorder_id', 'category_id', 'encoder_port', 'port', 'order', 'status', 'thumb_version', 'user_id', 'agency_id', 'quality'], 'integer'],
            [['created_time', 'updated_time', 'activation_time'], 'safe'],
=======
            [['category_id', 'encoder_port', 'port', 'order', 'status', 'thumb_version', 'user_id', 'agency_id', 'quality','recorder_id'], 'integer'],
            [['created_time', 'updated_time','activation_time'], 'safe'],
>>>>>>> 05265ffb60f9b245628508fcc6ee3d178a42f8b4
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
            'recorder_id' => 'Recorder ID',
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
            'quality' => 'Quality',
<<<<<<< HEAD
            'activation_time' => 'Activation Time',
=======
            'recorder_id' => 'recorder ID',
>>>>>>> 05265ffb60f9b245628508fcc6ee3d178a42f8b4
        ];
    }
}
