<?php

namespace frontend\models;

use common\models\_base\PermissionBase;
use Yii;


class Permission extends PermissionBase
{
    public static function getListPermissionById($user_id){
        $query = Permission::find()
            -> leftJoin('relations_user_permission_group', 'relations_user_permission_group.permission_group_id = permission.permission_group_id')
            -> leftJoin('relations_user_permission_group', 'relations_user_permission_group.permission_group_id = permission.permission_group_id')
            ->where(['=', 'relations_user_permission_group.user_id', $user_id])
            ->all();
        return $query;
    }

    public function getAll(){
        $data = [];
        $list = Permission::find()
            ->where(['=', 'parent_id', 0])
            ->asArray()
            ->all();
        foreach ($list as $item){
            $data[$item['id']]  = $item;
            $data[$item['id']]['child'] =  Permission::getChildPer($item['id']);
        }
        return $data;
    }

    public function getChildPer($parrent_id){
        return Permission::find()
            ->where(['=', 'parent_id', $parrent_id])
            ->asArray()
            ->all();
    }

    public function getPermissionName($pemission_ids){
        $list_permission_by_group = explode(',', $pemission_ids);
        $name = [];
        foreach ($list_permission_by_group as $item){
            $name[] =   Permission::findOne($item)->name;
        }
        $name = implode(', ', $name);
        return $name;
    }
}
