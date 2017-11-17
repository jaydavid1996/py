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
    .rate-name { color: var(--paper-grey-600); margin: 10px 0; }
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
    width: calc(33% - 8px);
    /*height: 200px;*/
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
<style>
h1{
    margin: 20px;
    padding: 20px;
    text-align: center;
    text-transform: uppercase;
}
body{
  background-color: white !important;
}
paper-card.rate.x-scope.paper-card-0 {
    box-shadow: 0 0 2px 1px black;
    padding: 10px;
    font-weight: normal;
}
</style>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use common\models\Event;
use yii\helpers\Url;
use yii\grid\GridView;

$subtitle = 'Events';
$this->title = $subtitle;
//$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Event Page</h1>
<?php //$modelEvents = new Events();
$modelEvents = Event::find()->all();
?>

<div class="event-index">
  <div class="card-container">
  <?php foreach ($modelEvents as $model): ?>
    <div>

    </div>
    <paper-card class="rate">
      <div class="card-content">
        <div class="rate-header"><?= $model['event']; ?></div>
        <!-- <?=date("M-d-Y (D)", strtotime($model['date_start']));?> -->
        <?= $model['eventType']['event_type']; ?>
        <div class="rate-name">
          <?=date("M-d-Y", strtotime($model['date_start'])); echo $model['date_start'] !== $model['date_end'] ? ' to ' . date("M-d-Y", strtotime($model['date_end'])) . '<br />': "";?>
          <?=date("D", strtotime($model['date_start'])); echo $model['date_start'] !== $model['date_end'] ? date(" - D", strtotime($model['date_end'])) : "";?>
        </div>
        <div><?= $model['description']; ?></div>
      </div>
      <div class="card-actions">
        <!-- <paper-icon-button class="rate-icon" icon="star"></paper-icon-button> -->
        <a href="<?=Url::to('backend/web/event-team/?id='. $model['id'])?>" tabindex="-1">
         <paper-button>VIEW</paper-button>
        </a>
      </div>
      <!-- <div class="rate-image"></div> -->
    </paper-card>
  <?php endforeach;?>


  <?php

$modelEvents = Event::find()->all();

foreach ($modelEvents as $model):

    $events = array();

    $Event = new \yii2fullcalendar\models\Event();

    $Event->id = $model->id;
    $Event->title = $model->event;
    $Event->start =  date("M d, Y", strtotime($model->date_start));
    $Event->end = date("M d, Y", strtotime($model->date_end));
     $event[] = $Event;
  ?>
    <?php endforeach;?>
  <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
     'events'=> $event,
 ));?>
