<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EventRoundMatch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-round-match-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_team1_round_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_team2_round_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'team1_score')->textInput() ?>

    <?= $form->field($model, 'team2_score')->textInput() ?>

    <?= $form->field($model, 'match_status_id')->textInput() ?>

    <?= $form->field($model, 'datetime_start')->textInput() ?>

    <?= $form->field($model, 'datetime_end')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
