<link rel="import" href="vendor/bower/paper-input/paper-input.html">
<link rel="import" href="vendor/bower/paper-input/paper-textarea.html">
<link rel="import" href="vendor/bower/paper-button/paper-button.html">
<style>
.site-contact {
    width: 100%;
    position: relative;
    margin-left: 358px;
}
form#contact-form {
    box-shadow: 0 0 13px 2px #2d5022;
    padding: 20px;
    width: 87%;
}
.card-content .content {
    position: relative;
    min-height: 488px;
    max-width: 100%;
    box-shadow: 0px 0px 4px 1px black;
    border:none !important;
}
body{
    background-color: white !important;
}
</style>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have inquiries, please fill out the following form to contact us. Thank you.
    </p>
<div class="contact-container">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-content">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <!-- <?= $form->field($model, 'name', [
                      'template' => '<paper-input autofocus tabindex=1  label="Name" id="contactform-name" name="ContactForm[name]" required auto-validate error-message="Name cannot be blank"></paper-input>'
                    ]); ?>

                    <?= $form->field($model, 'email', [
                      'template' => '<paper-input tabindex=2  label="Email" id="contactform-email" name="ContactForm[email]" required auto-validate error-message="Email cannot be blank"></paper-input>'
                    ]); ?>

                    <?= $form->field($model, 'subject', [
                      'template' => '<paper-input tabindex=3  label="Subject" id="contactform-subject" name="ContactForm[subject]" required auto-validate error-message="Subject cannot be blank"></paper-input>'
                    ]); ?>

                    <?= $form->field($model, 'body', [
                      'template' => '<paper-textarea tabindex=4  char-counter maxlength="300" label="Body" id="contactform-body" name="ContactForm[body]" required auto-validate error-message="Body cannot be blank"></paper-textarea>'
                    ]); ?> -->

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'subject') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-5"><paper-input tabindex=5  label="Verification Code" id="contactform-verifycode" name="ContactForm[verifyCode]" required auto-validate error-message="The verification code is incorrect."></paper-input></div><div class="col-lg-3">{image}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <paper-button name="contact-button" onclick="submitContact()" raised class="btn-success">Submit</paper-button>
                        <!-- <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'name' => 'contact-button']) ?> -->
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

</div>
<script>
// var username = document.getElementById('loginform-username');
// var password = document.getElementById('loginform-password');
function submitContact() {
    document.getElementById('contact-form').submit();
}
</script>
