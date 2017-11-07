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


class GalleryController extends Controller
{
    /**
     * Lists all Location models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    // public function actionCreate()
    // {
    //     $model = new Gallery();
    //     $modelFileUpload = new Fileupload();
    //
    //
    //
    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         $model->user_id = 1;
    //         $model->extension = 'png';
    //           return $this->redirect('index');
    //       } else {
    //           return $this->render('create', [
    //               'modelFileUpload' => $modelFileUpload,
    //               'model' => $model,
    //           ]);
    //       }
    //
    // }

    public function actionUpload()
    {
        $modelFileUpload = new Fileupload();
        $model = new Gallery();


        if ($modelFileUpload->load(Yii::$app->request->post())) {

            // $orginalFileName = $_FILES['Fileupload']['name']['file_name'];
            // $extension = $_FILES['Fileupload']['type']['file_name'];
            // foreach ($orginalFileName as $orginalFileNames) {
            //         $orginalFileName;
            // }
            // foreach ($extension as $extensions) {
            //         $extensions;
            // }
            // //$extension = strtolower(pathinfo($_FILES['Fileupload']['name'], PATHINFO_EXTENSION));
            // $model->user_id = Yii::$app->user->identity->id;
            // $model->file_name = $orginalFileNames;
            // $model->extension =  $extensions;
            // $model->occasion_id = 1;
            // $model->save();

            if(isset($_POST['Fileupload'])){
                $modelFileUpload->fileupload_name = UploadedFile::getInstances($modelFileUpload, 'fileupload_name');
                if ($modelFileUpload->fileupload_name && $modelFileUpload->validate()) {
                    foreach ($modelFileUpload->fileupload_name as $files) {
                        $files->saveAs(Yii::$app->basePath . '/_uploads/' . $files);
                    }
                }

            }
            Yii::$app->session->setFlash('success','Successfully Upload Images');
            return $this->redirect(array('index'));
        }
        return $this->render('create', array(
            'modelFileUpload' => $modelFileUpload,
            'model' => $model,
        ));
    }
}
