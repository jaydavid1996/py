<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EventRoundMatch;

/**
 * EventRoundMatchSearch represents the model behind the search form about `common\models\EventRoundMatch`.
 */
class EventRoundMatchSearch extends EventRoundMatch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'event_team1_round_id', 'event_team2_round_id', 'team1_score', 'team2_score', 'match_status_id'], 'integer'],
            [['datetime_start', 'datetime_end'], 'safe'],
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
        $query = EventRoundMatch::find();

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
            'event_team1_round_id' => $this->event_team1_round_id,
            'event_team2_round_id' => $this->event_team2_round_id,
            'team1_score' => $this->team1_score,
            'team2_score' => $this->team2_score,
            'match_status_id' => $this->match_status_id,
            'datetime_start' => $this->datetime_start,
            'datetime_end' => $this->datetime_end,
        ]);

        return $dataProvider;
    }
}
