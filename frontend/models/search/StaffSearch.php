<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\StaffFrontend;

/**
 * StaffSearch represents the model behind the search form about `frontend\models\StaffFrontend`.
 */
class StaffSearch extends StaffFrontend
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'card_id', 'department_id', 'created_by', 'updated_by', 'status', 'company_id', 'order', 'deleted'], 'integer'],
            [['name', 'phone', 'email', 'card_code', 'att_code', 'department_name', 'image', 'created_time', 'updated_time', 'description'], 'safe'],
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
        $query = StaffFrontend::find();

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
            'card_id' => $this->card_id,
            'department_id' => $this->department_id,
            'created_time' => $this->created_time,
            'created_by' => $this->created_by,
            'updated_time' => $this->updated_time,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
            'company_id' => $this->company_id,
            'order' => $this->order,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'card_code', $this->card_code])
            ->andFilterWhere(['like', 'att_code', $this->att_code])
            ->andFilterWhere(['like', 'department_name', $this->department_name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description]);
		 if (isset(Yii::$app->user->identity->level) && Yii::$app->user->identity->level < 4){
			 $company_id = Yii::$app->user->identity->company_id;
			 $dataProvider->query->andWhere(['=', 'staff.company_id', $company_id]);
		 }
        return $dataProvider;
    }
}
