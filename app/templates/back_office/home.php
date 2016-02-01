<?php $this->layout('layout', ['title' => 'Back Office | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	
	<h1>Back-Office</h1>

	<p>Welcome, <?= $w_user['username']; ?> you are admin of daLib.com ! Be carefull </p>

	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	<form class="clearfix" method="POST" action="<?= $this->url('back_office_scrapper')?>" >
		<button type="submit" class="btn btn-default btn-block" name="action[scrapping]" value="scrapping" >Go to Scrap</button>
	</form>

	<form class="clearfix" method="POST" action="<?= $this->url('back_office_users')?>" >
		<button type="submit" class="btn btn-default btn-block">Users</button>
	</form>

	<form class="clearfix" method="POST" action="<?= $this->url('back_office_movies')?>" >
		<button type="submit" class="btn btn-default btn-block">Movies</button>
	</form>

<?php $this->stop('main_content') ?> 