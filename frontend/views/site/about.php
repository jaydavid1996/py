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
    text-align: justify;
    line-height: 2;
}
</style>

<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

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
                 <img src="frontend/web/images/DSC_(15).JPG" />
             </div>
             <div class="col-md-6 content-page">
                 <p>
                     Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                 </p>
             </div>
         </div>
         <br />
         <div class="row">
             <div class="col-md-6 content-page">
                 <p>
                     Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                 </p>
             </div>
             <div class="col-md-6 content-image">
                 <img src="frontend/web/images/DSC_(11).JPG" />
             </div>
         </div>
     </div>

</div>
