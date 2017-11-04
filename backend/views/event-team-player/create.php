<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EventTeamPlayer */

$this->title = 'Create Event Team Player';
$this->params['breadcrumbs'][] = ['label' => 'Event Team Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-team-player-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
