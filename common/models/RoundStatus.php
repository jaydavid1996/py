<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "round_status".
 *
 * @property integer $id
 * @property string $status
 * @property string $description
 *
 * @property EventRound[] $eventRounds
 */
class RoundStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'round_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status', 'description'], 'string', 'max' => 45],
            [['status'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventRounds()
    {
        return $this->hasMany(EventRound::className(), ['round_status_id' => 'id']);
    }
}
