<?php

namespace backend\controllers;

use Yii;
use common\models\Occasion;
use yii\filters\AccessControl;
use common\models\Gallery;
use backend\models\OccasionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use common\models\Audit;

/**
 * OccasionController implements the CRUD actions for Occasion model.
 */
class OccasionController extends Controller
{
    /**
     * @inheritdoc
     */
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
                          'actions' => ['index', 'create', 'view', 'update', 'delete'],
                          'allow' => true,
                          'roles' => ['@'],
                      ],
                  ],
              ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Occasion models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('view-occasion')) {
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

    /**``
     * Displays a single Occasion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('view-occasion')) {
          return $this->render('view', [
              'model' => $this->findModel($id),
          ]);
        } else {
          throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Occasion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('create-occasion')) {
            $model = new Occasion();

            if ($model->load(Yii::$app->request->post())) {
                $model->department_id = Yii::$app->user->identity->role;
                $model->date_start = date("Y-m-d", strtotime($model->date_start));
                $model->date_end = date("Y-m-d", strtotime($model->date_end));
                $model->date_created = date("Y-m-d h:i:s");
                $model->save();
                //return $this->redirect(['occasion']);
            }

             else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }

            $modelAudit = new Audit();
            $modelAudit->user_id = Yii::$app->user->identity->id;
            $modelAudit->details = 'Create Occasion : '.$model->occasion;
            $modelAudit->status = AUDIT::STATUS_CREATE;
            $modelAudit->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Occasion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        if (Yii::$app->user->can('update-occasion')) {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {
                $model->save();
                $modelAudit = new Audit();
                $modelAudit->user_id = Yii::$app->user->identity->id;
                $modelAudit->details = 'Update Occasion : '.$model->occasion;
                $modelAudit->status = AUDIT::STATUS_UPDATE;
                $modelAudit->save(false);

                return $this->redirect(['/event\/', 'id' => $model->id]);
            } else {
                return $this->renderAjax('update', [
                    'model' => $model,
                ]);
            }
        }
    }
    /**
     * Deletes an existing Occasion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        if (Yii::$app->user->can('delete-occasion')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the Occasion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Occasion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Occasion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
