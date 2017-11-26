<style>
  .gallery-item img{
    max-width: 300px;
    height: 300px;
    height: 156px;
    width: 184px;
    background-color: white;
    object-fit: cover;
    box-shadow: 0 0 4px 1px black;
    padding: 10px;
    margin-bottom: 20px;
  }
  img.slide-content {
    width: 62% !important;
    height: 500px !important;
    object-fit: contain !important;
}
body {
  background-color: #fff!important;
}
h1{
    text-align: center;
    padding: 20px;
    text-transform: uppercase;
}
.col-md-3 {
    width: 20%;
}


</style>

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use common\models\Gallery;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use common\models\Fileupload;
use yii\helpers\Url;
use common\models\Department;
use common\models\Occasion;

$subtitle = 'Gallery';
$this->title = $subtitle;
//$this->params['breadcrumbs'][] = $this->title;
?>
<custom-style>
  <style is="custom-style">
    paper-tabs[no-bar] paper-tab.iron-selected {
      color: #ffff8d;
    }
  </style>
</custom-style>

<!-- <?php
  $modelDepartment = Department::find()->all();

     foreach ($modelDepartment as $department) :
      $departnmentName  =  $department->department;

  //$modelOccasion = Occasion::find()->all();

  //$modelOccasionIds = Occasion::find()->WHERE(['department_id' => $department->id])->all();

?>
<paper-tabs id="plain-tabs" selected="0" no-bar>
  <paper-tab><?php echo $departnmentName?></paper-tab>
</paper-tabs>

<?php endforeach;?> -->


<h1>Our Gallery</h1>
<?php $modelFileUploaders = Fileupload::find()->all();
foreach ($modelFileUploaders as $modelFileUploader):
  $imgUrl =  'backend/_uploads/'.$modelFileUploader->file_name;
?>
<div class="col-md-3">
  <?php $items = [
      [
          'url' => $imgUrl,
          'src' => $imgUrl,
          'options' => array('title' => 'Photos of events')
      ],
  ];?>
  <div id="w0">
  <a class="gallery-item" href="<?php echo $imgUrl ?>" title="Photos of events">
    <img src="<?php echo $imgUrl?>" alt="">
  </a>
  </div>

</div>
<?php endforeach;?>
<?= dosamigos\gallery\Gallery::widget(['items' => $items]);?>
