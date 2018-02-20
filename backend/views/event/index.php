<link rel="import" href="vendor/bower/paper-card/paper-card.html">

<!-- <link rel="import" href="vendor/bower/paper-styles/color.html">
<link rel="import" href="vendor/bower/paper-styles/typography.html">
<link rel="import" href="vendor/bower/iron-demo-helpers/demo-snippet.html">
<link rel="import" href="vendor/bower/iron-demo-helpers/demo-pages-shared-styles.html"> -->
<custom-style>
  <style is="custom-style">
    button.modalButton {
      border: 0;
      padding: 0;
      margin: 0;
      background-color: white;
    }
    /*.rate-image {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      width: 50px;
      background: url('http://placehold.it/350x150/FFC107/000000');
      background-color: #4285f4 ;
      background-size: cover;
    }*/
    .rate-header { @apply --paper-font-headline; }
    .rate-name {
       color: var(--paper-grey-600); margin: 10px 0;
       float: right;
     }
    paper-icon-button.rate-icon {
      --iron-icon-fill-color: white;
      --iron-icon-stroke-color: var(--paper-grey-600);
    }
    .rate-icon {
      /*float: right;*/
      /*padding-left: 250px;*/
    }
  .card-container {
    @apply --layout-horizontal;
    @apply --layout-wrap;
    /*position: absolute;*/
    margin-top: -25px;
    /*top: 0;*/
    /*left: 0;*/
    /*right: 0;*/
    /*padding: 190px 4px 4px;*/
    box-sizing: border-box;
  }

  .card paper-icon-button {
      float:right;
  }

  paper-card {
    width: calc(50% - 8px);
    height: 180px;
    margin: 4px;
    /*padding: 10px;*/
    /*background-color: #90A4AE;*/
    /*box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14);*/
    word-wrap: break-word;
  }
  .card {
    width: calc(33% - 8px);
    height: 200px;
    margin: 4px;
    padding: 10px;
    background-color: #90A4AE;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14);
    word-wrap: break-word;
  }

  .cyan {
    background-color: #00BCD4;
  }

  .teal {
    background-color: #009688;
  }

  .purple {
    background-color: #9c27b0;
  }

  .blue {
    background-color: #4285f4;
  }

  .orange {
    background-color: #FF5722;
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
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">
  <div class="card-container">
  <?php foreach ($dataProvider->models as $model): ?>
    <paper-card class="rate">
      <div class="card-content">
        <div class="rate-name">
          <?=date("M-d-Y", strtotime($model['date_start'])); echo $model['date_start'] !== $model['date_end'] ? ' to ' . date("M-d-Y", strtotime($model['date_end'])) . '<br />': "";?>
          <?=date("D", strtotime($model['date_start'])); echo $model['date_start'] !== $model['date_end'] ? date(" - D", strtotime($model['date_end'])) : "";?>
        </div>
        <div class="rate-header"><?= $model['event']; ?></div>
        <!-- <?=date("M-d-Y (D)", strtotime($model['date_start']));?> -->
        <?= $model['eventType']['event_type']; ?>
        <br />
        <?= $model['matchSystem']['system']; ?>
        <div><?= $model['description']; ?></div>
      </div>
      <div class="card-actions">
        <!-- <paper-icon-button class="rate-icon" icon="star"></paper-icon-button> -->
        <a href="<?=Url::to('backend/web/event-team/?id='. $model['id'])?>" tabindex="-1">
         <?= ($model['event_status_id']==1) ? "<paper-button>VIEW & FINALIZE</paper-button>" : "VIEW" ?>
        </a>
        <button class="modalButton" value="backend/web/event/update?id=<?=$model['id']?>"  tabindex="-1">
        <paper-icon-button class="rate-icon" icon="create"></paper-icon-button>
        </button>
        <a href="<?=Url::to('backend/web/event/delete?id=' . $model['id'])?>" tabindex="-1" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post">
        <paper-icon-button class="rate-icon" icon="delete"></paper-icon-button>
        </a>
      </div>
      <!-- <div class="rate-image"></div> -->
    </paper-card>
  <?php endforeach;?>

      <!-- <div class="card"></div>
      <div class="card orange">
        <paper-icon-button icon="create"></paper-icon-button>
        <paper-icon-button icon="more-vert"></paper-icon-button>
        <h4>CCA FOUNDATION DAY (2017)</h4>
        <ul>
          <li>date_start</li>
          <li>date_end</li>
          <li>Founding Day of the City College of Angeles</li>
        </ul>
      </div>
      <div class="card purple"></div>
      <div class="card cyan"></div>
      <div class="card orange"></div>
      <div class="card"></div>
      <div class="card teal"></div>
      <div class="card blue"></div>
      <div class="card cyan"></div>
      <div class="card purple"></div> -->
  </div>
    <!-- <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'occasion_id',
            'event_classification_id',
            'event_type_id',
            'match_system_id',
            'event',
            // 'description',
            // 'venue_id',
            // 'event_category_id',
            // 'event_status_id',
            // 'date_start',
            // 'date_end',
            // 'min_team',
            // 'max_team',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> -->
    <paper-button class="modalButton" value="backend/web/event/create?id=<?= $id ?>"><paper-fab icon="add"></paper-fab></paper-button>
</div>
