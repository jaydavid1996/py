<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EventRoundMatch */

$this->title = 'Create Event Round Match';
$this->params['breadcrumbs'][] = ['label' => 'Event Round Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-round-match-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
