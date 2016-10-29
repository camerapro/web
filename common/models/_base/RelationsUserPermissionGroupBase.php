<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "relations_user_permission_group".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $permission_group_id
 */
class RelationsUserPermissionGroupBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relations_user_permission_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'permission_group_id'], 'integer'],
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
            'permission_group_id' => 'Permission Group ID',
        ];
    }
}
