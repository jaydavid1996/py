<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventTeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Teams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-team-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event Team', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'team_id',
            'event_id',
            'place_id',
            'final_place_id',
            // 'total_wins',
            // 'total_draws',
            // 'total_losses',
            // 'total_score',
            // 'total_time',
            // 'seed_number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
