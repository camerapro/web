<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TatFrontend;

/**
 * TatSearch represents the model behind the search form about `frontend\models\TatFrontend`.
 */
class TatSearch extends TatFrontend
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'port', 'order', 'user_id', 'status', 'camera_port', 'camera_channel', 'company'], 'integer'],
            [['name', 'ip', 'protocol', 'created_time', 'updated_time', 'description', 'camera_ip', 'camera_username', 'camera_password', 'camera_model', 'expired_time'], 'safe'],
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
        $query = TatFrontend::find();

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
            'user_id' => $this->user_id,
            'status' => $this->status,
            'camera_port' => $this->camera_port,
            'camera_channel' => $this->camera_channel,
            'expired_time' => $this->expired_time,
            'company' => $this->company,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'protocol', $this->protocol])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'camera_ip', $this->camera_ip])
            ->andFilterWhere(['like', 'camera_username', $this->camera_username])
            ->andFilterWhere(['like', 'camera_password', $this->camera_password])
            ->andFilterWhere(['like', 'camera_model', $this->camera_model]);

        return $dataProvider;
    }
}
