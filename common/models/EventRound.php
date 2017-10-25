<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event_round".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $round
 * @property integer $round_status_id
 * @property string $date_start
 * @property string $date_end
 *
 * @property Event $event
 * @property RoundStatus $roundStatus
 * @property EventTeamRound[] $eventTeamRounds
 * @property EventTeam[] $eventTeams
 */
class EventRound extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_round';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'round'], 'required'],
            [['event_id', 'round', 'round_status_id'], 'integer'],
            [['date_start', 'date_end'], 'safe'],
            [['event_id', 'round'], 'unique', 'targetAttribute' => ['event_id', 'round'], 'message' => 'The combination of Event ID and Round has already been taken.'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['round_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RoundStatus::className(), 'targetAttribute' => ['round_status_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'round' => 'Round',
            'round_status_id' => 'Round Status ID',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
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
    public function getRoundStatus()
    {
        return $this->hasOne(RoundStatus::className(), ['id' => 'round_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeamRounds()
    {
        return $this->hasMany(EventTeamRound::className(), ['event_round_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeams()
    {
        return $this->hasMany(EventTeam::className(), ['id' => 'event_team_id'])->viaTable('event_team_round', ['event_round_id' => 'id']);
    }
}
