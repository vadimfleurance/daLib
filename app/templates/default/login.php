<?php $this->layout('layout', ['title' => 'Login | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	<?= $this->insert('user/form-login' , ['errors' => $errors] ) ?>
<?php $this->stop('main_content') ?>