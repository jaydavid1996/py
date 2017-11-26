<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event_round_match".
 *
 * @property string $id
 * @property string $event_team1_round_id
 * @property string $event_team2_round_id
 * @property integer $team1_score
 * @property integer $team2_score
 * @property integer $match_status_id
 * @property string $datetime_start
 * @property string $datetime_end
 *
 * @property EventTeamRound $eventTeam1Round
 * @property EventTeamRound $eventTeam2Round
 */
class EventRoundMatch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_round_match';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'event_team1_round_id', 'event_team2_round_id', 'team1_score', 'team2_score', 'match_status_id'], 'integer'],
            [['datetime_start', 'datetime_end'], 'safe'],
            [['event_team1_round_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventTeamRound::className(), 'targetAttribute' => ['event_team1_round_id' => 'id']],
            [['event_team2_round_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventTeamRound::className(), 'targetAttribute' => ['event_team2_round_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_team1_round_id' => 'Event Team1 Round ID',
            'event_team2_round_id' => 'Event Team2 Round ID',
            'team1_score' => 'Team1 Score',
            'team2_score' => 'Team2 Score',
            'match_status_id' => 'Match Status ID',
            'datetime_start' => 'Datetime Start',
            'datetime_end' => 'Datetime End',
        ];
    }
    public function behaviors()
      {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
      }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeam1Round()
    {
        return $this->hasOne(EventTeamRound::className(), ['id' => 'event_team1_round_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeam2Round()
    {
        return $this->hasOne(EventTeamRound::className(), ['id' => 'event_team2_round_id']);
    }
}
