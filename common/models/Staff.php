<?php

namespace common\models;

use common\models\_base\StaffBase;
use common\behaviors\ImageUploadBehavior;
use yii\web\UploadedFile;
use Yii;


class Staff extends StaffBase
{
    public $imageFile;
    public  $save_path;
    public  $image_name;
    public  $image_ext = '.png';
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            if (!is_dir($this->save_path)) {
                mkdir($this->save_path);
                chmod($this->save_path,'0777');
            }
            $this->imageFile->saveAs($this->save_path.'/'. $this->image_name . $this->image_ext );
            return true;
        } else {
            return false;
        }
    }
	public static  function add($params){
        $phone = new self;
        //var_dump($params);
        $tat->attributes = $params;
        return $phone->save(false);
    }
    public static  function getStaffByUserId($userId=0){
        $return = self::find()->where(['created_by'=>$userId])->all();
        $rt = array();
        foreach ($return as $value)
        {
            
			$value->image = \common\components\Common::getImage($value,'staff');
            $rt[] = $value;
        }
        return $rt;
    }
    public static  function getStaff($userId=0,$company_id =0){
        $staff = self::find()->where(['created_by'=>$userId]);
        if($company_id)
        {
            $return = self::find()->where(['company_id'=>$company_id])->all();
        }
        if($userId){
            $return = self::find()->where(['company_id'=>$company_id])->all();
        }
        $rt = array();
        foreach ($return as $value)
        {

            $value->image = \common\components\Common::getImage($value,'staff');
            $rt[] = $value;
        }
        return $rt;
    }
	
    public static  function getStaffFromAttCode($att_code=0,$company_id =0){
		if(!$att_code || !$company_id){
			return false;
		}
        $staff = self::find()->where(['att_code'=>$att_code]);
        if($company_id)
        {
            
			$staff->andWhere(['company_id'=>$company_id]);
        }
		return $staff->one();
    }
	public static  function getStaffFromCardCode($card_code=0,$company_id =0){
		if(!$card_code || !$company_id){
			return false;
		}
        $staff = self::find()->where(['card_code'=>$card_code]);
        if($company_id)
        {
            
			$staff->andWhere(['company_id'=>$company_id]);
        }
		return $staff->one();
    }
	public static  function getStaffFromCardId($card_id=0,$company_id =0){
		if(!$card_id || !$company_id){
			return false;
		}
        $staff = self::find()->where(['card_id'=>$card_id]);
        if($company_id)
        {
            $staff->andWhere(['company_id'=>$company_id]);
        }
		return $staff->one();
    }
    public static function getStaffById($staff_id)
    {
        $return = self::find()->where(['id'=>$staff_id])
            ->with('department')
            ->one();
    }
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
}
