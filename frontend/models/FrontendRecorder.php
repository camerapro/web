<?php

namespace frontend\models;;

use common\models\Recorder;
use Yii;



class FrontendRecorder extends Recorder
{
	public static function getRecorderById($user_id = 0){
        if(empty($user_id)){
            $user_id = Yii::$app->user->identity->id;
            if(empty($user_id)) return false;
        }
	    $recoder = Recorder::find()->where(['user_id'=>$user_id])->asArray()->all();
        return $recoder;
    }

}
