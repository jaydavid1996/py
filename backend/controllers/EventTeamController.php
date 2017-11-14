<?php

namespace backend\controllers;

use Yii;
use common\models\EventTeam;
use common\models\EventRound;
use common\models\EventTeamRound;
use common\models\EventRoundMatch;
use backend\models\EventSearch;
use backend\models\EventTeamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventTeamController implements the CRUD actions for EventTeam model.
 */
class EventTeamController extends Controller
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
     * Lists all EventTeam models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $this->layout = "music";

        $searchModel = new EventTeamSearch();
        $searchModel->event_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $eventSearchModel = new EventSearch();
        $eventSearchModel->id = $id;
        $eventDataProvider = $eventSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'eventSearchModel' => $eventSearchModel,
            'eventDataProvider' => $eventDataProvider,
        ]);


    }

    /**
     * Displays a single EventTeam model.
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
     * Creates a new EventTeam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EventTeam();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EventTeam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EventTeam model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionFinalize($id) {
        $searchModel = new EventTeamSearch();
        $searchModel->event_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = new EventTeam();
        $models = $dataProvider->models;
        $numOfTeams = count($dataProvider->models);
        $system = $dataProvider->models[0]->event->matchSystem->system;
        if ($numOfTeams >= $dataProvider->models[0]->event->min_team) {
            switch($system) {
                case "Single Elimination":
                    break;
                case "Double Elimination":
                    break;
                case "Round Robin":
                        // if number of teams is not even, add Bye
                        if ($this->isTeamOdd($numOfTeams)) {
                            $numOfTeams++;
                            $this->addByeTeam($id, 13, $numOfTeams);
                            //update model
                            // $model = $this->findModel($id);
                        }
                        //check if there is a Bye
                        // $bye = $this->hasBye($models[$numOfTeams-1]->team_id);

                        // assign random seed number (seed_number);
                        // $this->randomizeSeeds($numOfTeams, $bye, $models);

                        // create rounds based on number of teams (num of teams - 1)
                        // $this->createEventRounds($id, $numOfTeams, 1);

                        // create event team rounds based on number of event rounds
                        // $this->createTeamRounds($models);

                        //create event_round_match
                        $this->createEventRoundMatch($id, $numOfTeams);
                    break;
                case "Plain Ranking":
                    break;
                default:
                    break;
            }
        //     Yii::$app->session->setFlash('success','Event successfully finalized.');
        //     return $this->redirect(['index']);

        } else {
            Yii::$app->session->setFlash('warning','Please add more teams.');
        }
        // make finalize button for event_team
        // 	count number of teams in selected event
        // 	create event rounds based on match_system formula
        // 	create team round based on event_round
        // 	give team order based on sort_order
        // return $this->redirect(['view', 'var' => $var]);

        // $searchModel = new EventSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // return $this->redirect(['view', 'var' => $numOfTeams]);
        // return $this->redirect(['index']);
    }

    private function isTeamOdd ($xnumOfTeams) {
      if ($xnumOfTeams % 2 === 1) {
        return true;
      }
      return false;
    }
    private function addByeTeam ($event_id, $team_id, $xnumOfTeams) {
      $eventTeam = new EventTeam();
      $eventTeam->event_id = $event_id;
      $eventTeam->team_id = $team_id;
      $eventTeam->seed_number = $xnumOfTeams;

      // $eventTeam->place_id = 0;
      // $eventTeam->final_place_id = 0;
      // $eventTeam->total_wins = 0;
      // $eventTeam->total_draws = 0;
      // $eventTeam->total_losses = 0;
      // $eventTeam->total_score = 0;
      // $eventTeam->total_time = 0;

      // $eventTeam->team_event_id = Yii::$app->db->
      //     createCommand('SELECT id FROM team_event WHERE team_id =' . $team_id . ' and event_type_id =' . $event_type_id)
      // ->queryScalar();
      // $eventTeam->event_team_status_id = $event_team_status_id;
      $eventTeam->save(false);
    }

    private function hasBye($xid) {
      if ($xid == '13') {
          return 1;
      }
      return 0;
    }

    private function randomizeSeeds($xnumOfTeams, $bye, $xmodel) {
      $seed = range(1,$xnumOfTeams-$bye);
      shuffle($seed);
      for ($ctr = 0; $ctr < $xnumOfTeams; $ctr++) {
          $eventTeam = new EventTeam();
          $eventTeam = $xmodel[$ctr];
          if ($eventTeam->team_id != 13) {
              $eventTeam->seed_number = array_pop($seed);
          }
          $eventTeam->save(false);
      }
    }

    private function createEventRounds($xid, $xnumOfTeams, $round_status_id) {
      for ($ctr = 1; $ctr < $xnumOfTeams; $ctr++) {
          try {
              $eventRound = new EventRound();
              $eventRound->event_id = $xid;
              $eventRound->round = $ctr;
              $eventRound->round_status_id = $round_status_id;
              // $eventRound->date_start = '0000-00-00';
              $eventRound->save();
          } catch (Exception $e) {
              Yii::$app->session->setFlash('warning','Duplicate Entry');
          }

      }
    }

    private function createTeamRounds($eventTeams) {
      $eventRounds = new EventRound();
      $eventRounds = $eventTeams[0]->event->eventRounds;
      $numOfRounds = count($eventRounds);
      try {
          foreach ($eventTeams as $eT) :
              foreach ($eventRounds as $eR) :
                  $eventTeamRound = new EventTeamRound();
                  $eventTeamRound->event_team_id = $eT->id;
                  $eventTeamRound->event_round_id = $eR->id;
                  $eventTeamRound->save(false);
              endforeach;
          endforeach;
      } catch (Exception $e) {
          throw new Exception("Duplicate Entry");
      }
    }
    private function createEventRoundMatch($xid, $xnumOfTeams) {
        $seed = range(1,$xnumOfTeams);
        $away = array_splice($seed,(count($seed)/2));
        $home = $seed;
        //$rounds = count($seed) - 1;
        $zzz = 0;
        for ($i=0; $i < count($home)+count($away)-1; $i++) {
            for ($j=0; $j<count($home); $j++) {
                $zzz++;
                $eventTeamHome = EventTeam::find()->where(['seed_number' => $home[$j], 'event_id' => $xid])->one();
                $eventTeamAway = EventTeam::find()->where(['seed_number' => $away[$j], 'event_id' => $xid])->one();
                $eventRoundMatch = new EventRoundMatch();
                $eventRoundMatch->event_team1_round_id = (string) $eventTeamHome->eventTeamRounds[$i]->id;
                $eventRoundMatch->event_team2_round_id = (string) $eventTeamAway->eventTeamRounds[$i]->id;
                // echo "<pre>";
                // print_r($eventRoundMatch->event_team1_round_id);
                // echo "</pre>";
                // $eventRoundMatch->match_status_id = 1;
                // $eventRoundMatch->team1_score = 0;
                // $eventRoundMatch->team2_score = 0;
                $eventRoundMatch->save(false);
            }

            if(count($home)+count($away)-1 > 2){
                $splicedHome = array_splice($home,1,1);
                $shiftedSplicedHome = array_shift($splicedHome);
                array_unshift($away, $shiftedSplicedHome);
                array_push($home,array_pop($away));
            }
        }
    }
    /**
     * Finds the EventTeam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EventTeam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventTeam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
