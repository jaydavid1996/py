<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event_category".
 *
 * @property integer $id
 * @property string $category
 * @property string $description
 *
 * @property Event[] $events
 */
class EventCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category'], 'required'],
            [['category', 'description'], 'string', 'max' => 45],
            [['category'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['event_category_id' => 'id']);
    }
}
