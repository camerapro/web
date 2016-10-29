<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "relations_permission_rule".
 *
 * @property integer $id
 * @property integer $permission_id
 * @property string $action_name
 * @property string $controller_name
 */
class RelationsPermissionRuleBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relations_permission_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permission_id'], 'integer'],
            [['action_name', 'controller_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'permission_id' => 'Permission ID',
            'action_name' => 'Action Name',
            'controller_name' => 'Controller Name',
        ];
    }
}
