<?php

namespace frontend\models;

use common\models\_base\RelationsPermissionRuleBase;
use Yii;


class RelationsPermissionRule extends RelationsPermissionRuleBase
{
    public static function getListAction($permission_id, $controller, $action, $params=NULL){
        if($params){
            $query = RelationsPermissionRule::find()
                ->where(['=', 'relations_permission_rule.permission_id', $permission_id])
                ->andWhere(['=', 'relations_permission_rule.controller_name', $controller])
                ->andWhere(['=', 'relations_permission_rule.action_name', $action])
                ->andWhere(['=', 'relations_permission_rule.params', $params])
                ->one();
        }else{
            $query = RelationsPermissionRule::find()
                ->where(['=', 'relations_permission_rule.permission_id', $permission_id])
                ->andWhere(['=', 'relations_permission_rule.controller_name', $controller])
                ->andWhere(['=', 'relations_permission_rule.action_name', $action])
                ->one();
        }
        if($query) return $query;
        else return false;
    }
}
