<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "permission".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $created_time
 * @property integer $status
 * @property integer $menu_parent_id
 * @property integer $order
 */
class PermissionBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'status', 'menu_parent_id', 'order'], 'integer'],
            [['created_time'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'parent_id' => 'Parent ID',
            'created_time' => 'Created Time',
            'status' => 'Status',
            'menu_parent_id' => 'Menu Parent ID',
            'order' => 'Order',
        ];
    }
}
