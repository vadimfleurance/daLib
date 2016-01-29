<?php $this->layout('layout', ['title' => 'Login | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	<section class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-sm-offset-2">
					<?= $this->insert('user/form-login' , ['errors' => $errors] ) ?>
				</div>
			</div>
		</div>
	</section>
<?php $this->stop('main_content') ?>