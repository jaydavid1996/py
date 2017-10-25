<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sub_department".
 *
 * @property integer $id
 * @property string $sub_department
 * @property integer $department_id
 *
 * @property Player[] $players
 * @property Department $department
 */
class SubDepartment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_department', 'department_id'], 'required'],
            [['department_id'], 'integer'],
            [['sub_department'], 'string', 'max' => 45],
            [['sub_department'], 'unique'],
            [['department_id', 'sub_department'], 'unique', 'targetAttribute' => ['department_id', 'sub_department'], 'message' => 'The combination of Sub Department and Department ID has already been taken.'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sub_department' => 'Sub Department',
            'department_id' => 'Department ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayers()
    {
        return $this->hasMany(Player::className(), ['sub_department_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
}
