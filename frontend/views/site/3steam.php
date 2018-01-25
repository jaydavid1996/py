<!-- <h1>3 TEAM SINGLE ELIMINATION</h1> -->
<main id="tournament">
	<ul class="round round-1">
		<li class="hspacer">&nbsp;</li>
		<li class="hspacer">&nbsp;</li>
		<li class="hspacer">&nbsp;</li>
		<li class="hspacer">&nbsp;</li>
		<li class="spacer">&nbsp;</li>
		<li class="spacer">&nbsp;</li>
		<li class="game game-top winner">2 <span>84</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">3 <span>72</span></li>
		<li class="spacer">&nbsp;</li>
	</ul>
	<ul class="round round-2">
		<li class="spacer">&nbsp;</li>
		<li class="game game-top winner">1 <span>84</span></li>
		<li class="game game-spacer">&nbsp;</li>
		<li class="game game-bottom ">w <span>72</span></li>
		<li class="spacer">&nbsp;</li>
	</ul>
	<ul class="round round-3">
		<li class="spacer">&nbsp;</li>
		<li class="game game-top winner">Lousville <span>85</span></li>
		<li class="spacer">&nbsp;</li>
	</ul>
</main>
<?php foreach ($searchModel as $model): ?>
	<?= $model['team']['team'];		?>
	<?= $model['seed_number'];		?>
	<br />
<?php endforeach;?>
