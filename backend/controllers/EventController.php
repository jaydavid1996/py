<?php

namespace backend\controllers;

use Yii;
use common\models\Event;
use backend\models\EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new EventSearch();
        $searchModel->occasion_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Event();
        $model->occasion_id = $id;
        if ($model->load(Yii::$app->request->post())) {
            $model->event_classification_id = $model->event_classification_dd;
            $model->event_type_id = $model->event_type_dd;
            $model->venue_id = $model->venue_dd;
            $model->event_category_id = $model->event_category_dd;
            $model->date_start = date("Y-m-d", strtotime($model->date_start));
            $model->date_end = date("Y-m-d", strtotime($model->date_end));
            $model->min_team = 3;
            $model->max_team = 12;
            $model->event_status_id = 1;
            $model->save();
            return $this->redirect(['event\/', 'id' => $id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->event_classification_id = $model->event_classification_dd;
            $model->event_type_id = $model->event_type_dd;
            $model->venue_id = $model->venue_dd;
            $model->event_category_id = $model->event_category_dd;
            $model->date_start = date("Y-d-m", strtotime($model->date_start));
            $model->date_end = date("Y-d-m", strtotime($model->date_end));
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
