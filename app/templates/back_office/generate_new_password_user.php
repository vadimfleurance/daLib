<?php $this->layout('layout', ['title' => 'Back Office | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">		
				<h1>Back-Office :: Generate an email for the user : <?= $user['username'] ?> </h1>
				
				<p>An email at <?= $user['email'] ?>  has been send, now the password could be changed !<p>

			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<!-- <form class="clearfix" method="POST" action="<?= $this->url('back_office_movies')?>" >
				<button type="submit" class="btn btn-default btn-block">Movies</button>
			</form> -->
			<a href="<?= $this->url('back_office_users')?>" class="btn btn-default btn-block">Back to the list of users</a>
		</div>
	</div>
</section>
<?php $this->stop('main_content') ?> 