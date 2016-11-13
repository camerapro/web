<?php

namespace common\models;

use Yii;
use common\models\_base\CompanyBase;
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
class Company extends CompanyBase
{
    
}
