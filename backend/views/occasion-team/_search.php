<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OccasionTeamSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="occasion-team-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'occasion_id') ?>

    <?= $form->field($model, 'team_id') ?>

    <?= $form->field($model, 'team_name') ?>

    <?= $form->field($model, 'overall_place_id') ?>

    <?php // echo $form->field($model, 'final_overall_place_id') ?>

    <?php // echo $form->field($model, 'overall_wins') ?>

    <?php // echo $form->field($model, 'overall_draws') ?>

    <?php // echo $form->field($model, 'overall_losses') ?>

    <?php // echo $form->field($model, 'overall_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
