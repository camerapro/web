<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "camera".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $streaming_url
 * @property string $protocol
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
            [['category_id', 'port', 'order', 'status', 'thumb_version', 'user_id', 'agency_id'], 'integer'],
            [['streaming_url'], 'required'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'streaming_url', 'channel', 'params'], 'string', 'max' => 255],
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
            'protocol' => 'Protocol',
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
        ];
    }
}
