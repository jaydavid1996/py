<style>
.site h2{
    text-align: center;
    padding: 20px;
    text-transform: uppercase;
}
.content-image img{
    width: 100%;
    padding: 10px;
    box-shadow: -1px -1px 4px 0px black;
    object-fit: cover;
}
.content-page{
    padding: 16px;
    font-size: 18px;
    text-align: center;
    line-height: 2;

}
.about-content .row {
    display: flex;
    align-items: center;
    text-align:center;
}
.content-image img {
    width: 100%;
    height: 300px;
    max-width: 416px;
}
</style>

<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use common\models\Fileupload;
use common\models\Cms;

$this->title = 'About';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="site">
        <h2>About Us</h2>
    </div>
     <div class="about-content">
         <div class="row">
             <div class="col-md-6 content-image">
               <?php $modelFileUploaders = Fileupload::find()->where(['type'=> 'cms-img-1'])->orderBy(['id' => SORT_DESC])->one();
                   if(isset($modelFileUploaders) || !empty($modelFileUploaders)){
                         $imgUrl =  'backend/_uploads/'.$modelFileUploaders->file_name;
                   }else{
                         $imgUrl =  'backend/_uploads/default.png';
                     }
                  ?>
                  <img src="<?php echo $imgUrl ?>"/>
             </div>
             <div class="col-md-6 content-page">
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
         <br />
         <div class="row">
             <div class="col-md-6 content-page">
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
             <div class="col-md-6 content-image">
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
     </div>

</div>
