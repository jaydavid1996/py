<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($modelFileUpload, 'fileupload_name[]')->widget(FileInput::classname(), [
        'options' => ['multiple' => true,'accept' => 'image/*'],
        'pluginLoading'=>false,
        'pluginOptions'=>[
            'showPreview' => false,
            //'allowedFileExtensions'=>['sql'],
        ],
    ]); ?>

    <div class="form-group">
    <?=
      Html::submitButton( 'Submit' ,
          ['class' => 'btn btn-success']
      ) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>
