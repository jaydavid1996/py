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
use backend\models\AuditSearch;

class AuditController extends Controller
{
    /**
     * Lists all Location models.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     return $this->render('index');
    // }
    public function actionIndex()
    {
        $searchModel = new AuditSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination;

        $dataProvider->sort->attributes['date_created'] = [
          'default' => SORT_DESC
      ];


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
