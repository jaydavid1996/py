<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EventTeamPlayer;

/**
 * EventTeamPlayerSearch represents the model behind the search form about `common\models\EventTeamPlayer`.
 */
class EventTeamPlayerSearch extends EventTeamPlayer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'event_team_id', 'player_id', 'year_id', 'section_id'], 'integer'],
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
        $query = EventTeamPlayer::find();

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
            'player_id' => $this->player_id,
            'year_id' => $this->year_id,
            'section_id' => $this->section_id,
        ]);

        return $dataProvider;
    }
}
