<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\EventClassification;
use common\models\EventType;;
use common\models\EventCategory;
use common\models\Venue;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;
use dosamigos\datepicker\DateRangePicker;


/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'occasion_id')->textInput() ?> -->
    <?= $form->field($model, 'event')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_classification_dd')->dropDownList(
        ArrayHelper::map(EventClassification::find()->all(),'id','classification'),
        [
            'prompt' => 'Select Event Classification',
            'onchange' => '
            $.post( "backend/web/event-type/lists?id='.'"+$(this).val(), function(data) {
                $( "select#event-event_type_dd" ).html(data);
            });'
        ]);
    ?>

    <?= $form->field($model, 'event_type_dd')->dropDownList(
        ArrayHelper::map(EventType::find()->all(),'id','event_type'),
        [
            'prompt' => 'Select Event Type',
        ]);
    ?>

    <?= $form->field($model, 'venue_dd')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Venue::find()->all(),'id','venue'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Venue'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ])->label('Venue');?>

    <?= $form->field($model, 'event_category_dd')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(EventCategory::find()->all(),'id','category'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select Category'],
        'pluginOptions' => [
        'allowClear' => true
        ],
    ])->label('Event Category');?>
    <!-- <?= $form->field($model, 'event_category_id')->textInput() ?> -->

    <?= $form->field($model, 'date_start')->widget(DateRangePicker::className(), [
    'attributeTo' => 'date_end',
    'form' => $form, // best for correct client validation
    'language' => 'en',
    // 'size' => 'lg',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'dd-M-yyyy'
    ]
    ]);?>
    <!-- <?= $form->field($model, 'date_start')->textInput() ?> -->

    <!-- <?= $form->field($model, 'date_end')->textInput() ?> -->

    <!-- <?= $form->field($model, 'min_team')->textInput() ?> -->

    <!-- <?= $form->field($model, 'max_team')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
