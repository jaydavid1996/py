<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EventTeamRound */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-team-round-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'event_team_id')->textInput() ?>

    <?= $form->field($model, 'event_round_id')->textInput() ?>

    <?= $form->field($model, 'match_result_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
