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
 * @property integer $tap_id
 * @property string $type
 * @property string $created_time
 * @property string $image
 * @property integer $staff_id
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
            [['status', 'tap_id', 'staff_id'], 'integer'],
            [['created_time'], 'safe'],
            [['image'], 'string'],
            [['card_code', 'staff_name'], 'string', 'max' => 100],
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
            'tap_id' => 'Tap ID',
            'type' => 'Type',
            'created_time' => 'Created Time',
            'image' => 'Image',
            'staff_id' => 'Staff ID',
        ];
    }
}
