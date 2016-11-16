<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "camera_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $config_params
 * @property integer $status
 * @property string $created_time
 */
class CameraTypeBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'camera_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['created_time'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['config_params'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'config_params' => 'Config Params',
            'status' => 'Status',
            'created_time' => 'Created Time',
        ];
    }
}
