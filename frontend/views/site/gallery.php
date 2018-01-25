<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
  .gallery-item img{
    max-width: 300px;
    margin-bottom: 20px;
    height: 195px;
    object-fit: cover;
    background-color: white;
    box-shadow: 0 0 4px 1px black
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

.overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: #1715154f;
    overflow: hidden;
    width: 0;
    height: 100%;
    transition: .5s ease;
    cursor: pointer;
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

.image-container {
    position: relative;
}

img.image {
    display: block;
    width: 100%;
}

.image-container:hover .overlay{
  width: 100%;
}

.relative{
  position: relative;
    z-index: 999999;
}

.test #w0 {
    display: none;
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
  <div class="image-container">

    <?php $items = [
        [
            'url' => $imgUrl,
            'src' => $imgUrl,
            'options' => array('title' => 'Photos of events')
        ],
    ];?>
  <div id="w0">
  <a class="gallery-item" href="<?php echo $imgUrl ?>" title="Photos of events">
    <img src="<?php echo $imgUrl?>" alt="" class="image">
  </a>
  </div>
  <div class="overlay">
    <div class="text"><i class="fa fa-search"></i></div>
  </div>
  </div>
</div>
<?php endforeach;?>
<div class="test">
  <?= dosamigos\gallery\Gallery::widget(['items' => $items]);?>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
  $(document).ready(function(){
      $('.overlay').on('click',function(e){
         e.preventDefault();
          $(this).parent().find('.gallery-item').trigger("click");
      });

  });
</script>
