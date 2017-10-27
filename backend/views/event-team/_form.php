<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EventTeam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-team-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'team_id')->textInput() ?>

    <?= $form->field($model, 'event_id')->textInput() ?>

    <?= $form->field($model, 'place_id')->textInput() ?>

    <?= $form->field($model, 'final_place_id')->textInput() ?>

    <?= $form->field($model, 'total_wins')->textInput() ?>

    <?= $form->field($model, 'total_draws')->textInput() ?>

    <?= $form->field($model, 'total_losses')->textInput() ?>

    <?= $form->field($model, 'total_score')->textInput() ?>

    <?= $form->field($model, 'total_time')->textInput() ?>

    <?= $form->field($model, 'seed_number')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
