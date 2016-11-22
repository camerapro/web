<?php

namespace frontend\models;

use Yii;
use common\models\Staff;
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
class StaffFrontend extends Staff
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên nhân viên',
            'phone' => 'Số điện thoại',
            'card_code' => 'Mã số thẻ',
            'card_id' => 'ID thẻ',
            'department_id' => 'Phòng ban',
            'image' => 'Image',
            'created_time' => 'Ngày tạo',
            'created_by' => 'Người tạo',
            'updated_time' => 'Cập nhật',
            'updated_by' => 'Người cập nhật',
            'status' => 'Trạng thái',
            'description' => 'Mô tả',
            'company_id' => 'Công ty',
        ];
    }
}
