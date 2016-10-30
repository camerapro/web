<?php

namespace common\components;

use \frontend\models\Permission;
use frontend\models\PermissionGroup;
use \frontend\models\RelationsPermissionRule;
use frontend\models\RelationsUserPermissionGroup;
use yii\web\Controller;
use Yii;
use yii\base\InlineAction;
use yii\helpers\Url;

class FrontendController extends Controller
{
    public function beforeAction($action) {
        if (\Yii::$app->getUser()->isGuest){
            Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl)->send();
            return;
        }
        $user_id = Yii::$app->user->identity->id;
        //check required
        $controller =  strtolower(Yii::$app->controller->id);
        $action_controller =  strtolower(Yii::$app->controller->action->id);
        $current_params_id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $check_per_session = isset ($_SESSION[$user_id . '_' . $controller . '_' . $action_controller . '_' . $current_params_id])  ? $_SESSION[$user_id . '_' . $controller . '_' . $action_controller. '_' . $current_params_id] : NULL;
        if(isset($check_per_session)){
            if($check_per_session == 'has_permission'){
                return parent::beforeAction($action);
            }else{
                Yii::$app->getResponse()->redirect('/site/permission', 302)->send();
                return;
            }
        }
        $permission_enable = false;
        $list_permistion_gr = RelationsUserPermissionGroup::findByUser($user_id)->permission_group_id;
        $permission = PermissionGroup::findOne($list_permistion_gr)->permission_ids;
        $list_permistion = explode(',', $permission);
        foreach ($list_permistion as $per){
            $check = RelationsPermissionRule::getListAction($per, $controller, $action_controller);
            if($check){
                if(!isset($check['params']) || empty($check['params']) || trim($check['params']) == 'id=' . $current_params_id){
                    $permission_enable = true;
                    $_SESSION[$user_id . '_' . $controller . '_' . $action_controller . '_' . $current_params_id] = 'has_permission';
                    continue;
                }
            }
        }
        if(!$permission_enable){
            $_SESSION[$user_id . '_' . $controller . '_' . $action_controller . '_' . $current_params_id] = 'no_permission';
            Yii::$app->getResponse()->redirect('/site/permission', 302)->send();
            return;
        }
        return parent::beforeAction($action);
    }
}
