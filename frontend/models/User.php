<?php

namespace frontend\models;

use Yii;

class User extends \common\models\User
{
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'username' => 'Tên đăng nhập',
            'level' => 'Level',
            'password' => 'Mật khẩu',
            'fullname' => 'Tên đầy đủ',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'birthday' => 'Ngày sinh',
            'gender' => 'Giới tính',
            'address' => 'Địa chỉ',
            'status' => 'Status',
            'created_time' => 'Ngày tạo',
            'updated_time' => 'Updated Time',
            'login_time' => 'Login Time',
            'language' => 'Ngôn ngữ',
            'avatar' => 'Ảnh đại diện',
        ];
    }

    public function rules()
    {
        return [
            [['point', 'level', 'gender', 'country', 'status'], 'integer'],
            [['username', 'password', 'fullname', 'email'], 'required', 'message'=>'Vui lòng nhập {attribute}'],
//            ['password', 'validatePassword'],
            [['birthday', 'created_time', 'updated_time', 'login_time'], 'safe'],
            [['username'], 'string', 'max' => 100],
            [['password', 'email', 'facebook_id', 'google_id', 'thumb_version', 'avatar'], 'string', 'max' => 255],
            [['fullname'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 16],
            [['address'], 'string', 'max' => 128],
            [['city'], 'string', 'max' => 32],
            [['language'], 'string', 'max' => 20],
            [['phone'], 'unique'],
        ];
    }

    public function validatePassword($attribute,$params)
    {
        $passLeng = strlen($this->password);
        if($passLeng<6){
            $this->addError('password', 'Incorrect username or password.');
        }
    }
}
