<?php

namespace frontend\models;

use Yii;
use common\models\_base\DepartmentBase;
/**
 * This is the model class for table "department".
 *
 * @property string $id
 * @property string $name
 * @property integer $company_id
 * @property integer $parent_id
 * @property integer $status
 * @property string $created_time
 * @property string $updated_time
 * @property string $description
 */
class DepartmentFrontend extends DepartmentBase
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên phòng',
            'company_id' => 'Công ty',
            'parent_id' => 'Thuộc phòng',
            'status' => 'Trạng thái',
            'created_time' => 'Ngày tạo',
            'updated_time' => 'Ngày cập nhật',
            'description' => 'Mô tả',
        ];
    }
}
