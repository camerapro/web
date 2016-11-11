<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\FrontendRecorder;

/**
 * RecorderSearch represents the model behind the search form about `frontend\models\FrontendRecorder`.
 */
class RecorderSearch extends FrontendRecorder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'media_port', 'port_stream', 'port', 'order', 'status', 'user_id', 'agency_id'], 'integer'],
            [['name', 'ip', 'username', 'password', 'protocol', 'params', 'activation_time', 'created_time', 'updated_time', 'model', 'channels'], 'safe'],
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
        $query = FrontendRecorder::find();

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
            'media_port' => $this->media_port,
            'port_stream' => $this->port_stream,
            'port' => $this->port,
            'activation_time' => $this->activation_time,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
            'order' => $this->order,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'agency_id' => $this->agency_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'protocol', $this->protocol])
            ->andFilterWhere(['like', 'params', $this->params])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'channels', $this->channels]);

        return $dataProvider;
    }
}
