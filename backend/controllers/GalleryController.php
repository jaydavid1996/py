<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
Use yii\helpers\Url;
use common\models\Gallery;
use common\models\Fileupload;
use yii\web\UploadedFile;
use backend\models\GallerySearch;
use yii\helpers\ArrayHelper;
use common\models\Occasion;
use common\models\Audit;


class GalleryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        // 'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'view','upload'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // 'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all Location models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('view-cms')) {
            $searchModel = new GallerySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
          throw new ForbiddenHttpException;
        }
    }
    public function actionView($id)
        {
            if (Yii::$app->user->can('view-cms')) {
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);
            } else {
              throw new ForbiddenHttpException;
            }
        }

    public function actionUpload($id)
    {
        $model = $this->findModel($id);
        $modelFileUpload = new FileUpload();
        if($modelFileUpload->load(Yii::$app->request->post()))
        {
        if(isset($_POST['Fileupload'])){
                $modelFileUpload->file_uploads = UploadedFile::getInstances($modelFileUpload, 'file_uploads');
                $fileuplode = Fileupload::find()->orderBy(['id'=> SORT_DESC])->one();
                    foreach ($modelFileUpload->file_uploads as $files)
                    {
                        $files->saveAs(Yii::$app->basePath . '/_uploads/' . $files);
                        $modelFileUploads =  new FileUpload();
                        $modelFileUploads->gallery_id = $model->id;
                        $modelFileUploads->file_name = $files->name;
                        $modelFileUploads->gallery_id = $model->id;
                        $modelFileUploads->file_extension = $files->type;

                        if(!$modelFileUploads->save(false)){
                            Yii::$app()->session->setFlash('danger', 'Error Saving Fileupload');
                            return $this->redirect('view');
                        }

                        $modelAudit = new Audit();
                        $modelAudit->user_id = Yii::$app->user->identity->id;
                        $modelAudit->status =  Audit::STATUS_UPLOAD;
                        $modelAudit->fileupload_id = $modelFileUploads->id;
                        $modelAudit->save();
                    }
                    Yii::$app->session->setFlash('success','Successfully Upload Images');
                    return $this->redirect(['view', 'id' => $modelFileUploads->gallery_id]);
                }
            }
        else{
               return $this->renderAjax('upload', [
                   'modelFileUpload' => $modelFileUpload,
                   'model' => $model,
               ]);
            }
        }
        protected function findModel($id)
      {
          if (($model = Gallery::findOne($id)) !== null) {
              return $model;
          } else {
              throw new NotFoundHttpException('The requested page does not exist.');
          }
      }
}
