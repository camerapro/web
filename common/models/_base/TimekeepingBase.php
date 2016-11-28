<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "timekeeping".
 *
 * @property integer $id
 * @property integer $status
 * @property string $card_code
 * @property string $staff_name
 * @property string $staff_phone
 * @property integer $tat_id
 * @property string $type
 * @property string $created_time
 * @property string $image
 * @property integer $staff_id
 * @property integer $deleted
 * @property integer $company_id
 * @property integer $department_id
 */
class TimekeepingBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timekeeping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'tat_id', 'staff_id', 'deleted', 'company_id', 'department_id'], 'integer'],
            [['created_time'], 'safe'],
            [['image'], 'string'],
            [['card_code', 'staff_name'], 'string', 'max' => 100],
            [['staff_phone'], 'string', 'max' => 25],
            [['type'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'card_code' => 'Card Code',
            'staff_name' => 'Staff Name',
            'staff_phone' => 'Staff Phone',
            'tat_id' => 'Tat ID',
            'type' => 'Type',
            'created_time' => 'Created Time',
            'image' => 'Image',
            'staff_id' => 'Staff ID',
            'deleted' => 'Deleted',
            'company_id' => 'Company ID',
            'department_id' => 'Department ID',
        ];
    }
}
