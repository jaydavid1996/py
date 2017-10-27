<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MatchStatus */

$this->title = 'Update Match Status: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Match Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="match-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
