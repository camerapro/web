<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "relations_cam_user".
 *
 * @property integer $int
 * @property integer $user_id
 * @property integer $cam_id
 * @property string $created_time
 * @property integer $created_by_id
 * @property string $created_by_name
 * @property integer $owner
 */
class RelationsCamUserBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relations_cam_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'cam_id', 'created_by_id', 'owner'], 'integer'],
            [['created_time'], 'safe'],
            [['created_by_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'int' => 'Int',
            'user_id' => 'User ID',
            'cam_id' => 'Cam ID',
            'created_time' => 'Created Time',
            'created_by_id' => 'Created By ID',
            'created_by_name' => 'Created By Name',
            'owner' => 'Owner',
        ];
    }
}
