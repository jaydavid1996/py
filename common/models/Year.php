<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "year".
 *
 * @property integer $id
 * @property string $year
 *
 * @property EventTeamPlayer[] $eventTeamPlayers
 */
class Year extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'year';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'year'], 'required'],
            [['id'], 'integer'],
            [['year'], 'string', 'max' => 45],
            [['year'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeamPlayers()
    {
        return $this->hasMany(EventTeamPlayer::className(), ['year_id' => 'id']);
    }
}
