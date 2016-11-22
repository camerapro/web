<?php

namespace common\models\_base;

use Yii;

/**
 * This is the model class for table "tmp_video_period".
 *
 * @property integer $id
 * @property string $period_name
 * @property string $subject_name
 * @property string $class_name
 * @property string $teacher_name
 * @property integer $watch_count
 * @property integer $comment_count
 * @property integer $like_count
 * @property integer $dislike_count
 * @property string $start_time
 * @property string $end_time
 */
class TmpVideoPeriodBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tmp_video_period';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['watch_count', 'comment_count', 'like_count', 'dislike_count'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['period_name', 'subject_name', 'class_name', 'teacher_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'period_name' => 'Tiết học',
            'subject_name' => 'Môn học',
            'class_name' => 'Lớp',
            'teacher_name' => 'Giáo viên',
            'watch_count' => 'Số lượt xem',
            'comment_count' => 'Số lượt bình luận',
            'like_count' => 'Số lượt like',
            'dislike_count' => 'Số lượt dislike',
            'start_time' => 'Thời gian bắt đầu',
            'end_time' => 'Thời gian kết thúc',
        ];
    }
}
