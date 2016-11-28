<?php

namespace frontend\models;

use common\models\ClassModel;
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
 */
class ClassFrontend extends ClassModel
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên lớp học',
            'company_id' => 'Tên trường',
            'parent_id' => 'Trung tâm',
            'status' => 'Status',
            'created_time' => 'Ngày tạo',
            'updated_time' => 'Cập nhật',
            'start_time' => 'Ngày khai giảng',
            'end_time' => 'Ngày bế giảng',
            'description' => 'Mô tả',
        ];
    }
}
