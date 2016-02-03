<?php $this->layout('layout', ['title' => 'Back Office | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">		
				<h1>Back-Office :: Deleted User</h1>
				
				<?= debug($user) ?>

				<p>The user <?= $user['username'] ?> has been drop from daLib.com<p>

				<a href="<?= $this->url('back_office_users')?>" class="btn btn-default" title="Back to the list of users">Back to the list of users</a>
			</div>
		</div>
	</div>
</section>
<?php $this->stop('main_content') ?> 