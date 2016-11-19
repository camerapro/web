<?php

namespace common\models;

use Yii;
use common\models\_base\CompanyBase;

class Company extends CompanyBase
{
	public static  function getList($company_id=0){
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
