<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property integer $id
 * @property string $name
 * @property string $card_code
 * @property integer $card_id
 * @property string $department
 * @property string $image
 * @property string $created_time
 * @property integer $created_by
 * @property string $updated_time
 * @property integer $updated_by
 * @property integer $status
 * @property string $description
 */
class StaffBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_id', 'created_by', 'updated_by', 'status'], 'integer'],
            [['image'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'department'], 'string', 'max' => 255],
            [['card_code'], 'string', 'max' => 100],
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
            'card_code' => 'Card Code',
            'card_id' => 'Card ID',
            'department' => 'Department',
            'image' => 'Image',
            'created_time' => 'Created Time',
            'created_by' => 'Created By',
            'updated_time' => 'Updated Time',
            'updated_by' => 'Updated By',
            'status' => 'Status',
            'description' => 'Description',
        ];
    }
}
