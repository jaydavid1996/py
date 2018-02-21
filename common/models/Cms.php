<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cms".
 *
 * @property int $id
 * @property string $content
 * @property int $fileupload_id
 * @property int $type
 * @property int $date_createad
 */
class Cms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms';
    }
    CONST TYPE_CMS_DESC1 = '1';
    CONST TYPE_CMS_DESC2 = '2';


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'fileupload_id', 'type', 'date_createad'], 'required'],
            [['fileupload_id', 'type'], 'integer'],
            [['content','date_createad'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'fileupload_id' => 'Fileupload ID',
            'type' => 'Type',
            'date_createad' => 'Date Createad',
        ];
    }
}
