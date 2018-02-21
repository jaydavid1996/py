<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "archive".
 *
 * @property int $id
 * @property string $model_name
 * @property int $model_id
 * @property string $date_created
 * @property string $description
 * @property int $status
 * @property int $user+id
 */
class Archive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'archive';
    }
    CONST STATUS_DELETED = 1;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_name', 'model_id', 'status', 'user_id'], 'required'],
            [['model_id', 'status', 'user_id'], 'integer'],
            [['date_created'], 'safe'],
            [['model_name', 'description'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_name' => 'Model Name',
            'model_id' => 'Model ID',
            'date_created' => 'Date Created',
            'description' => 'Description',
            'status' => 'Status',
            'user_id' => 'User+id',
        ];
    }


    public function getStatusList()
    {
      return array(
        self::STATUS_DELETED => 'Inactive',
      );
    }

    public function getStatusLabel ( $status = null )
    {
      $status = isset($status)?$status:$this->status;
      $statusList = $this->getStatusList();
      return isset($statusList[$status])?$statusList[$status]:'None';
    }
}
