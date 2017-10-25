<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event_type".
 *
 * @property integer $id
 * @property string $event_type
 * @property integer $event_classification_id
 * @property string $description
 *
 * @property EventClassification $eventClassification
 */
class EventType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_type', 'event_classification_id'], 'required'],
            [['event_classification_id'], 'integer'],
            [['event_type', 'description'], 'string', 'max' => 45],
            [['event_type'], 'unique'],
            [['event_classification_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventClassification::className(), 'targetAttribute' => ['event_classification_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_type' => 'Event Type',
            'event_classification_id' => 'Event Classification ID',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventClassification()
    {
        return $this->hasOne(EventClassification::className(), ['id' => 'event_classification_id']);
    }
}
