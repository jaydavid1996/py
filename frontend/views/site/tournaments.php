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
.round .spacer:first-child,
.round .spacer:last-child{ flex-grow:.5; }

.round .game-spacer{
  flex-grow:1;
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
padding-left:20px;
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

li.game-bottom{
  border-top:1px solid #aaa;
}

</style>

<h1>3 TEAM DOUBLE ELIMINATION</h1>
<main id="tournament">
	<ul class="round round-1">
    <li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
		<li class="game game-top winner">Colo St <span>84</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">Missouri <span>72</span></li>

		<li class="spacer">&nbsp;</li>

		<li class="spacer">&nbsp;</li>

		<li class="spacer">&nbsp;</li>
	</ul>
	<ul class="round round-2">
		<li class="spacer">&nbsp;</li>

		<li class="game game-top winner">Lousville <span>82</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">Colo St <span>56</span></li>

		<li class="spacer">&nbsp;</li>

		<li class="game game-top winner">Oregon <span>74</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">Saint Louis <span>57</span></li>

		<li class="spacer">&nbsp;</li>
	</ul>
	<ul class="round round-3">
		<li class="spacer">&nbsp;</li>

		<li class="game game-top winner">Lousville <span>77</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">Oregon <span>69</span></li>

		<li class="spacer">&nbsp;</li>
	</ul>
	<ul class="round round-4">
		<li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
		<li class="game game-top winner">Lousville <span>85</span></li>
		<li class="game game-spacer">&nbsp;</li>
    <li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">Duke <span>63</span></li>

		<li class="spacer">&nbsp;</li>
	</ul>
  <ul class="round round-5">
		<li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
		<li class="game game-top winner">Lousville <span>85</span></li>
		<li class="spacer">&nbsp;</li>
	</ul>
</main>

<h1>4 TEAM DOUBLE ELIMINATION</h1>

<main id="tournament">
	<ul class="round round-1">
    <li class="spacer">&nbsp;</li>
    <li class="game game-top winner">Colo St <span>84</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">Missouri <span>72</span></li>
		<li class="spacer">&nbsp;</li>
		<li class="game game-top winner">Colo St <span>84</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">Missouri <span>72</span></li>
		<li class="spacer">&nbsp;</li>
		<li class="spacer">&nbsp;</li>
    <li class="game game-top winner">Colo St <span>84</span></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom ">Missouri <span>72</span></li>
		<li class="spacer">&nbsp;</li>
	</ul>
	<ul class="round round-2">
		<li class="spacer">&nbsp;</li>

		<li class="game game-top winner">Lousville <span>82</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">Colo St <span>56</span></li>

		<li class="spacer">&nbsp;</li>

		<li class="game game-top winner">Oregon <span>74</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">Saint Louis <span>57</span></li>

		<li class="spacer">&nbsp;</li>
	</ul>
	<ul class="round round-3">
		<li class="spacer">&nbsp;</li>

		<li class="game game-top winner">Lousville <span>77</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">Oregon <span>69</span></li>

		<li class="spacer">&nbsp;</li>
	</ul>
	<ul class="round round-4">
		<li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
		<li class="game game-top winner">Lousville <span>85</span></li>
		<li class="game game-spacer">&nbsp;</li>
    <li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">Duke <span>63</span></li>

		<li class="spacer">&nbsp;</li>
	</ul>
  <ul class="round round-5">
		<li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
		<li class="game game-top winner">Lousville <span>85</span></li>
		<li class="spacer">&nbsp;</li>
	</ul>
</main>

<h1>5 TEAM DOUBLE ELIMINATION</h1>

<main id="tournament">
  <ul class="round round-1">

  </ul>
	<ul class="round round-1">
    <li class="spacer">&nbsp;</li><br><br><br><br><br>
    <li class="game game-top winner">4 <span>84</span></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom ">5 <span>72</span></li>
    <li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
    <!-- <li class="game game-top winner">Colo St <span>84</span></li>
		<li class="game game-bottom ">Missouri <span>72</span></li> -->
    <li class="game game-top winner">L1 <span>84</span></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom ">L2 <span>72</span></li>
		<li class="spacer">&nbsp;</li>
	</ul>
  <ul class="round round-2">
    <li class="game game-top winner">2 <span>84</span></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom winner">3 <span>84</span></li><br>
    <li class="game game-top winner" >(1)<span>84</span></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom winner">1 <span>84</span></li>
    <li class="spacer">&nbsp;</li>
    <li class="game game-top winner">(4) <span>82</span></li>
    <li class="game game-spacer">&nbsp;</li>
    <li class="game game-bottom">L3 <span>82</span></li>
  </ul>
	<ul class="round round-2">
		<li class="spacer">&nbsp;</li>
		<li class="game game-top winner">(2) <span>82</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">(3) <span>56</span></li>
		<li class="spacer">&nbsp;</li>
		<li class="game game-top winner">L5 <span>74</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">(6) <span>57</span></li>

		<li class="spacer">&nbsp;</li>
	</ul>
	<ul class="round round-3">
		<li class="spacer">&nbsp;</li>

		<li class="game game-top winner">(5) <span>77</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">(7) <span>69</span></li>

		<li class="spacer">&nbsp;</li>
	</ul>
	<ul class="round round-4">
		<li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
		<li class="game game-top winner">(8) <span>85</span></li>
		<li class="game game-spacer">&nbsp;</li>
    <li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">(L8) <span>63</span></li>
		<li class="spacer">&nbsp;</li>
	</ul>
  <ul class="round round-5">
		<li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
    <li class="spacer">&nbsp;</li>
		<li class="game game-top winner">(9 <span>85</span></li>
		<li class="spacer">&nbsp;</li>
		<li class="spacer">&nbsp;</li>
	</ul>
</main>
