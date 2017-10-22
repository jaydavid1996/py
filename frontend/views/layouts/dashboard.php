<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <base href="/py/" />
    <title><?= Html::encode($this->title) ?></title>
    <script src="vendor/bower/webcomponentsjs/webcomponents-lite.js"></script>
    <link rel="import" href="vendor/bower/app-layout/app-layout.html">
    <link rel="import" href="vendor/bower/app-layout/app-layout-behavior/app-layout-behavior.html">
    <link rel="import" href="vendor/bower/app-layout/app-scroll-effects/app-scroll-effects-behavior.html">
    <link rel="import" href="vendor/bower/app-layout/app-scroll-effects/app-scroll-effects.html">
    <link rel="import" href="vendor/bower/iron-icons/iron-icons.html">
    <link rel="import" href="vendor/bower/paper-icon-button/paper-icon-button.html">
    <link rel="import" href="vendor/bower/paper-fab/paper-fab.html">
    <?php $this->head() ?>
</head>
<body unresolved>
<?php $this->beginBody() ?>
<custom-style>
  <style is="custom-style">
    body {
      margin: 0;
      font-family: 'Roboto', 'Noto', sans-serif;
      background-color: #eee;
    }

    app-header {
      /*position: fixed;
      top: 0;
      left: 0;*/
      /*width: 100%;*/
      color: #fff;
      background-color: #3f51b5;
      --app-header-background-front-layer: {
        background-image: url(https://app-layout-assets.appspot.com/assets/PharrellWilliams.jpg);
        background-repeat: no-repeat;
        background-position: center 20%;
      };
    }

    paper-icon-button {
      --paper-icon-button-ink-color: white;
    }

    app-toolbar.middle {
      /*height: 120px;*/
      height: 150px;
    }

    app-toolbar.bottom {
      /*height: 92px;*/
    }

    sample-content {
      padding-top: -276px;
    }

    [main-title] {
      margin-left: 64px;
      font-size: 32px;
      font-weight: 300;
    }

    [condensed-title] {
      margin-left: 20px;
      font-weight: 300;
    }
    app-drawer-layout:not([narrow]) [drawer-toggle] {
      display: none;
    }

  </style>
</custom-style>
<div class="wrap">
    <app-drawer-layout fullbleed>
        <app-drawer id="drawer" slot="drawer" swipe-open>
          <app-toolbar>Menu</app-toolbar>
          <?php include('drawer/paper-icon-item.php'); ?>
        </app-drawer>
        <app-header-layout>
            <!-- <app-header slot="header" condenses reveals effects="waterfall resize-title blend-background parallax-background"> -->
            <app-header effects="waterfall resize-title blend-background parallax-background" condenses reveals slot="header">
                <app-toolbar>
                    <paper-icon-button icon="menu" drawer-toggle></paper-icon-button>
                    <!-- <paper-icon-button icon="arrow-back"></paper-icon-button> -->
                    <div condensed-title>Pharrell Williams</div>
                    <paper-icon-button icon="create"></paper-icon-button>
                    <paper-icon-button icon="more-vert"></paper-icon-button>
                </app-toolbar>
                <app-toolbar class="middle"></app-toolbar>
                <app-toolbar class="bottom">
                    <div main-title fullbleed>Pharrell Williams</div>
                </app-toolbar>
            </app-header>
            <!-- <div class="container"> -->
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            <!-- </div> -->
        </app-header-layout>
    </app-drawer-layout>
</div>

<!-- <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer> -->
<script>

    var fab = document.querySelector('paper-fab');
    var header = document.querySelector('app-header');

    window.addEventListener('scroll', function() {
      var progress = header.getScrollState().progress;
      fab.toggleClass('shrink-to-hidden', progress > 0.5);
    });

</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
