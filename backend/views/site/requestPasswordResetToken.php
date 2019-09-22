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

$this->title = 'Request password reset';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
<!-- <h1><?= Html::encode($this->title) ?></h1> -->
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
        <p class="login-box-msg">Please fill out your email. A link to reset password will be sent there.</p>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
          <div class="alert alert-success alert-dismissable">
          <?= Yii::$app->session->getFlash('success') ?>
          </div>
        <?php endif; ?>

        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
</div>
