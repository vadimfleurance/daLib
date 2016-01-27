<?php $this->layout('layout', ['title' => 'Movie Details', 'nav_title' => 'daLib']) ?>

<?php $this->start('main_content') ?>

	<h1><?= $movie['title'] ?></h1>
	<p><?= $movie['synopsis'] ?></p>
	<p><?= $movie['duration'] ?></p>
	<p><?= $movie['year'] ?></p>
	<p class="genre">
		<?php foreach ($movie['genres'] as $genre): ?>
			<span><?= $genre ?></span>
			
		<?php endforeach ?>
	</p>
	<p><?= $movie['imdbRating'] ?></p>
	<img src="<?= $movie['cover'].'@._V1_SY450_.jpg' ?>"/>
	

<?php $this->stop('main_content') ?>
