<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $card_code
 * @property integer $card_id
 * @property integer $class_id
 * @property string $class_name
 * @property string $image
 * @property string $created_time
 * @property integer $created_by
 * @property string $updated_time
 * @property integer $updated_by
 * @property integer $status
 * @property string $description
 * @property integer $company_id
 */
class StudentBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['card_id', 'class_id', 'created_by', 'updated_by', 'status', 'company_id'], 'integer'],
            [['image'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'class_name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
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
            'phone' => 'Phone',
            'card_code' => 'Card Code',
            'card_id' => 'Card ID',
            'class_id' => 'Class ID',
            'class_name' => 'Class Name',
            'image' => 'Image',
            'created_time' => 'Created Time',
            'created_by' => 'Created By',
            'updated_time' => 'Updated Time',
            'updated_by' => 'Updated By',
            'status' => 'Status',
            'description' => 'Description',
            'company_id' => 'Company ID',
        ];
    }
}
