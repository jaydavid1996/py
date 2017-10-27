<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MatchResult */

$this->title = 'Update Match Result: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Match Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="match-result-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
