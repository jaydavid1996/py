<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Department;
use kartik\select2\Select2;
use dosamigos\datepicker\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Occasion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="occasion-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'department_id')->textInput() ?> -->
    <!-- <?= $form->field($model, 'department_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Department::find()->all(),'id','department'),
    'options' => ['placeholder' => 'Select Department'],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label('Department');?> -->

    <?= $form->field($model, 'occasion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'date_start')->textInput() ?> -->

    <!-- <?= $form->field($model, 'date_end')->textInput() ?> -->

    <?= $form->field($model, 'date_start')->widget(DateRangePicker::className(), [
        'attributeTo' => 'date_end',
        'form' => $form, // best for correct client validation
        'language' => 'en',
        // 'size' => 'lg',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'M-dd-yyyy'
        ]
    ]);?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
