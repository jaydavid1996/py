<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EventTeamRound */

$this->title = 'Create Event Team Round';
$this->params['breadcrumbs'][] = ['label' => 'Event Team Rounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-team-round-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
