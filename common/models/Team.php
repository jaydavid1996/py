<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property integer $id
 * @property string $team
 *
 * @property EventTeam[] $eventTeams
 * @property Event[] $events
 * @property OccasionTeam[] $occasionTeams
 * @property Occasion[] $occasions
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team'], 'required'],
            [['team'], 'string', 'max' => 45],
            [['team'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team' => 'Team',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeams()
    {
        return $this->hasMany(EventTeam::className(), ['team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['id' => 'event_id'])->viaTable('event_team', ['team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccasionTeams()
    {
        return $this->hasMany(OccasionTeam::className(), ['team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccasions()
    {
        return $this->hasMany(Occasion::className(), ['id' => 'occasion_id'])->viaTable('occasion_team', ['team_id' => 'id']);
    }
}
