<?php

namespace frontend\models;

use common\models\_base\RelationsPermissionRuleBase;
use Yii;

/**
 * This is the model class for table "relations_permission_rule".
 *
 * @property integer $id
 * @property integer $persission_id
 * @property string $action_name
 * @property string $controller_name
 */
class RelationsPermissionRule extends RelationsPermissionRuleBase
{
    public static function getListAction($permission_id, $controller, $action){
        $query = RelationsPermissionRule::find()
            ->where(['=', 'relations_permission_rule.permission_id', $permission_id])
            ->andWhere(['=', 'relations_permission_rule.controller_name', $controller])
            ->andWhere(['=', 'relations_permission_rule.action_name', $action])
            ->one();
        if($query) return $query;
        else return false;
    }
}
