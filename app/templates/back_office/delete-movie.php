<?php $this->layout('layout', ['title' => 'Back Office | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	
	<h1>Back-Office</h1>
		
	<h2>Deleted Movie</h2>
	
	<?= debug($movie) ?>

	<p>The movie <?= $movie['title'] ?> has been drop from daLib.com<p>

<?php $this->stop('main_content') ?> 