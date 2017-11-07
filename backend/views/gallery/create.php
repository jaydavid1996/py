<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Event */

$this->title = 'Create Gallery';
$this->params['breadcrumbs'][] = ['label' => 'Gallery', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-gallery">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelFileUpload' => $modelFileUpload,
        'model' => $model,
    ]) ?>

</div>
