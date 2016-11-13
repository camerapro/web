<?php

namespace frontend\models;

use Yii;
use common\models\Company;
/**
 * This is the model class for table "company".
 *
 * @property string $id
 * @property string $name
 * @property string $contact_name
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $city
 * @property integer $country
 * @property integer $status
 * @property string $balance
 * @property string $created_time
 * @property string $expired_time
 * @property string $updated_time
 * @property string $website
 */
class CompanyFrontend extends Company
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên công ty',
            'contact_name' => 'Người liên hệ',
            'address' => 'Địa chỉ',
            'email' => 'Email',
            'phone' => 'Số di động',
            'city' => 'Tỉnh thành',
            'country' => 'Quốc gia',
            'status' => 'Trạng thái',
            'telephone' => 'Telephone',
            'balance' => 'Tài khoản ',
            'created_time' => 'Ngày tạo',
            'expired_time' => 'Hết hạn',
            'updated_time' => 'Ngày cập nhật',
            'website' => 'Website',
            'note' => 'Ghi chú',
        ];
    }
}
