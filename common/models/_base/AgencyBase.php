<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "agency".
 *
 * @property string $id
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $hotline
 * @property string $website
 * @property string $skype
 * @property string $city
 * @property integer $country
 * @property integer $status
 * @property string $balance
 * @property string $created_time
 * @property string $updated_time
 */
class AgencyBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['country', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'skype'], 'string', 'max' => 100],
            [['address', 'email', 'hotline', 'website'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 16],
            [['city'], 'string', 'max' => 32],
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
            'address' => 'Address',
            'email' => 'Email',
            'phone' => 'Phone',
            'hotline' => 'Hotline',
            'website' => 'Website',
            'skype' => 'Skype',
            'city' => 'City',
            'country' => 'Country',
            'status' => 'Status',
            'balance' => 'Balance',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }
}
