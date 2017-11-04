<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OccasionTeam */

$this->title = 'Create Occasion Team';
$this->params['breadcrumbs'][] = ['label' => 'Occasion Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="occasion-team-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
