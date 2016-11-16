<?php

namespace common\models;

use common\models\_base\TimekeepingBase;
use common\models\Staff;
use common\models\Tat;
use Yii;

/**
 * This is the model class for table "timekeeping".
 *
 * @property integer $id
 * @property integer $status
 * @property string $card_code
 * @property string $staff_name
 * @property integer $tap_id
 * @property string $type
 * @property string $created_time
 * @property string $image
 * @property integer $staff_id
 */
class Timekeeping extends TimekeepingBase
{
    public static  function add($params){
        $tat = new self;
        $tat->attributes = $params;
        return $tat->save(false);
    }
    public static  function searchData($card_code=0,$staff_name=''){
        $staff = Timekeeping::find()->where(['and', ['card_code' => $card_code]])
            ->orFilterWhere(['like', 'staff_name', $staff_name])
            ->all();
        $rt = array();
        foreach ($staff as $value)
        {
            $value->image = \common\components\Common::getImage($value,'staff');
            $rt[] = $value;
        }
        return $rt;
    }
	public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'staff_id']);
    }
	public function getTat()
    {
        return $this->hasOne(Tat::className(), ['id' => 'tat_id']);
    }
}
