<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event_team".
 *
 * @property integer $id
 * @property integer $team_id
 * @property integer $event_id
 * @property integer $place_id
 * @property integer $final_place_id
 * @property integer $total_wins
 * @property integer $total_draws
 * @property integer $total_losses
 * @property integer $total_score
 * @property string $total_time
 * @property integer $seed_number
 *
 * @property Event $event
 * @property Place $finalPlace
 * @property Place $place
 * @property Team $team
 * @property EventTeamPlayer[] $eventTeamPlayers
 * @property Player[] $players
 * @property EventTeamRound[] $eventTeamRounds
 * @property EventRound[] $eventRounds
 */
class EventTeam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team_id', 'event_id'], 'required'],
            [['team_id', 'event_id', 'place_id', 'final_place_id', 'total_wins', 'total_draws', 'total_losses', 'total_score', 'seed_number'], 'integer'],
            [['total_time'], 'safe'],
            [['event_id', 'team_id'], 'unique', 'targetAttribute' => ['event_id', 'team_id'], 'message' => 'The combination of Team ID and Event ID has already been taken.'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['final_place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['final_place_id' => 'id']],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
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
            'team_id' => 'Team ID',
            'event_id' => 'Event ID',
            'place_id' => 'Place ID',
            'final_place_id' => 'Final Place ID',
            'total_wins' => 'Total Wins',
            'total_draws' => 'Total Draws',
            'total_losses' => 'Total Losses',
            'total_score' => 'Total Score',
            'total_time' => 'Total Time',
            'seed_number' => 'Seed Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinalPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'final_place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeamPlayers()
    {
        return $this->hasMany(EventTeamPlayer::className(), ['event_team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayers()
    {
        return $this->hasMany(Player::className(), ['id' => 'player_id'])->viaTable('event_team_player', ['event_team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeamRounds()
    {
        return $this->hasMany(EventTeamRound::className(), ['event_team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventRounds()
    {
        return $this->hasMany(EventRound::className(), ['id' => 'event_round_id'])->viaTable('event_team_round', ['event_team_id' => 'id']);
    }
}
