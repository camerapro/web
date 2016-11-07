<?php

namespace common\models;

use common\models\_base\PermissionBase;
use common\models\_base\PermissionGroupBase;
use Yii;


class Permission extends PermissionBase
{
    
    public static function getListPermissionById($user_id){
        $query = self::find()
            -> leftJoin('relations_user_permission_group', 'relations_user_permission_group.permission_group_id = permission.permission_group_id')
            ->where(['=', 'relations_user_permission_group.user_id', $user_id])
            ->all();
        return $query;
    }

    public static  function getAll(){
        $data = [];
        $list = self::find()
            ->where(['=', 'parent_id', 0])
            ->asArray()
            ->all();
        foreach ($list as $item){
            $data[$item['id']]  = $item;
            $data[$item['id']]['child'] =  self::getChildPer($item['id']);
        }
        return $data;
    }

    public function getChildPer($parrent_id){
        return self::find()
            ->where(['=', 'parent_id', $parrent_id])
            ->asArray()
            ->all();
    }
    public static function getAllPermission(){
        return self::find()
            ->where(['status'=>1])
            ->asArray()
            ->all();
    }
    /**
     * @param $pemission_ids
     * @return array|string
     */
    public static  function getListPermissionByGroup($permission_group_id){
        $permission_group = PermissionGroupBase::findOne($permission_group_id);
        if($permission_group)
            return self::getPermissionName($permission_group->permission_ids);
        return null;
    }

    public static function getPermissionName($pemission_ids){
        $list_permission_by_group = explode(',', $pemission_ids);
        $name = [];
        foreach ($list_permission_by_group as $item){
            $name[] =   self::findOne($item)->name;
        }
        $name = implode(', ', $name);
        return $name;
    }
}
