<?php

namespace backend\controllers;

use Yii;
use common\models\Event;
use common\models\EventTeam;
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
            $model->event_classification_id = $model->eventType->event_classification_id;
            // $model->event_classification_id = $model->event_classification_dd;
            // $model->event_type_id = $model->event_type_dd;
            $model->venue_id = $model->venue_dd;
            $model->event_category_id = $model->event_category_dd;
            $model->date_start = date("Y-m-d", strtotime($model->date_start));
            $model->date_end = date("Y-m-d", strtotime($model->date_end));

            //default values
            $model->min_team = 3;
            $model->max_team = 12;
            $model->event_status_id = 1;
            $model->save(false);
            // $id = $model-
            // print_r($model->arr_team_name);
            // $xid = Event::find()->where(['event' => $model->event, 'occasion_id' => $id])->one();
            foreach ($model->arr_team_name as $et) {
                $evTeam = new EventTeam();
                $evTeam->team_id = $et;
                $evTeam->event_id  = $model->id;
                $evTeam->save(false);
            }
            return $this->redirect(['event\/?id=' . $id]);
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
        $model->event_classification_dd = $model->event_classification_id;
        $model->event_type_dd = $model->event_type_id;
        $model->venue_dd = $model->venue_id;
        $model->event_category_dd = $model->event_category_id;
        $oldStack = array();
        foreach ($model->eventTeams as $ns) {
            array_push($oldStack, $ns->team_id);
        }
        $model->arr_team_name = $oldStack;
        //  foreach ($model->arr_team_name as $ns) {
        //     $evTeam = new EventTeam();
        //     $evTeam = EventTeam::Find()->where(['team_id' => $ns, 'event_id' => $id])->one();
        //     // $evTeam2 = new EventTeam();
        //     $evTeam2 = EventTeam::Find()->where(['team_id' => $ns, 'event_id' => $id])->count();
        //     echo "<pre>";
        //     print_r($evTeam->team_id);
        //     echo " " . $evTeam2;
        //     echo "</pre>";
        // }

        if ($model->load(Yii::$app->request->post())) {
            $model->event_classification_id = $model->event_classification_dd;
            $model->event_type_id = $model->event_type_dd;
            $model->venue_id = $model->venue_dd;
            $model->event_category_id = $model->event_category_dd;
            // $model->date_start = date("Y-d-m", strtotime($model->date_start));
            // $model->date_end = date("Y-d-m", strtotime($model->date_end));
            $model->save(false);

            $newStack = array_merge($model->arr_team_name, $oldStack);

            foreach ($newStack as $ns) {
                $hasTeam = EventTeam::Find()->where(['team_id' => $ns, 'event_id' => $id])->count();
                if (in_array($ns, $model->arr_team_name)) {
                    if ($hasTeam == 0) {
                        $evTeam = new EventTeam();
                        $evTeam->team_id = $ns;
                        $evTeam->event_id  = $model->id;
                        $evTeam->save();
                    }
                } else {
                    if ($hasTeam == 1) {
                        $evTeam = EventTeam::Find()->where(['team_id' => $ns, 'event_id' => $id])->one();
                        $evTeam->delete();
                    }
                }
            }
            return $this->redirect(['/event-team\/', 'id' => $model->id]);
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

        return $this->redirect(['/occasion\/']);
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
