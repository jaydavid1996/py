<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Gallery as GalleryModel;

/**
 * Gallery represents the model behind the search form about `common\models\Gallery`.
 */
class GallerySearch extends GalleryModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'occasion_id', 'user_id', 'status'], 'integer'],
            [['file_name', 'extension', 'date_created', 'date_updated'], 'safe'],
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
        $query = GalleryModel::find();

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
            'user_id' => $this->user_id,
            'status' => $this->status,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
        ]);

        $query->andFilterWhere(['like', 'gallery_name', $this->gallery_name])
            ->andFilterWhere(['like', 'occasion_id', $this->occasion_id]);

        return $dataProvider;
    }
}
