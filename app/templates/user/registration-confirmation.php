<?php $this->layout('layout', ['title' => 'Registration Confirmed | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	<section class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-8 col-md-offset-2">
					<h1>Confirmation of inscription</h1>

					<h3>Welcome, <span class="text-primary"><?= $w_user['username']; ?></span></h3>

					<p>Your registration has been well achieved :D !<br>
					Now you are a new member of the daLib community and the team is very proud of it !<br>
					Check the link below to be redirect to the <a href="<?= $this-> url('home'); ?>" title="Back to the home page">home page</a>.<br><br>
					Have fun :-)</p>
				</div>
			</div>
		</div>
	</section>	
<?php $this->stop('main_content') ?> 