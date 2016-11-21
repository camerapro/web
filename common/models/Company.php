<?php

namespace common\models;

use Yii;
use common\models\_base\CompanyBase;

class Company extends CompanyBase
{
	public static  function getList($company_id=0,$staff_id=0){
		if($staff_id){
			$staff =  \common\models\Staff::find()
				->where(['id'=>$staff_id])->one();
			if($staff){
				$company_id = $staff->company_id;
				return self::find()
				->where(['id'=>$company_id])->asArray()
				->all();
			}
			return null;
				
				
		}
		if($company_id){
			return self::find()
				->where(['id'=>$company_id])->asArray()
				->all();
		}
		return self::find()
				->where(['status'=>1])->asArray()
				->all();
    }
}
