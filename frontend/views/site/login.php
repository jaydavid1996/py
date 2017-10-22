<link rel="import" href="vendor/bower/paper-input/paper-input.html">
<link rel="import" href="vendor/bower/paper-button/paper-button.html">
<link rel="import" href="vendor/bower/paper-checkbox/paper-checkbox.html">

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <!-- <paper-input-container always-float-label auto-validate attr-for-value="value"> -->
            <!-- <label slot="label">Social Security Number</label> -->
            <!-- <paper-input-error slot="add-on">SSN invalid!</paper-input-error> -->
            <!-- </paper-input-container> -->

            <?php $form = ActiveForm::begin(['id' => 'login-form',
                'fieldConfig' => [
                'options' => [
                'tag' => false,
            ],
            // 'enableClientValidation' => false,
            // 'enableAjaxValidation' => false,
            ],]); ?>
                <?= $form->field($model, 'username', [
                    'template' => '<paper-input autofocus tabindex=1 label="Username" id="loginform-username" name="LoginForm[username]" required auto-validate error-message="Username cannot be blank"></paper-input>'
                ]); ?>

                <?= $form->field($model, 'username', [
                    'template' => '<paper-input tabindex=2 label="Password" id="loginform-password" name="LoginForm[password]" required auto-validate error-message="Password cannot be blank"></paper-input>'
                ]); ?>

                <!-- <?= $form->field($model, 'rememberMe', [
                    'template' => '<paper-checkbox id="loginform-rememberme" name="LoginForm[rememberMe]" required auto-validate error-message="Password cannot be blank">{label}</paper-checkbox>'
                ]); ?> -->

                <!-- <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?> -->

                <!-- <?= $form->field($model, 'password')->passwordInput() ?> -->

                <!-- <?= $form->field($model, 'rememberMe')->checkbox() ?> -->

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <!-- <div class="form-group"> -->
                    <paper-button name="login-button" onclick="submitLogin()" raised>login</paper-button>
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <!-- </div> -->

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script>
// var username = document.getElementById('loginform-username');
// var password = document.getElementById('loginform-password');
function submitLogin() {
    document.getElementById('login-form').submit();
}
</script>
