<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $desc_content
 * @property string $content
 * @property string $created_time
 * @property string $updated_time
 * @property integer $created_by_id
 * @property integer $status
 */
class NewsBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['created_by_id', 'status'], 'integer'],
            [['title', 'desc_content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'desc_content' => 'Desc Content',
            'content' => 'Content',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
            'created_by_id' => 'Created By ID',
            'status' => 'Status',
        ];
    }
}
