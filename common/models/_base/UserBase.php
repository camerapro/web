<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property integer $point
 * @property integer $level
 * @property string $password
 * @property string $fullname
 * @property string $email
 * @property string $phone
 * @property string $birthday
 * @property integer $gender
 * @property string $address
 * @property string $city
 * @property integer $country
 * @property integer $status
 * @property string $facebook_id
 * @property string $google_id
 * @property string $created_time
 * @property string $updated_time
 * @property string $login_time
 * @property string $language
 * @property string $thumb_version
 * @property string $avatar
 */
class UserBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'fullname', 'email'], 'required'],
            [['point', 'level', 'gender', 'country', 'status'], 'integer'],
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'point' => 'Point',
            'level' => 'Level',
            'password' => 'Password',
            'fullname' => 'Fullname',
            'email' => 'Email',
            'phone' => 'Phone',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
            'address' => 'Address',
            'city' => 'City',
            'country' => 'Country',
            'status' => 'Status',
            'facebook_id' => 'Facebook ID',
            'google_id' => 'Google ID',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'login_time' => 'Login Time',
            'language' => 'Language',
            'thumb_version' => 'Thumb Version',
            'avatar' => 'Avatar',
        ];
    }
}
