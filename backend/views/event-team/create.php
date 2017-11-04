<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EventTeam */

$this->title = 'Create Event Team';
$this->params['breadcrumbs'][] = ['label' => 'Event Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-team-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
