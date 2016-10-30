<?php

namespace frontend\models;

use common\models\_base\NewsBase;
use Yii;

class News extends NewsBase
{
    public function attributeLabels()
    {
        return [
            'title' => 'Tiêu đề',
            'desc_content' => 'Mô tả ngắn',
            'content' => 'Nội dung',
            'created_time' => 'Thời gian tạo',
            'updated_time' => 'Thời gian cập nhật',
            'created_by_id' => 'Tạo bởi',
            'status' => 'Trạng thái',
        ];
    }
}
