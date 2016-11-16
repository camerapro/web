<?php

namespace frontend\models;

use Yii;
use common\models\Timekeeping;

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
class TimekeepingFrontend extends Timekeeping
{
   
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Trạng thái',
            'card_code' => 'Mã thẻ',
            'staff_name' => 'Tên nhân viên',
            'tap_id' => 'Máy chấm',
            'type' => 'Kiểu',
            'created_time' => 'Thời gian',
            'image' => 'Ảnh',
            'staff_id' => 'Nhân viên',
        ];
    }
}
