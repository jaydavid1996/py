<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
  .cms-section .container{
    width:100% !important;
    max-width: 950px;
    margin-left:auto;
    margin-right: auto;
    float:none;
  }
  .cms-section h2 {
      text-align:center;
      font-size:35px;
  }
  .lg-6{width:50%;float:left}
  .img-section img{
    width: 100%;
    height: auto;
    max-width: 300px;
    object-fit: cover;
    position: relative;
    height:300px;
  }
  .cta{
    margin: 20px 0px;
  }
  .acr-title {
    background-color: #009688c4;
    padding: 20px;
    margin: 10px 0px;
    color: white;
    cursor: pointer;
    margin-bottom:0px;
}
.accordion {
  display: none;
}
.accordion{
  background-color: white;
  height: 400px;
}
.content{
  text-align:justify;
  padding:20px;
}
.arrow-down{
  text-align:right;
}
paper-button.modalButton.x-scope.paper-button-0 {
    background-color: #37aa9f;
    color: white;
    font-size:12px;
}
paper-button.modalButton.x-scope.paper-button-0:hover{
  background-color:grey;
  transition:500ms all ease;
}

h3,h5,h6{margin:0px}
</style>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use common\models\Cms;
use common\models\FileUpload;
use common\models\Gallery;
use yii\helpers\Url;
/* @var $this yii\web\View */
$subtitle = 'CMS';
$this->title = 'TMS: ' . $subtitle;
?>
<div class="cms-section">
  <div class="container">
    <div class="cms-title">
        <h2><?= $subtitle; ?></h2>
    </div>
    <div class="contenContainer">
      <?php if (Yii::$app->session->hasFlash('success')): ?>
         <div class="alert alert-success alert-dismissable">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <h4><i class="icon fa fa-check"></i>Saved!</h4>
         <?= Yii::$app->session->getFlash('success') ?>
         </div>
      <?php endif; ?>
      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
      <div class="acr-title">
        <div class="col-md-6">
          <h5>Mission</h5>
        </div>
        <div class="co-md-6 arrow-down">
            <i class="fa fa-arrow-down"></i>
        </div>
      </div>
      <div class="form-group accordion col-md-12">
          <div class="img-section col-md-5">
            <div class="cta">
              <paper-button class="modalButton" value="backend/web/cms/upload1" toggles raised>Edit</paper-button>
            </div>
            <div class="image">
              <?php $modelFileUploaders = Fileupload::find()->where(['type'=> 'cms-img-1'])->orderBy(['id' => SORT_DESC])->one();
                  if(isset($modelFileUploaders) || !empty($modelFileUploaders)){
                        $imgUrl =  'backend/_uploads/'.$modelFileUploaders->file_name;
                  }else{
                        $imgUrl =  'backend/_uploads/default.png';
                    }
                 ?>
                 <img src="<?php echo $imgUrl ?>"/>
            </div>
          </div>
          <div class="img-section col-md-7">
            <div class="cta">
              <paper-button class="modalButton" value="backend/web/cms/create1" toggles raised>Insert</paper-button>
            </div>
            <div class="content">
             <?php $contents = Cms::find()->where(['type'=> '1'])->orderBy(['id' => SORT_DESC])->one();
              if(isset($contents->content) || !empty($contents->content)){

                     echo $contents->content;

              }else{
                  echo '<h4>
                      Please Insert Content.
                    </h4>';
                }
              ?>
            </div>
          </div>
        </div>
      <div class="acr-title">
        <div class="col-md-6">
          <h5>Mission</h5>
        </div>
        <div class="co-md-6 arrow-down">
            <i class="fa fa-arrow-down"></i>
        </div>
      </div>
      <div class="col-md-12 form-group accordion">
        <div class="img-section col-md-5">
          <div class="cta">
            <paper-button class="modalButton" value="backend/web/cms/upload2" toggles raised>Edit</i></paper-button>
          </div>
          <div class="image">
            <?php $modelFileUploaders = Fileupload::find()->where(['type'=> 'cms-img-2'])->orderBy(['id' => SORT_DESC])->one();
                if(isset($modelFileUploaders) || !empty($modelFileUploaders)){
                      $imgUrl =  'backend/_uploads/'.$modelFileUploaders->file_name;
                }else{
                      $imgUrl =  'backend/_uploads/default.png';
                  }
               ?>
               <img src="<?php echo $imgUrl ?>"/>
          </div>
        </div>
        <div class="img-section col-md-7">
          <div class="cta">
            <paper-button class="modalButton" value="backend/web/cms/create2" toggles raised>Insert</paper-button>
          </div>
          <div class="content">
           <?php $contents = Cms::find()->where(['type'=> '2'])->orderBy(['id' => SORT_DESC])->one();
            if(isset($contents->content) || !empty($contents->content)){

                   echo $contents->content;

            }else{
                echo '<h4>
                    Please Insert Content.
                  </h4>';
              }
            ?>
          </div>
        </div>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
  $(document).ready(function(){
    $('.acr-title').on('click',function(){
        $(this).next().slideToggle();
    });
  });
</script>
