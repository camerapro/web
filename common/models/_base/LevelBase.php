<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "level".
 *
 * @property integer $id
 * @property string $level_name
 * @property integer $status
 */
class LevelBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['level_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level_name' => 'Level Name',
            'status' => 'Status',
        ];
    }
}
