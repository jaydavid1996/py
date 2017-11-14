<?php

namespace common\models;

use Yii;


/**
 * This is the model class for table "{{%gallery}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $occasion_id
 * @property string $file_name
 * @property string $extension
 * @property string $date_created
 * @property string $date_updated
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return '{{%gallery}}';
    }

    //public $file_names;
    //public $loginUserId;
    //public $file_extension;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['user_id', 'occasion_id', 'file_name', 'extension'], 'required'],
            [[ 'occasion_id'], 'required', 'message' => 'Please Select Occasion.'],
            [['user_id', 'occasion_id'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['gallery_name'], 'string', 'max' => 225],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'occasion_id' => 'Occasion ID',
            'gallery' => 'Gallery Name',
            'file_name' => 'File Name',
            'extension' => 'Extension',
            'file_uploads' => 'File Name',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    public function getOccasion()
    {
        return $this->hasOne(Occasion::className(), ['id' => 'occasion_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
     public function getUser()
     {
         return $this->hasOne(User::className(), ['id' => 'user_id']);
     }
     /**
      * @return \yii\db\ActiveQuery
      */
}
