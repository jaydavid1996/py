<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MatchStatus */

$this->title = 'Create Match Status';
$this->params['breadcrumbs'][] = ['label' => 'Match Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
