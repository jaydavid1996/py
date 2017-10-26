<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event_classification".
 *
 * @property integer $id
 * @property string $classification
 * @property string $description
 *
 * @property EventType[] $eventTypes
 */
class EventClassification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_classification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['classification'], 'required'],
            [['classification', 'description'], 'string', 'max' => 45],
            [['classification'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'classification' => 'Classification',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTypes()
    {
        return $this->hasMany(EventType::className(), ['event_classification_id' => 'id']);
    }
}
