<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gender".
 *
 * @property integer $id
 * @property string $gender
 *
 * @property Player[] $players
 */
class Gender extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gender';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender'], 'required'],
            [['gender'], 'string', 'max' => 45],
            [['gender'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gender' => 'Gender',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayers()
    {
        return $this->hasMany(Player::className(), ['gender_id' => 'id']);
    }
}
