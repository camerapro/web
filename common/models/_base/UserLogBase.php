<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "user_log".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $user_username
 * @property string $ip
 * @property string $controller
 * @property string $action
 * @property string $activity
 * @property integer $object_id
 * @property string $object_name
 * @property string $params
 * @property string $created_time
 */
class UserLogBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'object_id'], 'integer'],
            [['params'], 'string'],
            [['created_time'], 'safe'],
            [['user_username'], 'string', 'max' => 50],
            [['ip', 'activity'], 'string', 'max' => 100],
            [['controller', 'action', 'object_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'user_username' => 'User Username',
            'ip' => 'Ip',
            'controller' => 'Controller',
            'action' => 'Action',
            'activity' => 'Activity',
            'object_id' => 'Object ID',
            'object_name' => 'Object Name',
            'params' => 'Params',
            'created_time' => 'Created Time',
        ];
    }
}
