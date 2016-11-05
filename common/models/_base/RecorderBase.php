<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "recorder".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $ip
 * @property string $username
 * @property string $password
 * @property string $protocol
 * @property integer $port
 * @property string $params
 * @property string $activation_time
 * @property string $created_time
 * @property string $updated_time
 * @property integer $order
 * @property integer $status
 * @property integer $user_id
 * @property integer $agency_id
 * @property string $model
 */
class RecorderBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recorder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'port', 'order', 'status', 'user_id', 'agency_id'], 'integer'],
            [['activation_time', 'created_time', 'updated_time'], 'safe'],
            [['name', 'ip', 'username', 'password', 'params', 'model'], 'string', 'max' => 255],
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
            'ip' => 'Ip',
            'username' => 'Username',
            'password' => 'Password',
            'protocol' => 'Protocol',
            'port' => 'Port',
            'params' => 'Params',
            'activation_time' => 'Activation Time',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'order' => 'Order',
            'status' => 'Status',
            'user_id' => 'User ID',
            'agency_id' => 'Agency ID',
            'model' => 'Model',
        ];
    }
}
