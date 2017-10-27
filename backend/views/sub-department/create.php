<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SubDepartment */

$this->title = 'Create Sub Department';
$this->params['breadcrumbs'][] = ['label' => 'Sub Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-department-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
