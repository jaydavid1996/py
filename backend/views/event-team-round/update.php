<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EventTeamRound */

$this->title = 'Update Event Team Round: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Team Rounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-team-round-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
