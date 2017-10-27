<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventRoundSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Rounds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-round-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event Round', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'event_id',
            'round',
            'round_status_id',
            'date_start',
            // 'date_end',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
