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
use backend\models\ArchiveSearch;

class ArchiveController extends Controller
{
    /**
     * Lists all Location models.
     * @return mixed
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        // 'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

     public function actionIndex()
     {
         $searchModel = new ArchiveSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         return $this->render('index', [
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
         ]);
     }

}
