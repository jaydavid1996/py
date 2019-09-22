<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use common\models\Occasion;
use common\models\Gallery;

/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    
    <?= $form->field($modelFileUpload, 'file_uploads[]')->widget(FileInput::classname(), [
        'options' => ['multiple' => true,'accept' => 'image/*'],
        'pluginLoading'=>true,
        'pluginOptions'=>[
            'showPreview' => true,
            //'allowedFileExtensions'=>['sql'],
            'allowedFileExtensions' => ['jpg','png','jpeg'],
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($modelFileUpload->isNewRecord ? 'Create' : 'Update', ['class' => $modelFileUpload->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
