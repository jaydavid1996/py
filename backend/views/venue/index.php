<custom-style>
  <style is="custom-style">
    button.modalButton {
      border: 0;
      padding: 0;
      margin: 0;
      background-color: white;
    }
    paper-fab {
      position: fixed;
      right: 16px;
      bottom: 16px;
      --paper-fab-background: #FFEB3B;
      --paper-fab-keyboard-focus-background: #EFDB2B;
      color: #666;
    }
  </style>
</custom-style>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
// use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VenueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Venues';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venue-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?= Html::a('Create Venue', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'venue',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <paper-button class="modalButton" value="backend/web/venue/create"><paper-fab icon="add"></paper-fab></paper-button>
</div>
