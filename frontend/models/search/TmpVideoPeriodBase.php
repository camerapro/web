<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\_base\TmpVideoPeriodBase as TmpVideoPeriodBaseModel;

/**
 * TmpVideoPeriodBase represents the model behind the search form about `\common\models\_base\TmpVideoPeriodBase`.
 */
class TmpVideoPeriodBase extends TmpVideoPeriodBaseModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'watch_count', 'comment_count', 'like_count', 'dislike_count'], 'integer'],
            [['period_name', 'subject_name', 'class_name', 'teacher_name', 'start_time', 'end_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TmpVideoPeriodBaseModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'watch_count' => $this->watch_count,
            'comment_count' => $this->comment_count,
            'like_count' => $this->like_count,
            'dislike_count' => $this->dislike_count,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);

        $query->andFilterWhere(['like', 'period_name', $this->period_name])
            ->andFilterWhere(['like', 'subject_name', $this->subject_name])
            ->andFilterWhere(['like', 'class_name', $this->class_name])
            ->andFilterWhere(['like', 'teacher_name', $this->teacher_name]);

        return $dataProvider;
    }
}
