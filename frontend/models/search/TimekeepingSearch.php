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
	public $staff;
	public $tat;
    public function rules()
    {
        return [
            [['id', 'status', 'tat_id', 'staff_id','deleted'], 'integer'],
            [['card_code', 'staff_name', 'type', 'created_time', 'image','staff','tat'], 'safe'],
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
        $query = TimekeepingFrontend::find()->innerJoinWith('staff')->innerJoinWith('tat')->orderBy(['created_time' => SORT_DESC]);;
        
        // add conditions that should always apply here
		

        $this->load($params);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
		$deleted = isset($params['deleted'])?$params['deleted']:0;
        // grid filtering conditions
		
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
		$staff_name = explode(',',$this->staff_name);
		$i= 0;
		foreach($staff_name as $val){
			$i++;
			$dataProvider->query->andWhere(['like', 'staff.name', $val]);
			break;
		}
        return $dataProvider;
    }
}
