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

    .bg-header {
      position: fixed;
      top: 0px;
      left: 0;
      width: 100%;
      height: 264px;
      background-color: #e91e63;
      color: #fff;
    }

    app-header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: #e91e63;
      color: #fff;
      --app-header-shadow: {
        transition: none;
      };
    }

    paper-icon-button {
      --paper-icon-button-ink-color: white;
    }

    paper-fab {
      position: fixed;
      right: 16px;
      bottom: 16px;
      --paper-fab-background: #FFEB3B;
      --paper-fab-keyboard-focus-background: #EFDB2B;
      color: #666;
    }

    [main-title] {
      margin-left: 30px;
      font-weight: 300;
    }
  </style>
</custom-style>
<div class="wrap">
    <app-drawer-layout fullbleed force-narrow>
        <app-drawer id="drawer" slot="drawer" swipe-open>
          <app-toolbar>Menu</app-toolbar>
          <?php include('drawer/paper-icon-item.php'); ?>
        </app-drawer>
        <app-header-layout>
            <div class="bg-header"></div>
            <div>
              <?= Breadcrumbs::widget([
                  'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
              ]) ?>
              <?= Alert::widget() ?>
              <?= $content; ?>
            </div>
            <paper-fab icon="add"></paper-fab>
            <app-header fixed>
              <app-toolbar>
                <paper-icon-button icon="menu" drawer-toggle></paper-icon-button>
                <div main-title>Notes</div>
                <paper-icon-button icon="search"></paper-icon-button>
              </app-toolbar>
            </app-header>
        </app-header-layout>
      </app-drawer-layout>
  </div>
<script>

  addEventListener('WebComponentsReady', function() {

    var appHeader = document.querySelector('app-header');
    var bgHeader = document.querySelector('.bg-header');
    var appHeaderHeight = appHeader.offsetHeight;
    var bgHeaderHeight = bgHeader.offsetHeight;

    var transformBgHeader = function() {
      var y = window.scrollY;
      if (y <= bgHeaderHeight) {
        y = 1.5 * y;
      }
      var s = bgHeader.style;
      s.transform = s.webkitTransform = 'translate3d(0,' + -y + 'px,0)';
      appHeader.shadow = y > bgHeaderHeight - appHeaderHeight;
    }

    transformBgHeader();

    addEventListener('scroll', transformBgHeader);

  });

</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
