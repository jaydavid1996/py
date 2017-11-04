<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MatchSystem */

$this->title = 'Create Match System';
$this->params['breadcrumbs'][] = ['label' => 'Match Systems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-system-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
