<custom-style>
  <style is="custom-style">
  h2 {
    margin: 30px 0 14px;
  }

  .artist-date {
    @apply --layout-horizontal;
    padding-bottom: 12px;
  }

  .artist {
    @apply --layout-flex;
  }

  time {
    margin-left: 20px;
    font-size: 13px;
    color: #555;
  }

  summary {
    padding: 16px 0;
    font-size: 14px;
    line-height: 1.5;
  }

  .song {
    @apply --layout;
    @apply --layout-center;
    padding: 16px 0;
  }

  .song > .no {
    width: 40px;
  }

  .song > .name {
    @apply --layout-flex;
    padding-right: 10px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    margin-left: 10px
  }

  .song > .duration {
    width: 60px;

  }

  .song > .name-novert {
    @apply --layout-flex;
    /*margin-left: 40px;*/
    padding-right: 10px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }

  .song > .duration-novert {
    /*width: 60px;*/
    /*margin-right: 40px;*/
  }

  .content {
    margin: 196px 120px 120px;
    padding: 32px 32px 60px;
    background-color: #fff;
    color: #333;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14);
  }
  .tbl-header{
    background-color: #2d5a2d;
    color: white;
    padding: 10px 20px;
    border-left: 1px solid white
  }

  paper-fab {
    position: absolute;
    top: 232px;
    right: 160px;
    --paper-fab-background: #ef6c00;
    --paper-fab-keyboard-focus-background: #de5c00;
    --iron-icon-width: 36px;
    --iron-icon-height: 36px;
  }

  /* mobile layout */
  @media (max-width: 600px) {

    .content {
      margin: 254px 0 0 0;
      box-shadow: none;
    }

    paper-fab {
      top: 290px;
      right: 16px;
    }
  }
  </style>
</custom-style>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventTeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
  <div class="content">
    <h3><?=$dataProvider->models[0]->username;?></h3>
    <!-- <div class="artist"><?=$dataProvider->models[0]->username;?><br /><?=$dataProvider->models[0]->username;?></div> -->
    <summary>

    </summary>
    <?php $ctr=0; ?>
    <div class="song tbl-header">
      <div class="name-novert"><h5>Team Name</h5></div>
      <div class="name-novert"><h5>Team Name</h5></div>
      <div class="name-novert"><h5>Role</h5></div>
      <div class="name-novert"><h5>Status</h5></div>
      <div class="name-novert"><h5>Action</h5></div>

    </div>
    <?php foreach ($dataProvider->models as $model): ?>
      <div class="song">

        <div class="name"><?= $model['username']; ?></div>
        <div class="name"><?= $model['email']; ?></div>
        <div class="name">
        <?php switch($model['role']) {
          case User::ROLE_EDUCATION: echo "Education"; break;
          case User::ROLE_IBM: echo "IBM"; break;
          case User::ROLE_ADMIN: echo "Admin"; break;
          case User::ROLE_ICSLIS: echo "ICSLIS"; break;
          case User::ROLE_CENTRAL_COUNCIL: echo "Central Council"; break;
          default: echo "New"; break;
        }?>
        </div>
        <div class="name">
        <?php switch($model['status']) {
          case User::STATUS_ACTIVE: echo "Active"; break;
          case User::STATUS_PENDING: echo "Pending"; break;
          case User::STATUS_DELETED: echo "Archived"; break;
          case User::STATUS_INACTIVE: echo "Inactive"; break;
          default: echo "New"; break;
        }?>
        </div>
        <div class="name">
        <?php  if($model['status'] === User::STATUS_ACTIVE && $model['role'] <> User::ROLE_ADMIN):?>
          <a href="<?php echo Url::to('backend/web/user/inactive?id=' . $model["id"])?>" tabindex="-1" title="Update" aria-label="Update" data-pjax="0" data-confirm="Are you sure you want to update this item?" data-method="post"><paper-icon-button class="rate-icon" icon="create"></paper-icon-button>
           </a>
        <?php endif; ?>
<<<<<<< HEAD
        <?php  if($model['status'] <> User::STATUS_ACTIVE  && $model['role'] <> User::ROLE_ADMIN):?>
          <a href="<?php echo Url::to('backend/web/user/active?id=' . $model["id"])?>" tabindex="-1" title="Update" aria-label="Update" data-pjax="0" data-confirm="Are you sure you want to update this item?" data-method="post"><paper-icon-button class="rate-icon" icon="create"></paper-icon-button>
=======
        <?php  if($model['status'] === User::STATUS_INACTIVE && $model['role'] <> User::ROLE_ADMIN):?>
          <a href="<?php echo Url::to('backend/web/user/inactive?id=' . $model["id"])?>" tabindex="-1" title="Update" aria-label="Update" data-pjax="0" data-confirm="Are you sure you want to update this item?" data-method="post"><paper-icon-button class="rate-icon" icon="create"></paper-icon-button>
>>>>>>> b6e7ad24d6f1bd5ee4a0045720b86176101ad9c6
           </a>
       <?php endif; ?>
        </div>
      </div>
    <?php endforeach;?>
  </div>
</div>
