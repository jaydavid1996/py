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
use common\models\Fileupload;
use yii\web\UploadedFile;
use common\models\Cms;


class CmsController extends Controller
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
                        'actions' => ['index','upload1','upload2','create1','create2'],
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
        $modelFileUpload = new Fileupload();
        if (Yii::$app->user->can('view-cms')) {
          return $this->render('index', [
              'modelFileUpload' => $modelFileUpload,
          ]);
        } else {
              throw new ForbiddenHttpException;
        }
    }
    public function actionCreate2()
      {
          $modelCms = new Cms();
          if($modelCms->load(Yii::$app->request->post()))
          {
            $modelCms->attributes;
            $modelCms->type = Cms::TYPE_CMS_DESC2;
            $modelCms->content;
            if($modelCms->save(false)){
               Yii::$app->session->setFlash('success', "Sucesfully insert content");
                return $this->redirect('index');
            }
          }
        else{
             return $this->renderAjax('create', [
                 'modelCms' => $modelCms,
                 //'model' => $model,
             ]);
            }
      }

public function actionCreate1()
  {
      $modelCms = new Cms();
      if($modelCms->load(Yii::$app->request->post()))
      {
        $modelCms->attributes;
        $modelCms->type = Cms::TYPE_CMS_DESC1;
        $modelCms->content;
        if($modelCms->save(false)){
           Yii::$app->session->setFlash('success', "Sucesfully insert content");
            return $this->redirect('index');
        }
      }
    else{
         return $this->renderAjax('create', [
             'modelCms' => $modelCms,
             //'model' => $model,
         ]);
        }
  }


public function actionUpload1()
{
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
                      $modelFileUploads->file_name = $files->name;
                      $modelFileUploads->file_extension = $files->type;
                      $modelFileUploads->type = FileUpload::TYPE_CMS_IMG1;
                      $modelFileUploads->save(false);
                  }
              }
          }
      else{
             return $this->renderAjax('upload', [
                 'modelFileUpload' => $modelFileUpload,
                 //'model' => $model,
             ]);
          }
      }

public function actionUpload2()
{
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
                      $modelFileUploads->file_name = $files->name;
                      $modelFileUploads->file_extension = $files->type;
                      $modelFileUploads->type = FileUpload::TYPE_CMS_IMG2;
                      $modelFileUploads->save(false);
                  }
              }
          }
      else{
             return $this->renderAjax('upload', [
                 'modelFileUpload' => $modelFileUpload,
                 //'model' => $model,
             ]);
          }
      }
  }
