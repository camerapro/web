<?php

namespace frontend\models;

use common\models\_base\PermissionGroupBase;
use Yii;


class PermissionGroup extends PermissionGroupBase
{
    public function attributeLabels()
    {
        return [
            'name' => 'Tên quyền',
            'status' => 'Trạng thái',
            'permission_ids' => 'Danh sách quyền',
            'created_time' => 'Ngày tạo',
        ];
    }

    public function checkPerGr($user_id, $controller, $action){
        return false;
    }
}
