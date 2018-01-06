<link rel="import" href="vendor/bower/paper-item/paper-item.html">
<link rel="import" href="vendor/bower/font-roboto/roboto.html">
<link rel="import" href="vendor/bower/iron-icons/iron-icons.html">
<link rel="import" href="vendor/bower/iron-icons/av-icons.html">
<link rel="import" href="vendor/bower/iron-icons/maps-icons.html">
<link rel="import" href="vendor/bower/iron-icons/social-icons.html">
<link rel="import" href="vendor/bower/iron-icons/image-icons.html">
<link rel="import" href="vendor/bower/paper-icon-button/paper-icon-button.html">
<link rel="import" href="vendor/bower/paper-item/paper-icon-item.html">

<custom-style>
  <style is="custom-style">

  body {
    margin: 0;
    font-family: 'Roboto', 'Noto', sans-serif;
    background-color: #eee;
  }

  /*.blueHeader {
    background-color: #4285f4;
    color: #fff;
  }

  .blueHeader paper-icon-button {
    --paper-icon-button-ink-color: white;
  }*/

  .whiteHeader {
    font-weight: bold;
    background-color: white;
  }

  .iconItem {
    color: #666;
  }

  /*app-drawer-layout:not([narrow]) [drawer-toggle] {
    display: none;
  }*/
  a {
    text-decoration: none;
  }

  </style>
</custom-style>


<?PHP

$baseUrl = Yii::$app->homeUrl

?>
<?php if (!Yii::$app->user->isGuest) : ?>
<i class="fa fa-circle text-success"></i>
<app-toolbar>
<h4><?= Yii::$app->user->identity->username?></h4>
<h5><?= Yii::$app->user->can('admin') ? ' (Administrator) ' : ' (Organizer) ';?></h5>
<a href="/py/backend/web/logout" data-method="post">
<paper-icon-item class="iconItem">
<iron-icon class="grayIcon" icon="icons:power-settings-new" slot="item-icon"></iron-icon>
</paper-icon-item>
</a>
</app-toolbar>
<?php if (Yii::$app->user->can('admin')) : ?>
<a href="<?php echo $baseUrl?>cms/" tabindex="-1">
<paper-icon-item class="iconItem">
  <iron-icon class="grayIcon" icon="dashboard" slot="item-icon"></iron-icon>
  <span>CMS</span>
</paper-icon-item>
</a>
<a href="<?php echo $baseUrl?>gallery/" tabindex="-1">
<paper-icon-item class="iconItem">
  <iron-icon class="grayIcon" icon="image:panorama" slot="item-icon"></iron-icon>
  <span>Gallery</span>
</paper-icon-item>
</a>
<a href="<?php echo $baseUrl?>user/" tabindex="-1">
<paper-icon-item class="iconItem">
  <iron-icon class="grayIcon" icon="icons:account-circle" slot="item-icon"></iron-icon>
  <span>Users</span>
</paper-icon-item>
</a>
<a href="<?php echo $baseUrl?>report/" tabindex="-1">
<paper-icon-item class="iconItem">
  <iron-icon class="grayIcon" icon="icons:assignment" slot="item-icon"></iron-icon>
  <span>Reports</span>
</paper-icon-item>
</a>
<a href="<?php echo $baseUrl?>audit/" tabindex="-1">
<paper-icon-item class="iconItem">
  <iron-icon class="grayIcon" icon="icons:trending-up" slot="item-icon"></iron-icon>
  <span>Audit Trails</span>
</paper-icon-item>
</a>
<a href="<?php echo $baseUrl?>backuprestore/" tabindex="-1">
<paper-icon-item class="iconItem">
  <iron-icon class="grayIcon" icon="icons:settings-backup-restore" slot="item-icon"></iron-icon>
  <span>Backup & Restore</span>
</paper-icon-item>
</a>
<?php else: ?>
<a href="<?php echo $baseUrl?>occasion/" tabindex="-1">
<paper-icon-item class="iconItem">
  <iron-icon class="grayIcon" icon="av:album" slot="item-icon"></iron-icon>
  <span>Occasions</span>
</paper-icon-item>
</a>
<!-- <a href="<?php echo $baseUrl?>event/" tabindex="-1">
<paper-icon-item class="iconItem">
  <iron-icon class="grayIcon" icon="av:explicit" slot="item-icon"></iron-icon>
  <span>Events</span>
</paper-icon-item>
</a> -->
<!-- <a href="<?php echo $baseUrl?>player/" tabindex="-1">
<paper-icon-item class="iconItem">
  <iron-icon class="grayIcon" icon="social:group-add" slot="item-icon"></iron-icon>
  <span>Players</span>
</paper-icon-item>
</a> -->
<a href="<?php echo $baseUrl?>venue/" tabindex="-1">
<paper-icon-item class="iconItem">
  <iron-icon class="grayIcon" icon="social:domain" slot="item-icon"></iron-icon>
  <span>Venue</span>
</paper-icon-item>
</a>
<a href="<?php echo $baseUrl?>report/" tabindex="-1">
<paper-icon-item class="iconItem">
  <iron-icon class="grayIcon" icon="icons:assignment" slot="item-icon"></iron-icon>
  <span>Reports</span>
</paper-icon-item>
</a>
<?php endif; ?>
<?php endif; ?>
