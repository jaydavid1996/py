<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OccasionTeam;

/**
 * OccasionTeamSearch represents the model behind the search form about `common\models\OccasionTeam`.
 */
class OccasionTeamSearch extends OccasionTeam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'occasion_id', 'team_id', 'overall_place_id', 'final_overall_place_id', 'overall_wins', 'overall_draws', 'overall_losses'], 'integer'],
            [['team_name', 'overall_time'], 'safe'],
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
        $query = OccasionTeam::find();

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
            'occasion_id' => $this->occasion_id,
            'team_id' => $this->team_id,
            'overall_place_id' => $this->overall_place_id,
            'final_overall_place_id' => $this->final_overall_place_id,
            'overall_wins' => $this->overall_wins,
            'overall_draws' => $this->overall_draws,
            'overall_losses' => $this->overall_losses,
            'overall_time' => $this->overall_time,
        ]);

        $query->andFilterWhere(['like', 'team_name', $this->team_name]);

        return $dataProvider;
    }
}
