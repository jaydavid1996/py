<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EventTeamRound;

/**
 * EventTeamRoundSearch represents the model behind the search form about `common\models\EventTeamRound`.
 */
class EventTeamRoundSearch extends EventTeamRound
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'event_team_id', 'event_round_id', 'match_result_id'], 'integer'],
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
        $query = EventTeamRound::find();

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
            'event_team_id' => $this->event_team_id,
            'event_round_id' => $this->event_round_id,
            'match_result_id' => $this->match_result_id,
        ]);

        return $dataProvider;
    }
}
