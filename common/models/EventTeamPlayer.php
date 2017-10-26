<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event_team_player".
 *
 * @property string $id
 * @property integer $event_team_id
 * @property integer $player_id
 * @property integer $year_id
 * @property integer $section_id
 *
 * @property EventTeam $eventTeam
 * @property Player $player
 * @property Section $section
 * @property Year $year
 */
class EventTeamPlayer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_team_player';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_team_id', 'player_id'], 'required'],
            [['event_team_id', 'player_id', 'year_id', 'section_id'], 'integer'],
            [['event_team_id', 'player_id'], 'unique', 'targetAttribute' => ['event_team_id', 'player_id'], 'message' => 'The combination of Event Team ID and Player ID has already been taken.'],
            [['event_team_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventTeam::className(), 'targetAttribute' => ['event_team_id' => 'id']],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => Player::className(), 'targetAttribute' => ['player_id' => 'id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['year_id'], 'exist', 'skipOnError' => true, 'targetClass' => Year::className(), 'targetAttribute' => ['year_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_team_id' => 'Event Team ID',
            'player_id' => 'Player ID',
            'year_id' => 'Year ID',
            'section_id' => 'Section ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeam()
    {
        return $this->hasOne(EventTeam::className(), ['id' => 'event_team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(Player::className(), ['id' => 'player_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne(Year::className(), ['id' => 'year_id']);
    }
}
