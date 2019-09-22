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
  paper-card.rate.x-scope.paper-card-0 {
  padding: 10px;
  font-weight: normal;
  }
  paper-card.rate.x-scope.paper-card-0 {
  width: 100%;
  max-width: 341px;
  height: 120px;
  margin-left: 13px;
  }
  .media paper-card.rate.x-scope.paper-card-0{
  width: 100%;
  max-width: 445px;
  height: 145px;
  margin-left: 78px;
  }
  .card-container {
  margin: 10px 0px !important;
  overflow: auto;
  overflow-y: scroll;
  }
  .rate-name:not([style-scope]):not(.style-scope) {
  color: #757575 !Important;
  margin: 10px 0 !Important;
  }
  .rate-header {
  font-size: 13px !important;
  font-weight: 900 !important;
  }
  .paper-card-0 > .card-content {
  position: relative;
  font-size: 11px !important;
  text-align: left;
  padding: 0px 10px;
  }
  .card-container a{
  text-align: center !important;
  width: 100% !important;
  display: inline-block;
  font-size:11px;
  }
  .paper-card-0 > .card-actions {
  border-top: 1px solid #e8e8e8;
  padding: 21px 16px;
  position: relative;
  font-size: 14px;
  text-align: left;
  }
  .media img {
  width: 100%;
  max-width: 297px;
  height: 120px;
  object-fit: contain;
  position: relative;
  border-radius: 30px;
  }
  .grid-view a{
    display: none;
  }
</style>
<?php
  use common\models\Audit;
  use yii\helpers\Url;
  use yii\grid\GridView;
  use common\models\User;
  use common\models\Fileupload;


  /* @var $this yii\web\View */
  $subtitle = 'Audit';
  $this->title = 'TMS: ' . $subtitle;
  ?>
<?php $modelAudits = Audit::find()->all();?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'showHeader'=>true,
    'layout' => "{summary}\n{items}\n{pager}",
    'options' => array('class' => 'grid-view'),
    'tableOptions' => array('class' => 'table table-striped table-bordered'),
      'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
           'header' => 'USERNAME',
           'attribute' => 'username',
        ],
        [
           'header' => 'ACTION',
           'attribute' => 'statusLabel',
        ],
        [
           'header' => 'DETAILS',
           'attribute' => 'details',
        ],
        [
           'header' => 'DATE',
           'attribute' => 'date_created',
        ],

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<div class="row">
  <div classs="col-md-12">
    <div class='col-md-4'>
      <h1>User Activity</h1>
      <div class="main-container">
        <div class="card-container mySelector" style="margin:10px;">
          <?php $modelAuditLogin = Audit::find()->where(['status' => Audit::STATUS_LOGIN])->ALl();?>
          <?php foreach ($modelAuditLogin as $model): ?>
          <paper-card class="rate">
            <div  class="card-content">
              <div class="rate-header">
                <?php $modelUser = User::find()->where(['id'=> $model->user_id])->one();?>
                LOGIN: <?= $modelUser->username ?>
              </div>
              <div class="user-email" style="margin-top: -6px;padding: 10px 0px;">
                EMAIL: <?= $modelUser->email?>
              </div>
              <div style="margin-bottom: 7px;">
                Action : <?php echo $model->statusLabel ?>
              </div>
            </div>
            <!-- <div class="rate-image"></div> -->
          </paper-card>
          <?php endforeach;?>
        </div>
      </div>
    </div>
    <div class='col-md-6'>
      <h1>Media Activity</h1>
      <div class="media main-container">
        <div class="card-container" style="margin:10px;">
          <?php $modelAuditMedia = Audit::find()->where('status = '. Audit::STATUS_UPLOAD.'')->ALl();?>
          <?php foreach ($modelAuditMedia as $modelMedia): ?>
          <?php $modelUser = User::find()->where(['id'=> $model->user_id])->one();?>
          <paper-card class="rate">
            <div  class="card-content">
              <div class="row">
                <?php $modelFileuploads = Fileupload::find()->where(['id'=> $modelMedia->fileupload_id])->one();?>
                <?php  $imgUrl =  'backend/_uploads/'.$modelFileuploads->file_name;?>
                <div class="col-md-6 media">
                  <img src="<?php echo $imgUrl ?>"/>
                </div>
                <div class="col-md-6">
                  <div class="rate-header">File Name: <?= $modelFileuploads->file_name ?></div>
                  <div class="user-email" style="margin-top: -6px;padding: 10px 0px;">
                    File Type: <?= $modelFileuploads->file_extension?>
                  </div>
                  <div style="margin-bottom: 7px;">
                    Action : <?php echo $modelMedia->statusLabel ?>
                  </div>
                  <div style="margin-bottom: 7px;">
                    Uploaded by : <?php echo $modelUser->username ?>
                  </div>
                  Date Published: <?=date("M-d-Y", strtotime($modelMedia->date_created));?>
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
</div>
