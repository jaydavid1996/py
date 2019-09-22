<style>
.form-group.field-cms-content {
    margin: 20px;
}
</style>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Cms;
//$model = new Cms();
$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<?= $form->field($modelCms, 'content')->textarea(['rows' => '6']) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton($modelCms->isNewRecord ? 'Insert' : 'Update', ['class' => $modelCms->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
