<?php

namespace common\models\_base;

use Yii;

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
 * @property string $telephone
 * @property integer $status
 * @property string $balance
 * @property string $created_time
 * @property string $expired_time
 * @property string $updated_time
 * @property string $website
 * @property string $note
 */
class CompanyBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['country', 'status'], 'integer'],
            [['created_time', 'expired_time', 'updated_time'], 'safe'],
            [['name', 'website'], 'string', 'max' => 100],
            [['contact_name'], 'string', 'max' => 150],
            [['address', 'email', 'note'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 16],
            [['city'], 'string', 'max' => 32],
            [['telephone'], 'string', 'max' => 20],
            [['balance'], 'string', 'max' => 64],
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
            'name' => 'Name',
            'contact_name' => 'Contact Name',
            'address' => 'Address',
            'email' => 'Email',
            'phone' => 'Phone',
            'city' => 'City',
            'country' => 'Country',
            'telephone' => 'Telephone',
            'status' => 'Status',
            'balance' => 'Balance',
            'created_time' => 'Created Time',
            'expired_time' => 'Expired Time',
            'updated_time' => 'Updated Time',
            'website' => 'Website',
            'note' => 'Note',
        ];
    }
}
