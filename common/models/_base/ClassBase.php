<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "class".
 *
 * @property string $id
 * @property string $name
 * @property integer $company_id
 * @property integer $parent_id
 * @property integer $status
 * @property string $created_time
 * @property string $updated_time
 * @property string $description
 * @property string $start_time
 * @property string $end_time
 */
class ClassBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['company_id', 'parent_id', 'status'], 'integer'],
            [['created_time', 'updated_time', 'start_time', 'end_time'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
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
            'company_id' => 'Company ID',
            'parent_id' => 'Parent ID',
            'status' => 'Status',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'description' => 'Description',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
        ];
    }
}
