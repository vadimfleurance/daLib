<?php $this->layout('layout', ['title' => 'Registration Confirmed | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	
	<h1>Your collection</h1>

	<p>Welcome, <?= $w_user['username']; ?></p>

	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	
<?php $this->stop('main_content') ?> 