<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "match_system".
 *
 * @property integer $id
 * @property string $system
 * @property string $description
 */
class MatchSystem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'match_system';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['system'], 'required'],
            [['system', 'description'], 'string', 'max' => 45],
            [['system'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'system' => 'System',
            'description' => 'Description',
        ];
    }
}
