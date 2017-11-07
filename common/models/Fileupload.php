<?php

namespace common\models;

use Yii;
use yii\base\Model;
/**
 * This is the model class for table "{{%fileupload}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $file
 * @property string $path
 * @property string $extension
 */
class Fileupload extends Model
{
    /**
     * @inheritdoc
     */
    public $fileupload_name;

    public static function tableName()
    {
        return '{{%fileupload}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fileupload_name'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 10],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
          'fileupload_name' => 'File Name',
        ];
    }
}
