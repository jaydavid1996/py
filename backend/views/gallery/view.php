<link rel="import" href="vendor/bower/paper-card/paper-card.html">
<link type="text/css" rel="stylesheet"   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


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
  /*    my styles for card container starts here*/
  .paper-card-container{
    margin: 20px;
    padding: 7px;
    border: 1px solid green;
  }
  .title-content{
    font-size: 16px
    font-weight: bold;
    text-align: center;
  }
/*End here*/
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
<style is="custom-style">
  paper-button.custom {
    --paper-button-ink-color: var(--paper-pink-a200);
    /* These could also be individually defined for each of the
      specific css classes, but we'll just do it once as an example */
    --paper-button-flat-keyboard-focus: {
      background-color: var(--paper-pink-a200);
      color: white !important;
    };
    --paper-button-raised-keyboard-focus: {
      background-color: var(--paper-pink-a200) !important;
      color: white !important;
    };
  }
  paper-button.custom:hover {
    background-color: var(--paper-indigo-100);
  }
  paper-button.pink {
    color: var(--paper-pink-a200);

  }
  paper-button.indigo {
    background-color: var(--paper-indigo-500);
    color: white;
    --paper-button-raised-keyboard-focus: {
      background-color: var(--paper-pink-a200) !important;
      color: white !important;
    };
  }
  paper-button.green {
    background-color: var(--paper-green-500);
    color: white;
  }
  paper-button.green[active] {
    background-color: var(--paper-red-500);
  }
  paper-button.disabled {
    color: white;
  }
  .btn-upload {
      border: 2px solid green;
      padding: 7px;
      font-size: 10px;
      float: right;
      color:black;
      font-weight:bold;
  }
  .btn-upload:hover{
    background-color:green;
    color:white;
    border:2px solid green;
    transition:500ms all ease;
  }
  #w0-success-0{
    margin-top:10px;
  }
</style>
<style>
.card-container img {
    width: 302px;
    height: 221px;
    margin: 27PX;
    object-fit: cover;
    border: 2px solid green;
    padding: 9px;
    background-color: white;
}
.card-container {
    margin: auto !important;
}
</style>
<?php
use yii\helpers\Html;
use common\models\Gallery;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use common\models\Fileupload;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
$this->params['breadcrumbs'][] = ['label' => 'Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<a href="<?=Url::to('backend/web/gallery/')?>">
 <paper-button toggles raised class="btn-upload">Return to folder</paper-button>
</a><br />
<h1><?= Html::encode($this->title) ?></h1>
  <div class="card-container">
    <?php $modelFileUploaders = Fileupload::find()->where(['gallery_id'=> $model->id])->all();
      foreach ($modelFileUploaders as $modelFileUploader):
        $imgUrl =  'backend/_uploads/'.$modelFileUploader->file_name;
      ?>
        <img src="<?php echo $imgUrl ?>"/>
      <?php endforeach;?>
     <paper-button class="modalButton" value="backend/web/gallery/upload?id=<?=$model['id']?>"><paper-fab icon="add"></paper-fab></paper-button>
  </div>
