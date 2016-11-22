<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $card_code
 * @property integer $card_id
 * @property string $att_code
 * @property integer $department_id
 * @property string $department_name
 * @property string $image
 * @property string $created_time
 * @property integer $created_by
 * @property string $updated_time
 * @property integer $updated_by
 * @property integer $status
 * @property string $description
 * @property integer $company_id
 * @property integer $order
 * @property integer $deleted
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
            [['name'], 'required'],
            [['card_id', 'department_id', 'created_by', 'updated_by', 'status', 'company_id', 'order', 'deleted'], 'integer'],
            [['image'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'department_name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 200],
            [['card_code', 'att_code'], 'string', 'max' => 100],
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
            'email' => 'Email',
            'card_code' => 'Card Code',
            'card_id' => 'Card ID',
            'att_code' => 'Att Code',
            'department_id' => 'Department ID',
            'department_name' => 'Department Name',
            'image' => 'Image',
            'created_time' => 'Created Time',
            'created_by' => 'Created By',
            'updated_time' => 'Updated Time',
            'updated_by' => 'Updated By',
            'status' => 'Status',
            'description' => 'Description',
            'company_id' => 'Company ID',
            'order' => 'Order',
            'deleted' => 'Deleted',
        ];
    }
}
