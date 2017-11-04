<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MatchResult */

$this->title = 'Create Match Result';
$this->params['breadcrumbs'][] = ['label' => 'Match Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-result-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
