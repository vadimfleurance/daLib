<?php $this->layout('layout', ['title' => 'Register | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-8 col-md-offset-2">
					<?= $this->insert('user/form-register' , ['errors' => $errors] ) ?>
				</div>
			</div>
		</div>
	</section>
<?php $this->stop('main_content') ?> 