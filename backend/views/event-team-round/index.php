<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventTeamRoundSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Team Rounds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-team-round-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event Team Round', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'event_team_id',
            'event_round_id',
            'match_result_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
