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

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventTeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Teams';
$this->params['breadcrumbs'][] = $this->title;
// if(isset($dataProvider->models[0])) {
  $event = $eventDataProvider->models[0]->event;
  $eventType = $eventDataProvider->models[0]->eventType->event_type;
  $matchSystem = $eventDataProvider->models[0]->matchSystem->system;
  $description = $eventDataProvider->models[0]->description;
  $date_start = $eventDataProvider->models[0]->date_start;
  $date_end = $eventDataProvider->models[0]->date_end;
?>
<div class="event-team-index">
  <div class="content">
    <h2><?=$event;?></h2>
    <div class="artist-date">
    <div class="artist"><?=$eventType;?><br /><?=$matchSystem;?></div>
      <time><?= date("M d, Y", strtotime($date_start));?>
            <?= ($date_start!==$date_end) ? 'to ' . date("M d, Y", strtotime($date_end)) : "";?>
      </time>
    </div>
    <summary>
      <?=$description;?>
    </summary>
    <?php $ctr=0; ?>
    <div class="song">
      <div class="name-novert"><h5>Team Name</h5></div>
      <div class="duration-novert"><h5>Seed Number</h5></div>
    </div>
    <?php foreach ($dataProvider->models as $model): ?>
      <?php if ($model['team']['team']!=="Bye"):?>
      <?php $ctr++; ?>
      <div class="song">
        <!-- <div class="no"><?=$ctr;?></div> -->
        <div class="name"><?= $model['team']['team']; ?></div>
        <div class="duration"><?= ($model['seed_number']!=NULL) ? $model['seed_number'] : "N/A"; ?></div>
        <!-- <iron-icon icon="more-vert"></iron-icon> -->
        <!-- <paper-menu-button vertical-align="top" horizontal-align="right">
          <paper-icon-button icon="more-vert" slot="dropdown-trigger" alt="menu"></paper-icon-button>
          <paper-listbox slot="dropdown-content">
            <paper-item>alpha</paper-item>
            <paper-item>beta</paper-item>
            <paper-item>gamma</paper-item>
            <paper-item>delta</paper-item>
            <paper-item>epsilon</paper-item>
          </paper-listbox>
        </paper-menu-button> -->
      </div>
  <?php endif;?>
    <?php endforeach;?>
  <a href="<?=Url::to('backend/web/event-team/finalize/?id='. $eventDataProvider->models[0]->id)?>"><paper-fab icon="social:whatshot"></paper-fab></a>
  </div>
    <!-- <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event Team', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'team_id',
            'event_id',
            'place_id',
            'final_place_id',
            // 'total_wins',
            // 'total_draws',
            // 'total_losses',
            // 'total_score',
            // 'total_time',
            // 'seed_number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> -->
</div>
<?php
// }
?>
