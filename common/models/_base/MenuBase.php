<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parrent_id
 * @property string $icon
 * @property string $controller
 * @property string $action
 * @property string $params
 * @property string $created_time
 * @property integer $created_by
 * @property string $updated_time
 * @property integer $updated_by
 * @property integer $status
 * @property integer $order
 */
class MenuBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parrent_id', 'created_by', 'updated_by', 'status', 'order'], 'integer'],
            [['params'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'icon', 'controller', 'action'], 'string', 'max' => 255],
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
            'parrent_id' => 'Parrent ID',
            'icon' => 'Icon',
            'controller' => 'Controller',
            'action' => 'Action',
            'params' => 'Params',
            'created_time' => 'Created Time',
            'created_by' => 'Created By',
            'updated_time' => 'Updated Time',
            'updated_by' => 'Updated By',
            'status' => 'Status',
            'order' => 'Order',
        ];
    }
}
