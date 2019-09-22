<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Archive;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GenderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Archive';
$this->params['breadcrumbs'][] = $this->title;

$model = new Archive();
?>
<div class="archive-index">
   <?= GridView::widget([
       'dataProvider' => $dataProvider,
       //'filterModel' => $searchModel,
       'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

           //'id',
           'model_name',
           //'model_id',
           'description',
           'statusLabel',
           'date_created',

           //['class' => 'yii\grid\ActionColumn'],
       ],
   ]); ?>
</div>
