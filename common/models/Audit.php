<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "audit".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $gallery_id
 * @property integer $type
 * @property integer $status
 * @property string $date_created
 * @property string $date_updated
 */
class Audit extends \yii\db\ActiveRecord
{

    CONST TYPE_ADMIN = 1;
	CONST TYPE_USER = 2;
	CONST TYPE_SUBACCOUNT = 3;

    CONST STATUS_LOGIN = 1;
    CONST STATUS_LOGOUT= 2;
    CONST STATUS_UPLOAD = 3;
    CONST STATUS_CREATE = 4;
    CONST STATUS_UPDATE = 5;
    CONST STATUS_DELETE = 6;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['user_id', 'gallery_id', 'type', 'status'], 'required'],
            [['user_id', 'fileupload_id', 'type', 'status'], 'integer'],
            [['details'], 'string', 'max' => 225],
            [['date_created', 'date_updated'], 'safe'],
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
            'fileupload_id' => 'Fileupload ID',
            'details' => 'Details',
            'type' => 'Type',
            'status' => 'Status',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    public function getStatusList()
	{
		return array(
			self::STATUS_LOGIN => 'Login',
			self::STATUS_LOGOUT => 'Logout',
			self::STATUS_UPLOAD => 'Upload',
            self::STATUS_CREATE => 'Create',
            self::STATUS_UPDATE => 'Update',
            self::STATUS_DELETE => 'Delete',

		);
	}
    public function getStatusLabel ( $status = null )
	{
		$status = isset($status)?$status:$this->status;
		$statusList = $this->getStatusList();
		return isset($statusList[$status])?$statusList[$status]:'None';
	}

    public function getTypeList()
	{
		return array(
			self::TYPE_ADMIN => 'Admin',
			self::TYPE_USER => 'User',
      self::TYPE_SUBACCOUNT => 'Organizerss',
		);
	}

	public function getTypeLabel( $type = null )
	{
		$type = isset($type)?$type:$this->type;
		$typeList = $this->getTypeList();
		return isset($typeList[$type])?$typeList[$type]:'None';
	}

  public function getUsername()
  {
     $modelAuditLogin = Audit::find()->All();
     foreach ($modelAuditLogin as $model){
       $modelUser = User::find()->where(['id'=> $model->user_id])->one();
       return $modelUser->username;
     }

  }

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

    public function getFileupload()
    {
        return $this->hasOne(Fileupload::className(), ['id' => 'fileupload_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */

}
