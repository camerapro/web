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
        $tat->save(false);
        return  $tat;
    }
    public static  function searchData($card_code ='',$staff_name='',$company_id=0,$department_id=0,$from='',$to='',$status){
        $staff = Timekeeping::find()->where(['timekeeping.company_id' => $company_id,'timekeeping.deleted'=>0,'timekeeping.status'=>$status]);
        if($department_id)
           $staff->andWhere(['=','timekeeping.department_id',(int)$department_id]);

        if($from){
            $staff->andWhere(['>=', 'timekeeping.created_time', $from]);
        }
        if($to){
            $staff->andWhere(['<=', 'timekeeping.created_time', $to]);
        }
        $staff->with('staff');
        $staff->with('tat');
        $staff->with('tat');
        $staff = $staff->all();
//var_dump($staff);
        $rt = array();
        foreach ($staff as $value)
        {
            $value->image = \common\components\Common::getImage($value,'timekeeping');
            if($value->staff){
                $value->image_base = isset($value->staff)?\common\components\Common::getImage($value->staff->id,'staff'):"";
                $department = \common\models\Staff::getStaffById($value->staff->id);
                $department_name ='';
                if($department)
                    $department_name = $department->name;
                $value->department_name = $department_name;
                $value->staff_phone = isset($value->staff)? $value->staff->phone:'';
            }

            $value->tat_name = isset($value->tat)? $value->tat->name:'';
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
