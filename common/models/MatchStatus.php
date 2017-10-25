<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "match_status".
 *
 * @property integer $id
 * @property string $status
 * @property string $description
 */
class MatchStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'match_status';
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
}
