<!-- <link rel="import" href="vendor/bower/paper-card/paper-card.html"> -->
<custom-style>
  <style is="custom-style">
  .login-box {
    width: 360px;
    margin: 7% auto;
  }
  .login-logo {
    font-size: 35px;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 300px;
  }
  .login-box {
    padding: 20px;
    background-color: #EEE;
  }
  </style>
</custom-style>

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <div class="row">
            <div class="col-md-2">
                <img src="<?=Yii::$app->request->BaseUrl;?>/images/cca-icon.png" class="animated fadeIn" width="60px"/>
            </div>
            <div class="col-md-10">
                <h3>Tournament Management System</h3>
            </div>
        </div>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
          <div class="alert alert-success alert-dismissable">
          <?= Yii::$app->session->getFlash('success') ?>
          </div>
        <?php endif; ?>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <!-- <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div> -->
            <!-- /.col -->
            <div class="col-xs-12">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-12" style="color:#999">If you forgot your password you can <?= Html::a('reset it', ['request-password-reset']) ?>.</div>
        </div>


        <?php ActiveForm::end(); ?>

        <!-- <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in
                using Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign
                in using Google+</a>
        </div> -->
        <!-- /.social-auth-links -->
        <?= Html::a('Create an Account. Sign up!', ['/site/signup'], ['name' => 'signup-button']) ?><br>
        <!-- <a href="#">Forgot your password?</a><br> -->
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
