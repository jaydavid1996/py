<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventRoundMatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Round Matches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-round-match-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event Round Match', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                // 'attribute' => 'event_team1_round_id',
                'label' => 'Team Home',
                'value' => 'eventTeam1Round.eventTeam.team.team',
            ],
            [
                // 'attribute' => 'event_team2_round_id',
                'label' => 'Team Away',
                'value' => 'eventTeam2Round.eventTeam.team.team',
            ],
            [
                'attribute' => 'event_team2_round_id',
                'label' => 'Round',
                'value' => 'eventTeam2Round.eventRound.round',
            ],
            'team1_score',
            'team2_score',
            'match_status_id',
            // 'datetime_start',
            // 'datetime_end',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
