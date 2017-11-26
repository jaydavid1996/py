<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property integer $occasion_id
 * @property integer $event_classification_id
 * @property integer $event_type_id
 * @property integer $match_system_id
 * @property string $event
 * @property string $description
 * @property integer $venue_id
 * @property integer $event_category_id
 * @property integer $event_status_id
 * @property string $date_start
 * @property string $date_end
 * @property integer $min_team
 * @property integer $max_team
 *
 * @property EventCategory $eventCategory
 * @property EventClassification $eventClassification
 * @property EventStatus $eventStatus
 * @property EventType $eventType
 * @property Occasion $occasion
 * @property Venue $venue
 * @property EventRound[] $eventRounds
 * @property EventTeam[] $eventTeams
 * @property Team[] $teams
 */

class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
     public $event_classification_dd;
     public $event_category_dd;
     public $event_type_dd;
     public $venue_dd;
     public $arr_team_name;

    public function rules()
    {
        return [
            [['arr_team_name'], 'each', 'rule' => ['string', 'max' => 25]],
            [['arr_team_name'], 'required', 'message' => 'Please select a Team.'],
            [['event_classification_dd'], 'required', 'message' => 'Please select Event Classification.'],
            [['event_category_dd'], 'required', 'message' => 'Please select Event Category.'],
            [['event_type_dd'], 'required', 'message' => 'Please select Event Type.'],
            [['venue_dd'], 'required', 'message' => 'Please select Venue.'],
            [['occasion_id', 'event_classification_id', 'event_type_id', 'match_system_id', 'event', 'venue_id', 'event_category_id'], 'required'],
            [['occasion_id', 'event_classification_id', 'event_type_id', 'match_system_id', 'venue_id', 'event_category_id', 'event_status_id', 'min_team', 'max_team'], 'integer'],
            [['date_start', 'date_end'], 'safe'],
            [['event', 'description'], 'string', 'max' => 45],
            [['occasion_id', 'event'], 'unique', 'targetAttribute' => ['occasion_id', 'event'], 'message' => 'The combination of Occasion ID and Event has already been taken.'],
            [['event_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventCategory::className(), 'targetAttribute' => ['event_category_id' => 'id']],
            [['event_classification_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventClassification::className(), 'targetAttribute' => ['event_classification_id' => 'id']],
            [['event_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventStatus::className(), 'targetAttribute' => ['event_status_id' => 'id']],
            [['event_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventType::className(), 'targetAttribute' => ['event_type_id' => 'id']],
            [['occasion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occasion::className(), 'targetAttribute' => ['occasion_id' => 'id']],
            [['venue_id'], 'exist', 'skipOnError' => true, 'targetClass' => Venue::className(), 'targetAttribute' => ['venue_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'occasion_id' => 'Occasion',
            'event_classification_id' => 'Event Classification',
            'event_type_id' => 'Event Type',
            'match_system_id' => 'Match System',
            'event' => 'Event',
            'description' => 'Description',
            'venue_id' => 'Venue',
            'event_category_id' => 'Event Category',
            'event_status_id' => 'Event Status',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'min_team' => 'Min Team',
            'max_team' => 'Max Team',
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
    public function getEventCategory()
    {
        return $this->hasOne(EventCategory::className(), ['id' => 'event_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventClassification()
    {
        return $this->hasOne(EventClassification::className(), ['id' => 'event_classification_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventStatus()
    {
        return $this->hasOne(EventStatus::className(), ['id' => 'event_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventType()
    {
        return $this->hasOne(EventType::className(), ['id' => 'event_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchSystem()
    {
        return $this->hasOne(MatchSystem::className(), ['id' => 'match_system_id']);
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
    public function getVenue()
    {
        return $this->hasOne(Venue::className(), ['id' => 'venue_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventRounds()
    {
        return $this->hasMany(EventRound::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeams()
    {
        return $this->hasMany(EventTeam::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Team::className(), ['id' => 'team_id'])->viaTable('event_team', ['event_id' => 'id']);
    }
}
