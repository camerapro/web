<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Camera;

/**
 * CameraSearch represents the model behind the search form about `frontend\models\Camera`.
 */
class CameraSearch extends Camera
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'port', 'order', 'status', 'thumb_version', 'user_id', 'agency_id'], 'integer'],
            [['name','encoder_name', 'streaming_url', 'protocol', 'channel', 'params', 'created_time', 'updated_time'], 'safe'],
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
        $query = Camera::find();

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
            'category_id' => $this->category_id,
            'port' => $this->port,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
            'order' => $this->order,
            'status' => $this->status,
            'thumb_version' => $this->thumb_version,
            'user_id' => $this->user_id,
            'agency_id' => $this->agency_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'encoder_name', $this->encoder_name])
            ->andFilterWhere(['like', 'streaming_url', $this->streaming_url])
            ->andFilterWhere(['like', 'protocol', $this->protocol])
            ->andFilterWhere(['like', 'channel', $this->channel])
            ->andFilterWhere(['like', 'params', $this->params]);

        return $dataProvider;
    }
}
