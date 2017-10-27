<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Occasion */

$this->title = 'Update Occasion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Occasions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="occasion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
