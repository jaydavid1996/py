<?php

namespace common\models;

use Yii;
use  common\models\CDbCriteria;
use common\models\Archive;
use common\models\Occasion;

use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
Use yii\helpers\Url;

/**
 * This is the model class for table "occasion".
 *
 * @property integer $id
 * @property integer $department_id
 * @property string $occasion
 * @property string $description
 * @property string $date_start
 * @property string $date_end
 * @property string $date_created
 *
 * @property Event[] $events
 * @property Department $department
 * @property OccasionTeam[] $occasionTeams
 * @property Team[] $teams
 */
class Occasion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'occasion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id', 'occasion', 'date_start', 'date_end', 'date_created'], 'required'],
            [['department_id'], 'integer'],
            [['date_start', 'date_end', 'date_created'], 'safe'],
            [['occasion', 'description'], 'string', 'max' => 45],
            [['occasion', 'date_created'], 'unique', 'targetAttribute' => ['occasion', 'date_created'], 'message' => 'The combination of Occasion and Date Created has already been taken.'],
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
            'department_id' => 'Department',
            'occasion' => 'Occasion',
            'description' => 'Description',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'date_created' => 'Date Created',
        ];
    }
        public function afterSave($insert, $changedAttributes) {
            if($insert){
                 $model = Occasion::find()->orderBy(['id'=> SORT_DESC])->one();
                 print_r($model->description);
                 $galleryModel = new Gallery();
                 $loginUserId = Yii::$app->user->identity->id;
                 $galleryModel->user_id = $loginUserId;
                 $galleryModel->occasion_id = $model->id;
                 $galleryModel->gallery_name = $model->occasion;
                 $galleryModel->save(false);
            }
        }

   public function afterDelete()
       {
          //parent::afterDelete();
          $model = Occasion::find()->orderBy(['id'=> SORT_DESC])->one();
          $archiveModel = new Archive();
          $archiveModel->model_name = 'occasion';
          $archiveModel->model_id = $model->id;
          $archiveModel->user_id = Yii::$app->user->identity->id;
          $archiveModel->status = Archive::STATUS_DELETED;
          $archiveModel->save();
       }
    public function behaviors()
      {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
      }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['occasion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccasionTeams()
    {
        return $this->hasMany(OccasionTeam::className(), ['occasion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Team::className(), ['id' => 'team_id'])->viaTable('occasion_team', ['occasion_id' => 'id']);
    }
}
