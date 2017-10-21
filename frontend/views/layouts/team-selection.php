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
    <link rel="import" href="vendor/bower/polymer/polymer.html">
    <link rel="import" href="vendor/bower/app-layout/app-layout.html">
    <link rel="import" href="vendor/bower/app-layout/app-layout-behavior/app-layout-behavior.html">
    <link rel="import" href="vendor/bower/iron-flex-layout/iron-flex-layout.html">
    <link rel="import" href="vendor/bower/iron-ajax/iron-ajax.html">
    <link rel="import" href="vendor/bower/iron-icons/iron-icons.html">
    <link rel="import" href="vendor/bower/iron-icon/iron-icon.html">
    <link rel="import" href="vendor/bower/paper-icon-button/paper-icon-button.html">
    <link rel="import" href="vendor/bower/paper-styles/color.html">
    <link rel="import" href="vendor/bower/paper-styles/typography.html">
    <link rel="import" href="vendor/bower/paper-item/paper-item.html">
    <link rel="import" href="vendor/bower/paper-badge/paper-badge.html">
    <link rel="import" href="vendor/bower/iron-list/iron-list.html">

    <?php $this->head() ?>
</head>
<body unresolved>
<?php $this->beginBody() ?>
<dom-module id="x-app">
  <template>
    <style>

      :host {
        display: block;
        @apply --paper-font-common-base;
        font-family: sans-serif;
      }

      .content {
        @apply --layout-vertical;
        height: 100%;
      }

      .white-toolbar {
        background: white;
        color: #333;
      }

      .pink-toolbar {
        background: var(--paper-pink-500);
        color: white;
      }

      app-toolbar {
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.3);
        font-size: 18px;
      }

      app-drawer {
        text-align: left;
        border-left: 1px solid #ccc;
      }

      app-toolbar paper-icon-button {
        --paper-icon-button-ink-color: white;
      }

      paper-badge {
        margin-top: 5px;
      }

      paper-badge[label="0"] {
        opacity: 0;
      }

      @media (min-width: 640px) {

        paper-badge {
          display: none;
        }

      }

      #itemsList,
      #selectedItemsList {
        @apply --layout-flex;
      }

      .item {
        @apply --layout-horizontal;
        cursor: pointer;
        padding: 16px 22px;
        border-bottom: 1px solid #DDD;
      }

      .item:focus,
      .item.selected:focus {
        outline: 0;
        background-color: #ddd;
      }

      .item.selected .star {
        color: var(--paper-blue-600);
      }

      .avatar {
        height: 40px;
        width: 40px;
        border-radius: 20px;
        box-sizing: border-box;
        background-color: #ddd;
      }

      .pad {
        @apply --layout-flex;
        @apply --layout-vertical;
        padding: 0 16px;
      }

      .primary {
        font-size: 16px;
      }

      .secondary {
        font-size: 14px;
      }

      .dim {
        color: gray;
      }

      .star {
        width: 24px;
        height: 24px;
      }

      paper-item {
        white-space: nowrap;
        cursor: pointer;
      }

      paper-item:hover::after {
        content: "－";
        width: 16px;
        height: 16px;
        display: block;
        border-radius: 50% 50%;
        background-color: var(--google-red-300);
        margin-left: 10px;
        line-height: 16px;
        text-align: center;
        color: white;
        font-weight: bold;
        text-decoration: none;
        position: absolute;
        right: 15px;
        top: calc(50% - 8px);
      }

      .no-selection {
        color: #999;
        margin-left: 10px;
        line-height: 50px;
      }

      iron-list {
        @apply --layout-flex;
      }

    </style>
    <?= $content ?>

    <app-drawer-layout fullbleed>
      <div class="content">
        <app-toolbar class="pink-toolbar">
          <div main-title>Selection using iron-list</div>
          <div>
            <paper-icon-button icon="star" alt="Starred" drawer-toggle></paper-icon-button>
            <paper-badge label$="[[selectedItems.length]]"></paper-badge>
          </div>
        </app-toolbar>
        <!-- Main List for the items -->
        <iron-list id="itemsList" items="[[data]]" selected-items="{{selectedItems}}" selection-enabled multi-selection>
          <template>
            <div>
              <div tabindex$="[[tabIndex]]" aria-label$="Select/Deselect [[item.name]]" class$="[[_computedClass(selected)]]">
                <img class="avatar" src="[[item.image]]">
                <div class="pad">
                  <div class="primary">
                    [[item.name]]
                  </div>
                  <div class="secondary dim">[[item.shortText]]</div>
                </div>
                <iron-icon icon$="[[iconForItem(selected)]]" class="star"></iron-icon>
              </div>
              <div class="border"></div>
            </div>
          </template>
        </iron-list>
      </div>
      <app-drawer slot="drawer" align="right">
        <div class="content">
          <app-toolbar class="white-toolbar">
            <div main-title>[[_getFormattedCount(selectedItems.length)]] Selected contacts</div>
          </app-toolbar>
          <template is="dom-if" if="[[!selectedItems.length]]">
            <div class="no-selection">Select a contact</div>
          </template>
          <!-- List for the selected items -->
          <iron-list id="selectedItemsList" items="[[selectedItems]]" hidden$="[[!selectedItems.length]]">
            <template>
              <paper-item tabindex$="[[tabIndex]]" on-tap="_unselect" aria-label$="Deselect [[item.name]]">[[item.name]]</paper-item>
            </template>
          </iron-list>
        </div>
      </app-drawer>
    </app-drawer-layout>

  </template>

  <script>

    HTMLImports.whenReady(function() {

      Polymer({

        is: 'x-app',

        properties: {
          selectedItems: {
            type: Object
          }
        },

        iconForItem: function(isSelected) {
          return isSelected ? 'star' : 'star-border';
        },

        _computedClass: function(isSelected) {
          var classes = 'item';
          if (isSelected) {
            classes += ' selected';
          }
          return classes;
        },

        _unselect: function(e) {
          this.$.itemsList.deselectItem(e.model.item);
        },

        _getFormattedCount: function(count) {
          return count > 0 ? '(' + count + ')' : '';
        }
      });

   });

  </script>
</dom-module>

<x-app></x-app>
            <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
<!-- <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer> -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
