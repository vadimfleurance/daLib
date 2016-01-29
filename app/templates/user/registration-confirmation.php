<?php $this->layout('layout', ['title' => 'Registration Confirmed | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	
	<h1>Confirmation of inscription</h1>

	<p>Welcome, <?= $w_user['username']; ?></p>

	<p>Your registration has been well achieved :D ! Now you are a new member of the daLib community and the team is very proud of it !<p>

	<p>Check the link below to be redirect to the home page.</p> 

	<p>Have fun :-) </p>

	<a href="<?= $this-> url('home'); ?>" title="Back to the home page">Home page</a>
	
<?php $this->stop('main_content') ?> 