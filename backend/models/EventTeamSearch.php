<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EventTeam;

/**
 * EventTeamSearch represents the model behind the search form about `common\models\EventTeam`.
 */
class EventTeamSearch extends EventTeam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'team_id', 'event_id', 'place_id', 'final_place_id', 'total_wins', 'total_draws', 'total_losses', 'total_score', 'seed_number'], 'integer'],
            [['total_time'], 'safe'],
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
        $query = EventTeam::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['seed_number'=>SORT_ASC]],
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
            'team_id' => $this->team_id,
            'event_id' => $this->event_id,
            'place_id' => $this->place_id,
            'final_place_id' => $this->final_place_id,
            'total_wins' => $this->total_wins,
            'total_draws' => $this->total_draws,
            'total_losses' => $this->total_losses,
            'total_score' => $this->total_score,
            'total_time' => $this->total_time,
            'seed_number' => $this->seed_number,
        ]);

        return $dataProvider;
    }
}
