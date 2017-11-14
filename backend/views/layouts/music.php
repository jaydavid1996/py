<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
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
    <script src="vendor/bower/webcomponentsjs/webcomponents-lite.js"></script>
    <link rel="import" href="vendor/bower/app-layout/app-layout.html">
    <link rel="import" href="vendor/bower/app-layout/app-layout-behavior/app-layout-behavior.html">
    <link rel="import" href="vendor/bower/app-layout/app-scroll-effects/app-scroll-effects-behavior.html">
    <link rel="import" href="vendor/bower/app-layout/app-scroll-effects/app-scroll-effects.html">
    <link rel="import" href="vendor/bower/app-layout/demo/sample-content.html">
    <link rel="import" href="vendor/bower/iron-flex-layout/iron-flex-layout.html">
    <link rel="import" href="vendor/bower/iron-icons/iron-icons.html">
    <link rel="import" href="vendor/bower/iron-icons/social-icons.html">
    <link rel="import" href="vendor/bower/iron-icons/iron-icon.html">
    <link rel="import" href="vendor/bower/paper-icon-button/paper-icon-button.html">
    <link rel="import" href="vendor/bower/paper-fab/paper-fab.html">
    <link rel="import" href="vendor/bower/iron-icon/iron-icon.html">
    <link rel="import" href="vendor/bower/paper-listbox/paper-listbox.html">
    <link rel="import" href="vendor/bower/paper-menu-button/paper-menu-button.html">
    <title><?= Html::encode($this->title) ?></title>
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

    app-box {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      --app-box-background-front-layer: {
        background-image: url(http://app-layout-assets.appspot.com/assets/GIRL_PharrellWilliams.jpg);
        background-repeat: no-repeat;
        background-size: 100%;
        padding-bottom: 1000px;
      };
    }

    app-header {
      color: #fff;
      --app-header-background-rear-layer: {
        background-color: #ef6c00;
      };
    }

    paper-icon-button {
      --paper-icon-button-ink-color: white;
    }

    [main-title] {
      margin-left: 30px;
      font-weight: 300;
    }
  </style>
</custom-style>
<div class="wrap">
  <app-box effects="parallax-background" effects-config='{"parallax-background": {"scalar": -0.5}}'></app-box>
    <app-drawer-layout fullbleed force-narrow>
        <app-drawer id="drawer" slot="drawer" swipe-open>
          <app-toolbar>Menu</app-toolbar>
          <?php include('drawer/paper-menu.php'); ?>
        </app-drawer>
        <app-header-layout>
            <!-- <app-header slot="header" condenses reveals effects="waterfall resize-title blend-background parallax-background"> -->
            <app-header slot="header" reveals>
              <app-toolbar>
               <paper-icon-button icon="arrow-back"></paper-icon-button>
                <div main-title></div>
                <paper-icon-button icon="search"></paper-icon-button>
              </app-toolbar>
            </app-header>
            <div>
              <!-- <?= Breadcrumbs::widget([
                  'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
              ]) ?> -->
              <?= Alert::widget() ?>
              <?= $content ?>
            </div>
            <!-- <footer class="footer">
                <div class="container">
                    <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                    <p class="pull-right"><?= Yii::powered() ?></p>
                </div>
            </footer> -->
          </app-header-layout>
    </app-drawer-layout>
<script>
  addEventListener('WebComponentsReady', function() {

      var appHeader = document.querySelector('app-header');
      var appBox = document.querySelector('app-box');
      var fadeBackgroundEffect = appHeader.createEffect('fade-background');

      window.addEventListener('scroll', function() {
        var progress = appBox.getScrollState().progress;
        var isCondensed = progress > 0.25;

        fadeBackgroundEffect.run(isCondensed ? 1 : 0);
        appHeader.shadow = isCondensed;
      });

    });
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
