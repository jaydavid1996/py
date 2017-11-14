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


class GalleryController extends Controller
{
    /**
     * Lists all Location models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        $model = new Gallery();
        if($model->load(Yii::$app->request->post())){
            if(isset($_POST['Gallery'])){

                //$fileuploadId = Fileupload::findBySql('SELECT id FROM fileupload')->one();
                $loginUserId = Yii::$app->user->identity->id;
                $model->user_id = $loginUserId;
                $model->occasion_id;
                $model->gallery_name;
                //$model->fileupload_id = $fileuploadId->id;
                if(!$model->save(false)){
                        Yii::$app()->session->setFlash('danger', 'Error Saving Gallery');
                        return $this->redirect('index', array(
                            'model' => $model,
                        ));
                    };
                }
            Yii::$app->session->setFlash('success','Successfully Upload Images');
              return $this->redirect(['index', 'id' => $model->id]);
        }else {
           return $this->renderAjax('create', [
               'model' => $model,
           ]);
       }
    }
    public function actionUpload($id)
    {
        $model = $this->findModel($id);

        $modelFileUpload = new FileUpload();

        if($modelFileUpload->load(Yii::$app->request->post())){
            if(isset($_POST['Fileupload'])){
                    $modelFileUpload->file_uploads = UploadedFile::getInstances($modelFileUpload, 'file_uploads');
                    $fileuplode = Fileupload::find()->orderBy(['id'=> SORT_DESC])->one();

                    //$occasionIds = ArrayHelper::map(Occasion::find()->orderBy('id')->All(),'id','occasion');

                    //$galleryId = Gallery::findBySql('SELECT id FROM gallery')->one();


                        foreach ($modelFileUpload->file_uploads as $files) {
                            $files->saveAs(Yii::$app->basePath . '/_uploads/' . $files);
                            $modelFileUpload->file_name = $files->name;
                            $loginUserId = Yii::$app->user->identity->id;
                            $modelFileUpload->gallery_id = $model->id;
                            $modelFileUpload->file_extension = $files->type;
                            $modelFileUpload->occasion_id = $model->occasion_id;
                            $model->fileupload_id = $fileuplode->id;
                            

                            if(!$modelFileUpload->save(false)){
                                Yii::$app()->session->setFlash('danger', 'Error Saving Fileupload');
                                return $this->redirect('index');
                            }
                            if(!$model->save(false)){
                                Yii::$app()->session->setFlash('danger', 'Error Saving Fileupload');
                                return $this->redirect('index');
                            }
                        }
                    }
                    Yii::$app->session->setFlash('success','Successfully Upload Images');
                      return $this->redirect(['index', 'id' => $model->id]);
                }
            else {
               return $this->renderAjax('_upload', [
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
