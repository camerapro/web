<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TimekeepingFrontend;

/**
 * TimekeepingSearch represents the model behind the search form about `frontend\models\TimekeepingFrontend`.
 */
class TimekeepingSearch extends TimekeepingFrontend
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'tat_id', 'staff_id','deleted'], 'integer'],
            [['card_code', 'staff_name', 'type', 'created_time', 'image'], 'safe'],
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
        $query = TimekeepingFrontend::find()->innerJoinWith('staff')->innerJoinWith('tat');
        
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
		$deleted = isset($params['deleted'])?$params['deleted']:0;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'timekeeping.status' => $this->status,
            'tat_id' => $this->tat_id,
            'staff_id' => $this->staff_id,
            'deleted' => $this->deleted,
        ]);
		
        $query->andFilterWhere(['like', 'card_code', $this->card_code])
            ->andFilterWhere(['like', 'staff_name', $this->staff_name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'deleted', $this->deleted])
            ->andFilterWhere(['like', 'image', $this->image]);
		
		$dataProvider->query->where(['timekeeping.deleted'=>$deleted]);
		if($params['from_time']){
			$dataProvider->query->andWhere(['>=', 'timekeeping.created_time', $params['from_time']]);
		}
		if($params['to_time']){
			 $dataProvider->query->andWhere(['<=', 'timekeeping.created_time', $params['to_time']]);
		}

		 if (isset(Yii::$app->user->identity->level) && Yii::$app->user->identity->level < 4){
			 $company_id = Yii::$app->user->identity->company_id;
			 $dataProvider->query->andWhere(['=', 'timekeeping.company_id', $company_id]);
		 }
        return $dataProvider;
    }
}
