<?php

namespace common\models;

use Yii;
use common\models\_base\UserLogBase;

/**
 * This is the model class for table "user_log".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $user_username
 * @property string $ip
 * @property string $controller
 * @property string $action
 * @property string $activity
 * @property integer $object_id
 * @property string $object_name
 * @property string $params
 * @property string $created_time
 */
class UserLog extends UserLogBase
{
    
}
