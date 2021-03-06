<?php

namespace common\models;

use common\models\_base\PermissionBase;
use common\models\_base\PermissionGroupBase;
use frontend\models\FrontendMenu;
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
        $list_perent_id = FrontendMenu::find()->where(['=', 'parrent_id', 0])
            ->asArray()->all();
            foreach ($list_perent_id as $item){
                $data[$item['id']]  = $item;
                $data[$item['id']]['list_ids'] =  self::getAllByParent($item['id']);
        }

        return $data;
    }

    public static  function getAllByParent($id){
        $data = [];
        $list = self::find()
            ->where(['=', 'parent_id', 0])
            ->andWhere(['=', 'menu_parent_id', $id])
            ->andWhere(['=', 'status', 1])
            ->asArray()
            ->all();
        foreach ($list as $item){
            $data[$item['id']]  = $item;
            $data[$item['id']]['child'] =  self::getChildPer($item['id']);
        }
        return $data;
    }


    public static  function getAllByIds($list_permission_ids){
       /* $data = [];
        $list = self::find()
            ->where(['=', 'parent_id', 0])
            ->andWhere('id IN('.$list_permission_ids.')')
            ->asArray()
            ->all();
        foreach ($list as $item){
            $data[$item['id']]  = $item;
            $data[$item['id']]['child'] =  self::getChildPerByIds($item['id'], $list_permission_ids);
        }
        return $data;*/


        $list_perent_id = FrontendMenu::find()->where(['=', 'parrent_id', 0])
            ->asArray()->all();
        foreach ($list_perent_id as $item){
            $data[$item['id']]  = $item;
            $data[$item['id']]['list_ids'] =  self::getAllByParentIds($item['id'], $list_permission_ids);
        }

        return $data;


    }
    public static  function getAllByParentIds($parent_idm, $list_permission_ids){
        $data = [];
        $list = self::find()
            ->where(['=', 'parent_id', 0])
            ->andWhere(['=', 'menu_parent_id', $parent_idm])
            ->andWhere(['=', 'status', 1])
            ->andWhere('id IN('.$list_permission_ids.')')
            ->asArray()
            ->all();
        foreach ($list as $item){
            $data[$item['id']]  = $item;
            $data[$item['id']]['child'] =  self::getChildPerByIds($item['id'], $list_permission_ids);
        }
        return $data;
    }

    public function getChildPer($parrent_id){
        return self::find()
            ->where(['=', 'parent_id', $parrent_id])
            ->andWhere(['=', 'status', 1])
            ->asArray()
            ->all();
    }

    public function getChildPerByIds($parrent_id, $list_permission_ids){
            return self::find()
                ->where(['=', 'parent_id', $parrent_id])
                ->andWhere(['=', 'status', 1])
                ->andWhere('id IN('.$list_permission_ids.')')
                ->asArray()
                ->all();
        }

    public static function getAllPermissionGroup(){
        return \common\models\_base\PermissionGroupBase::find()
            ->where(['status'=>1])
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
            return $permission_group->permission_ids;
        return null;
    }
    public static function getUserPermission($pemission_ids){
        $list_permission_by_group = explode(',', $pemission_ids);
        $name = [];
        foreach ($list_permission_by_group as $item){
            if(self::findOne($item)){
                $name[] =   self::findOne($item)->name;
            }
        }
        $name = implode(', ', $name);
        return $name;
    }
    public static function getPermissionName($pemission_ids){
        $list_permission_by_group = explode(',', $pemission_ids);
        $name = [];
        foreach ($list_permission_by_group as $item){
            if(self::findOne($item)){
                $name[] =   self::findOne($item)->name;
            }

        }
        $name = implode(', ', $name);
        return $name;
    }
}
