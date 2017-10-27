<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Occasion;

/**
 * OccasionSearch represents the model behind the search form about `common\models\Occasion`.
 */
class OccasionSearch extends Occasion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'department_id'], 'integer'],
            [['occasion', 'description', 'date_start', 'date_end', 'date_created'], 'safe'],
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
        $query = Occasion::find();

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
            'department_id' => $this->department_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'occasion', $this->occasion])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
