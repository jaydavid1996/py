<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\EventClassification;
use common\models\EventType;
use common\models\MatchSystem;
use common\models\Team;
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

    <!-- <?= $form->field($model, 'event_classification_dd')->dropDownList(
        ArrayHelper::map(EventClassification::find()->all(),'id','classification'),
        [
            'prompt' => 'Select Event Classification',
            'onchange' => '
            $.post( "backend/web/event-type/lists?id='.'"+$(this).val(), function(data) {
                $( "select#event-event_type_dd" ).html(data);
            });'
        ]);
    ?> -->
    <?= $form->field($model, 'event_type_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(EventType::find()->all(),'id','event_type', 'eventClassification.classification'),
        'options' => ['placeholder' => 'Select Event Type'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Event Type');?>

      <?= $form->field($model, 'match_system_id')->widget(Select2::classname(), [
          'data' => ArrayHelper::map(MatchSystem::find()->all(),'id','system'),
          'options' => ['placeholder' => 'Select Match System'],
          'pluginOptions' => [
              'allowClear' => true
          ],
      ])->label('Match System');?>

    <!-- <?= $form->field($model, 'event_type_id')->dropDownList(
        ArrayHelper::map(EventType::find()->all(),'id','event_type'),
        [
            'prompt' => 'Select Event Type',
        ]);
    ?> -->

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
    <?= $form->field($model, 'arr_team_name')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Team::find()->where(['<>','team', "Bye"])->all(),'id','team'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select Team', 'multiple' => true],
    'pluginOptions' => [
        'allowClear' => true
    ],
    ])->label('Team');
    ?>
    <!-- <?= $form->field($model, 'event_category_id')->textInput() ?> -->

    <?= $form->field($model, 'date_start')->widget(DateRangePicker::className(), [
    'attributeTo' => 'date_end',
    'form' => $form, // best for correct client validation
    'language' => 'en',
    // 'size' => 'lg',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd'
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
