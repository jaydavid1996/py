<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EventClassification */

$this->title = 'Create Event Classification';
$this->params['breadcrumbs'][] = ['label' => 'Event Classifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-classification-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
