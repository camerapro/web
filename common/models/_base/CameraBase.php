<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "camera".
 *
 * @property integer $id
 * @property integer $recorder_id
 * @property string $name
 * @property string $streaming_url
 * @property string $channel
 * @property string $params
 * @property string $created_time
 * @property string $updated_time
 * @property integer $status
 * @property integer $thumb_version
 * @property integer $quality
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
            [['recorder_id', 'status', 'thumb_version', 'quality'], 'integer'],
            [['created_time', 'updated_time', 'activation_time'], 'safe'],
            [['name', 'streaming_url', 'channel', 'params'], 'string', 'max' => 255],
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
            'streaming_url' => 'Streaming Url',
            'channel' => 'Channel',
            'params' => 'Params',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'status' => 'Status',
            'thumb_version' => 'Thumb Version',
            'quality' => 'Quality',
            'activation_time' => 'Activation Time',
        ];
    }
}
