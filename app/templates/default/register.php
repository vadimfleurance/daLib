<?php $this->layout('layout', ['title' => 'Register | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	<?= $this->insert('user/form-register' , ['errors' => $errors] ) ?>
<?php $this->stop('main_content') ?> 