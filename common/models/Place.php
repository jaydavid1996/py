<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property integer $id
 * @property string $place
 *
 * @property EventTeam[] $eventTeams
 * @property EventTeam[] $eventTeams0
 * @property OccasionTeam[] $occasionTeams
 * @property OccasionTeam[] $occasionTeams0
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place'], 'required'],
            [['place'], 'string', 'max' => 45],
            [['place'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'place' => 'Place',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeams()
    {
        return $this->hasMany(EventTeam::className(), ['final_place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeams0()
    {
        return $this->hasMany(EventTeam::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccasionTeams()
    {
        return $this->hasMany(OccasionTeam::className(), ['final_overall_place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccasionTeams0()
    {
        return $this->hasMany(OccasionTeam::className(), ['overall_place_id' => 'id']);
    }
}
