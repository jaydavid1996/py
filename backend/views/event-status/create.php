<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EventStatus */

$this->title = 'Create Event Status';
$this->params['breadcrumbs'][] = ['label' => 'Event Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
