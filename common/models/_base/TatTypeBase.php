<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "tat_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_time
 * @property string $updated_time
 * @property integer $status
 */
class TatTypeBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tat_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_time', 'updated_time'], 'safe'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'status' => 'Status',
        ];
    }
}
