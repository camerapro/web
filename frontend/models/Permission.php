<?php

namespace frontend\models;

use common\models\Permission;
use frontend\models\RelationsUserPermissionGroup;
use Yii;


class Permission extends Permission
{


    public static function checkShowMenu($user_id, $controller, $action){
        $controller = strtolower($controller);
        $action = strtolower($action);
        $check_per_session = isset ($_SESSION[$user_id . '_' . $controller . '_' . $action])  ? $_SESSION[$user_id . '_' . $controller . '_' . $action] : NULL;
        if(isset($check_per_session)){
            if($check_per_session == 'has_permission'){
                return true;
            }else{
                return false;
            }
        }
        $list_permistion_gr = FrontendUser::findOne($user_id)->permission_group_id;
        $permission = PermissionGroup::findOne($list_permistion_gr)->permission_ids;
        $list_permistion = explode(',', $permission);
        foreach ($list_permistion as $per){
            $check = RelationsPermissionRule::getListAction($per, $controller, $action);
            if($check) {
                $_SESSION[$user_id . '_' . $controller . '_' . $action] = 'has_permission';
                return true;
            }
        }
        $_SESSION[$user_id . '_' . $controller . '_' . $action] = 'no_permission';
        return false;
    }
}
