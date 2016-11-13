<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "relations_permission_rule".
 *
 * @property integer $id
 * @property integer $permission_id
 * @property string $controller_name
 * @property string $action_name
 * @property string $params
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
            [['params'], 'string'],
            [['controller_name', 'action_name'], 'string', 'max' => 255],
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
            'controller_name' => 'Controller Name',
            'action_name' => 'Action Name',
            'params' => 'Params',
        ];
    }
}
