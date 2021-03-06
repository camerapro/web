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
 * @property integer $permission_group_id
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
 * @property string $client_name
 * @property integer $company_id
 * @property integer $company_admin
 * @property string $expired_time
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
            [['username', 'password', 'email'], 'required'],
            [['point', 'level', 'permission_group_id', 'gender', 'country', 'status', 'company_id', 'company_admin'], 'integer'],
            [['birthday', 'created_time', 'updated_time', 'login_time', 'expired_time'], 'safe'],
            [['username'], 'string', 'max' => 100],
            [['password', 'email', 'facebook_id', 'google_id', 'thumb_version', 'avatar'], 'string', 'max' => 255],
            [['fullname'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 16],
            [['address'], 'string', 'max' => 128],
            [['city'], 'string', 'max' => 32],
            [['language'], 'string', 'max' => 20],
            [['client_name'], 'string', 'max' => 50],
            [['username'], 'unique'],
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
            'permission_group_id' => 'Permission Group ID',
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
            'client_name' => 'Client Name',
            'company_id' => 'Company ID',
            'company_admin' => 'Company Admin',
            'expired_time' => 'Expired Time',
        ];
    }
}
