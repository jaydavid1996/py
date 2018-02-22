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
    font-size:23px;
}
body{
  background-color: white !important;
}
paper-card.rate.x-scope.paper-card-0 {
    width: 100%;
    max-width: 400px;
    height: auto;
    margin: 15px 20px;
}
.card-container {
    margin: 10px 0px !important;
}
.rate-name:not([style-scope]):not(.style-scope) {
    color: white !Important;
    margin: 10px 0 !Important;
}
.rate-header {
    font-size: 13px !important;
    font-weight: 900 !important;
}
.paper-card-0 > .card-content {
    position: relative;
    font-size: 11px !important;
    text-align: center;
    padding:0px;
}
.card-container a{
    text-align: center !important;
    width: 100% !important;
    display: inline-block;
    font-size:11px;
}

.date-start h3, .date-end h3 {
    font-size: 13px;
    margin-top: 10px;
    margin-bottom: 10px;
    font-weight:bold;
}
.rate-name {
    color: white !important;
    text-align: left;
    line-height: 1.67;
}
.card-content .col-md-4 {
    background-color: #009688;
    min-height: 100px;
}
.rate-header:not([style-scope]):not(.style-scope){
    margin-bottom: 10px;
}
.rate-header {
    text-transform: uppercase;
}
.card-content .col-md-4 {
    background-color: #009688;
    min-height: 100px;
}
.date-start h3, .date-end h3 {
    font-size: 13px;
    margin-top: 10px;
    margin-bottom: 10px;
    font-weight: bold;
    font-size: 20px;
    text-align: center;
    margin-top: 20px;
}
.hide-content{
  display:none;
}
.active-content{
  display:block;
}
.active-tab {
    color: white !important;
    border: 2px solid white;
    padding: 7px;
    border-top: none;
    border-bottom: none;
}
.overlay {
    position: absolute;
    bottom: 0;
    right: 0;
    background-color: #808080bd;
    overflow: hidden;
    width: 0;
    height: 100%;
    transition: .5s ease;
    height: 100px;
    top: 0.5%;
}
.text {
    color: white;
    font-size: 20px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    white-space: nowrap;
}
.cold-md-8.sched-container {
    position: relative;
}
.cold-md-8.sched-container:hover .overlay{
  width: 67%;
}
.tab-menu {
    text-align: center;
    background-color: #8080807d;
    padding: 15px;
    width: 50%;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 20px;
}
</style>
<custom-style>
  <style is="custom-style">
    paper-tabs[no-bar] paper-tab.iron-selected {
      color: #ffff8d;
    }
  </style>
</custom-style>


<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use common\models\Event;
use common\models\Occasion;
use common\models\Department;
use yii\helpers\Url;
use yii\grid\GridView;

$subtitle = 'Events';
$this->title = $subtitle;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row body-container">
  <div classs="col-md-12">
    <!-- <div class='col-md-9'>
      <h1>Event Schedule</h1>
      <?php $modelOccasions = Occasion::find()->all();?>

      <div class="event-index">
        <?php
        $modelOccasions = Occasion::find()->all();
        foreach ($modelOccasions as $model):

            $events = array();

            $Event = new \yii2fullcalendar\models\Event();

            $Event->id = $model->id;
            $Event->title = $model->occasion;
            $Event->start =  date("Y-m-d\TH:i:s\Z", strtotime($model->date_start));
            $Event->end = date("Y-m-d\TH:i:s\Z", strtotime($model->date_end));
            $event[] = $Event;
          ?>
            <?php endforeach;?>
          <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
             'events'=> $event,
             'id' => $model->id,
         ));?>
    </div>
    </div> -->
    <div class="title">
          <h1>Event Listing</h1>
    </div>

    <?php $modelDepartments = Department::find()->all();?>
    <?php $OccasionDepartmentIds = Occasion::find()->all();?>

    <div class="tab-menu">
        <paper-tab id="tablinks"> <a class="central" style="color:black">CENTRAL</a></paper-tab>
        <paper-tab id="tablinks"> <a class="education" style="color:black">EDUCATION</a></paper-tab>
        <paper-tab id="tablinks"> <a class="ibm" style="color:black">IBM</a></paper-tab>
        <paper-tab id="tablinks"> <a class="iclis" style="color:black">ICLIS</a></paper-tab>






    </div>

    <div class='col-md-12'>
         <div class="card-container" style="margin:10px;">
           <?php foreach ($OccasionDepartmentIds as $model): ?>
           <paper-card class="rate">
              <div  class="card-content">
                <?php if($model->department_id == 1)
                  {
                    echo '<div class="central-content">';
                  }
                  else if($model->department_id == 2){

                    echo '<div class="ibm-content">';

                  }
                  else if($model->department_id == 3){

                    echo '<div class="iclis-content">';

                  }
                  else if($model->department_id == 4){

                    echo '<div class="educ-content">';

                  }
                ?>
                  <div class="col-md-4">
                    <div class="rate-name">
                      <div class="date-start">

                        <h3><?=date("D", strtotime($model['date_start'])); echo $model['date_start'] !== $model['date_end'] ? date(" - D", strtotime($model['date_end'])) : "";?>
                        </h3>
                        <?=date("F j, Y", strtotime($model['date_start'])); echo $model['date_start'] !== $model['date_end'] ? ' to ' . date("F j, Y", strtotime($model['date_end'])) . '<br />': "";?>
                      </div>
                    </div>
                  </div>
                  <div class="cold-md-8 sched-container">
                    <div class="rate-header"><?= $model['occasion']; ?></div>
                      <!-- <?=date("M-d-Y (D)", strtotime($model['date_start']));?> -->
                      <?= $model['description']; ?>
                    <div><?= $model['description']; ?></div>
                    <!-- <div class="overlay">
                      <div class="text">See More</div>
                    </div> -->
                  </div>
              </div>
            </div>
             <!-- <div class="rate-image"></div> -->
           </paper-card>
         <?php endforeach;?>
        </div>
      </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
  $(document).ready(function(){

      $('.central').addClass('active-tab');
      $('.ibm-content').parent().parent().hide();
      $('.iclis-content').parent().parent().hide();
      $('.educ-content').parent().parent().hide();


    $('#tablinks a').on('click',function(){
      if ( $(this).hasClass("education") ) {
          $(this).addClass('active-tab');
          $('.central').removeClass('active-tab');
          $('.ibm').removeClass('active-tab');
          $('.central').removeClass('active-tab');


          $('.educ-content').parent().parent().show();
          $('.central-content').parent().parent().hide();
          $('.ibm-content').parent().parent().hide();
          $('.iclis-content').parent().parent().hide();

      }
      if ( $(this).hasClass("central") ) {
          $(this).addClass('active-tab');
          $('.education').removeClass('active-tab');
          $('.ibm').removeClass('active-tab');
          $('.iclis').removeClass('active-tab');


          $('.central-content').parent().parent().show();
          $('.educ-content').parent().parent().hide();
          $('.ibm-content').parent().parent().hide();
          $('.iclis-content').parent().parent().hide();

      }

      if ( $(this).hasClass("ibm") ) {
          $(this).addClass('active-tab');
          $('.education').removeClass('active-tab');
          $('.central').removeClass('active-tab');
          $('.iclis').removeClass('active-tab');


          $('.ibm-content').parent().parent().show();
          $('.educ-content').parent().parent().hide();
          $('.central-content').parent().parent().hide();
          $('.iclis-content').parent().parent().hide();

      }

      if ( $(this).hasClass("iclis") ) {
          $(this).addClass('active-tab');
          $('.education').removeClass('active-tab');
          $('.central').removeClass('active-tab');
          $('.ibm').removeClass('active-tab');



          $('.iclis-content').parent().parent().show();
          $('.educ-content').parent().parent().hide();
          $('.central-content').parent().parent().hide();
          $('.ibm-content').parent().parent().hide();

      }

    });

  });
</script>
