<?php

namespace app\models;

use yii\base\Model;
/**
 * @mixin AuditTrailBehavior
 */
/**
 * Backup
 *
 * Yii module to backup, restore databse
 *
 * @version 1.0
 * @author Shiv Charan Panjeta <shiv@toxsl.com> <shivcharan.panjeta@outlook.com>
 */
/**
 * UploadForm class.
 * UploadForm is the data structure for keeping
 */
class UploadForm extends Model
{
	public $upload_file ;

	public function behaviors()
	{
			return [
					'AuditTrailBehavior' => [
							'class' => 'bedezign\yii2\audit\AuditTrailBehavior',
							// Array with fields to save. You don't need to configure both `allowed` and `ignored`
							// 'allowed' => ['some_field'],
							// // Array with fields to ignore. You don't need to configure both `allowed` and `ignored`
							// 'ignored' => ['another_field'],
							// // Array with classes to ignore
							// 'ignoredClasses' => ['common\models\Model'],
							// // Is the behavior is active or not
							// 'active' => true,
							// Date format to use in stamp - set to "Y-m-d H:i:s" for datetime or "U" for timestamp
							'dateFormat' => 'Y-m-d H:i:s',
					]
			];
	}

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		if(!isset($this->scenario))
			$this->scenario = 'upload';

        /*
		return array(
				array('upload_file', 'required'),
		);
        */
        return [
            [['upload_file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'sql'],
        ];
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
				'upload_file'=>'SQL Faylı',
		);
	}
	public static function label($n = 1) {
		return Yii::t('app', 'File|Files', $n);
	}
}
