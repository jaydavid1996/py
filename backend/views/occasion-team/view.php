<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OccasionTeam */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Occasion Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occasion-team-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'occasion_id',
            'team_id',
            'team_name',
            'overall_place_id',
            'final_overall_place_id',
            'overall_wins',
            'overall_draws',
            'overall_losses',
            'overall_time',
        ],
    ]) ?>

</div>
