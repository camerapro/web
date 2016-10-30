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
 * @property integer $camera_main_id
 * @property integer $camera_secondary_id
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
            [['category_id', 'port', 'order', 'camera_main_id', 'camera_secondary_id', 'user_id', 'agency_id', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'ip'], 'string', 'max' => 255],
            [['protocol'], 'string', 'max' => 15],
            [['description'], 'string', 'max' => 500],
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
            'camera_main_id' => 'Camera Main ID',
            'camera_secondary_id' => 'Camera Secondary ID',
            'user_id' => 'User ID',
            'agency_id' => 'Agency ID',
            'status' => 'Status',
        ];
    }
}
