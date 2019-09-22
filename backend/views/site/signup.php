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
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Role;
use kartik\select2\Select2;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
        <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <div class="site-signup">
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
                <p class="login-box-msg">Create your Own Account</p>
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'password_repeat')->passwordInput() ?>

                    <?= $form->field($model, 'role')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Role::find()->where(['<>', 'id', 1])->all(),'id','role'),
                        'options' => ['placeholder' => 'Select Role'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Role');?>

                    <div class="form-group row">
                        <div class="col-xs-12">
                            <?= Html::submitButton('Sign up', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'signup-button']) ?>
                        </div>
                        <!-- /.col -->
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
            <!-- /.login-box-body -->
        </div><!-- /.login-box -->
