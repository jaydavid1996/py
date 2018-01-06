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
use backend\models\OccasionSearch;

class ReportController extends Controller
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
                          'actions' => ['index', 'view', 'create', 'update', 'delete'],
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
        if (Yii::$app->user->can('view-report')) {
          $searchModel = new OccasionSearch();
          $searchModel->department_id = Yii::$app->user->identity->role;
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

          return $this->render('index', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
          ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

}
