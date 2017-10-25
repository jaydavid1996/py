<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "player".
 *
 * @property integer $id
 * @property string $fname
 * @property string $lname
 * @property integer $gender_id
 * @property integer $sub_department_id
 * @property string $contact
 * @property string $date_of_birth
 *
 * @property EventTeamPlayer[] $eventTeamPlayers
 * @property EventTeam[] $eventTeams
 * @property Gender $gender
 * @property SubDepartment $subDepartment
 */
class Player extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'player';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'gender_id', 'sub_department_id'], 'required'],
            [['gender_id', 'sub_department_id'], 'integer'],
            [['date_of_birth'], 'safe'],
            [['fname', 'lname', 'contact'], 'string', 'max' => 45],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_id' => 'id']],
            [['sub_department_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubDepartment::className(), 'targetAttribute' => ['sub_department_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'gender_id' => 'Gender ID',
            'sub_department_id' => 'Sub Department ID',
            'contact' => 'Contact',
            'date_of_birth' => 'Date Of Birth',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeamPlayers()
    {
        return $this->hasMany(EventTeamPlayer::className(), ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeams()
    {
        return $this->hasMany(EventTeam::className(), ['id' => 'event_team_id'])->viaTable('event_team_player', ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['id' => 'gender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubDepartment()
    {
        return $this->hasOne(SubDepartment::className(), ['id' => 'sub_department_id']);
    }
}
