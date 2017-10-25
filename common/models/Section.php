<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "section".
 *
 * @property integer $id
 * @property string $section
 *
 * @property EventTeamPlayer[] $eventTeamPlayers
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section'], 'required'],
            [['section'], 'string', 'max' => 45],
            [['section'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'section' => 'Section',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTeamPlayers()
    {
        return $this->hasMany(EventTeamPlayer::className(), ['section_id' => 'id']);
    }
}
