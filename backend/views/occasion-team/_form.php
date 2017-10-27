<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OccasionTeam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="occasion-team-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'occasion_id')->textInput() ?>

    <?= $form->field($model, 'team_id')->textInput() ?>

    <?= $form->field($model, 'team_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'overall_place_id')->textInput() ?>

    <?= $form->field($model, 'final_overall_place_id')->textInput() ?>

    <?= $form->field($model, 'overall_wins')->textInput() ?>

    <?= $form->field($model, 'overall_draws')->textInput() ?>

    <?= $form->field($model, 'overall_losses')->textInput() ?>

    <?= $form->field($model, 'overall_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
