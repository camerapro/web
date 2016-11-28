<?php

namespace common\models;

use Yii;
use common\models\_base\DepartmentBase;

/**
 * This is the model class for table "department".
 *
 * @property string $id
 * @property string $name
 * @property integer $company_id
 * @property integer $parent_id
 * @property integer $status
 * @property string $created_time
 * @property string $updated_time
 * @property string $description
 */
class Department extends DepartmentBase
{
    public static  function getList($id =0,$staff_id=0){
		if($staff_id){
			$staff =  \common\models\Staff::find()
				->where(['id'=>$staff_id])->one();
			if($staff){
				$id = $staff->department_id;
				return self::find()
				->where(['id'=>$id])->asArray()
				->all();
			}
			return null;

		}
		if($id){
			return self::find()
				->where(['id'=>$id])->asArray()
				->all();
		}
		return self::find()
				->where(['status'=>1])->asArray()
				->all();
    }
	public static function getDepartmentByLocalId($local_id)
    {
       return self::find()->where(['local_department_id'=>$local_id])
            ->one();
    }
}
