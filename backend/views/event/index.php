<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'occasion_id',
            'event_classification_id',
            'event_type_id',
            'event',
            // 'description',
            // 'venue_id',
            // 'event_category_id',
            // 'event_status_id',
            // 'date_start',
            // 'date_end',
            // 'min_team',
            // 'max_team',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
