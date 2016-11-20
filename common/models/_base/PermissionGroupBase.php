<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "permission_group".
 *
 * @property integer $id
 * @property string $name
 * @property string $permission_ids
 * @property string $created_time
 * @property integer $status
 * @property integer $created_by_id
 * @property string $created_by_name
 */
class PermissionGroupBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permission_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permission_ids'], 'string'],
            [['created_time'], 'safe'],
            [['status', 'created_by_id'], 'integer'],
            [['name', 'created_by_name'], 'string', 'max' => 255],
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
            'permission_ids' => 'Permission Ids',
            'created_time' => 'Created Time',
            'status' => 'Status',
            'created_by_id' => 'Created By ID',
            'created_by_name' => 'Created By Name',
        ];
    }
}
