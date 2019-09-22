<?php
  $this->title = 'My Yii Application';
?>
<style media="screen">
/*
*  Flex Layout Specifics
*/
main{
display:flex;
flex-direction:row;
}

.round{
display:flex;
flex-direction:column;
justify-content:center;
width:200px;
list-style:none;
padding:0;
}
.round .spacer{ flex-grow:1; }
.round .hspacer{ flex-grow:0.5; }
.round .qspacer{ flex-grow:0.25; }
.round .spacer:first-child,
.round .spacer:last-child{ flex-grow:.5; }

.round .game-spacer{
  flex-grow:1;
}
.round .hgame-spacer{
  flex-grow:0.5;
}
.round .qgame-spacer{
  flex-grow:0.25;
}

/*
*  General Styles
*/
body{
font-family:sans-serif;
font-size:small;
padding:10px;
line-height:1.4em;
}

li.game{
padding-left: 20px;
}

li.game.winner{
  font-weight:bold;
}
li.game span{
  float:right;
  margin-right:5px;
}

li.game-top{ border-bottom:1px solid #aaa; }

li.game-spacer{
  border-right:1px solid #aaa;
  min-height:90px;
}
li.hgame-spacer{
  border-right:1px solid #aaa;
  min-height:45px;
}
li.qgame-spacer{
  border-right:1px solid #aaa;
  min-height:22px;
}

li.game-bottom{
  border-top:1px solid #aaa;
}

</style>
<?php
// $this->title = $model['event'];
// $this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">
<?php include ('3steam.php'); ?>
