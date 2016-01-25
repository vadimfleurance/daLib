<?php $this->layout('layout', ['title' => 'Login | Your collection of movies in your pocket', 'nav_title' => 'daLib']) ?>

<?php $this->start('main_content') ?>
	<?= $this->insert('user/form-login') ?>
<?php $this->stop('main_content') ?>