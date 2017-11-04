<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventTeamPlayerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Team Players';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-team-player-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event Team Player', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'event_team_id',
            'player_id',
            'year_id',
            'section_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
