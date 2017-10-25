<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "venue".
 *
 * @property integer $id
 * @property string $venue
 * @property string $description
 *
 * @property Event[] $events
 */
class Venue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'venue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['venue'], 'required'],
            [['venue', 'description'], 'string', 'max' => 45],
            [['venue'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'venue' => 'Venue',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['venue_id' => 'id']);
    }
}
