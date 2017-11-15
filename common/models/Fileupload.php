<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fileupload".
 *
 * @property integer $id
 * @property integer $gallery_id
 * @property integer $occasion_id
 * @property string $file_name
 * @property string $file_extension
 * @property integer $status
 * @property string $date_created
 * @property string $date_updated
 */
class Fileupload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fileupload';
    }

        public $file_uploads;
        CONST IS_DEFAULT_IMAGE = '1';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  [['id', 'gallery_id', 'occasion_id', 'file_name', 'file_extension', 'status'], 'required'],
            [['id', 'gallery_id', 'status'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['file_name', 'file_extension'], 'string', 'max' => 225],
            [['file_uploads'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,gif,jpeg', 'maxFiles' => 10],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gallery_id' => 'Gallery ID',
            'file_name' => 'File Name',
            'file_extension' => 'File Extension',
            'status' => 'Status',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    public static function getImageUrl($id)
        {
            $model = Fileupload::find()->where(['gallery_id'=> $id])->one();

            $baseUrl = 'backend/';
            $fileFolderName =  '_uploads';
            $fileFolderPath = $baseUrl.$fileFolderName;
            if($model)
                {
                    $fileName = $model->file_name;
                    $filePathUrl = $fileFolderPath.'/'.$fileName;
                    $filePath = Yii::getAlias('@backend').'/'.$fileFolderName.'/'.$fileName;
                    if(file_exists($filePath))
                    {
                        return $filePathUrl;
                    }
                }else{
                    return 'backend/_uploads/default.png';
                }
            return false;
        }

    protected function findModel($id)
      {
          if (($model = Fileupload::findOne($id)) !== null) {
              return $model;
          } else {
              throw new NotFoundHttpException('The requested page does not exist.');
          }
      }

    public function getOccasion()
    {
        return $this->hasOne(Occasion::className(), ['id' => 'occasion_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
     public function getGallery()
     {
         return $this->hasOne(Gallery::className(), ['id' => 'gallery_id']);
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
