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
<?php include ('3team.php'); ?>
<?php include ('4team.php'); ?>
<?php include ('5team.php'); ?>
<?php include ('6team.php'); ?>
<?php include ('7team.php'); ?>
<?php include ('8team.php'); ?>
<?php include ('9team.php'); ?>
<?php include ('10team.php'); ?>
<?php include ('11team.php'); ?>
<?php include ('12team.php'); ?>
