<?php $this->layout('layout', ['title' => 'Register | Your collection of movies in your pocket', 'nav_title' => 'daLib']) ?>

<?php $this->start('main_content') ?>
	<?= $this->insert('user/form-register') ?>
<?php $this->stop('main_content') ?>