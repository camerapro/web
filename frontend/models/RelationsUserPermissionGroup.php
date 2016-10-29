<?php

namespace frontend\models;

use common\models\_base\RelationsUserPermissionGroupBase;
use Yii;

/**
 * This is the model class for table "relations_user_permission_group".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $permistion_group_id
 */
class RelationsUserPermissionGroup extends RelationsUserPermissionGroupBase
{
        public function findByUser($user_id){
                return RelationsUserPermissionGroup::find()
                    ->where(['=', 'user_id', $user_id])
                    ->one();
        }

}
