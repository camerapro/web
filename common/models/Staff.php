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
            $value->image = 'http://api.thietbianninh.com/kute.jpg';
            $rt[] = $value;
        }
        return $rt;
    }
}
