<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "occasion_team".
 *
 * @property integer $id
 * @property integer $occasion_id
 * @property integer $team_id
 * @property string $team_name
 * @property integer $overall_place_id
 * @property integer $final_overall_place_id
 * @property integer $overall_wins
 * @property integer $overall_draws
 * @property integer $overall_losses
 * @property string $overall_time
 *
 * @property Place $finalOverallPlace
 * @property Occasion $occasion
 * @property Place $overallPlace
 * @property Team $team
 */
class OccasionTeam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'occasion_team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['occasion_id', 'team_id'], 'required'],
            [['occasion_id', 'team_id', 'overall_place_id', 'final_overall_place_id', 'overall_wins', 'overall_draws', 'overall_losses'], 'integer'],
            [['overall_time'], 'safe'],
            [['team_name'], 'string', 'max' => 45],
            [['occasion_id', 'team_id'], 'unique', 'targetAttribute' => ['occasion_id', 'team_id'], 'message' => 'The combination of Occasion ID and Team ID has already been taken.'],
            [['final_overall_place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['final_overall_place_id' => 'id']],
            [['occasion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occasion::className(), 'targetAttribute' => ['occasion_id' => 'id']],
            [['overall_place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['overall_place_id' => 'id']],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['team_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'occasion_id' => 'Occasion ID',
            'team_id' => 'Team ID',
            'team_name' => 'Team Name',
            'overall_place_id' => 'Overall Place ID',
            'final_overall_place_id' => 'Final Overall Place ID',
            'overall_wins' => 'Overall Wins',
            'overall_draws' => 'Overall Draws',
            'overall_losses' => 'Overall Losses',
            'overall_time' => 'Overall Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinalOverallPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'final_overall_place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccasion()
    {
        return $this->hasOne(Occasion::className(), ['id' => 'occasion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOverallPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'overall_place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_id']);
    }
}
