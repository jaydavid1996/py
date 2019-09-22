<?php

use yii\helpers\Html;
use yii\web\Controller;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Inactive User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-inactive">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php return Yii::$app->response->redirect(Url::to(['index', 'id' => $model->id]));?>

</div>
