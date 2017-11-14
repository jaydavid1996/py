<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use common\models\Occasion;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'file_name')->hiddenInput(['value'=>''])->label(false); ?>

    <?= $form->field($model, 'gallery_name')->textInput() ?>

    <?= $form->field($model, 'occasion_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Occasion::find()->orderBy('id')->all(),'id','occasion'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Occasion'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Occasion');
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
