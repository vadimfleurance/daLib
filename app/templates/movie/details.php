<?php $this->layout('layout', ['title' => 'Movie Details', 'nav_title' => 'daLib']) ?>

<?php $this->start('main_content') ?>
	<article>
		<h1><?= $movie['title'] ?></h1>
		<b>Synopsis:</b>
		<p><?= $movie['synopsis'] ?></p>
		<b>Duration:</b>
		<p><?= $movie['duration'] ?></p>
		<b>Year:</b>
		<p><?= $movie['year'] ?></p>
		<b>Genres:</b>
		<p class="genres">
			<?php foreach ($movie['genres'] as $genre): ?>
				<span><?= $genre ?></span>
				
			<?php endforeach ?>
		</p>
		<b>Directors:</b>
		<p class="directors">
			<?php foreach ($movie['directors'] as $director): ?>
				<span><?= $director ?></span>
				
			<?php endforeach ?>
		</p>
		<b>Writers:</b>
		<p class="writers">
			<?php foreach ($movie['writers'] as $writer): ?>
				<span><?= $writer ?></span>
				
			<?php endforeach ?>
		</p>
		<b>Stars:</b>
		<p class="stars">
			<?php foreach ($movie['stars'] as $star): ?>
				<span><?= $star ?></span>
				
			<?php endforeach ?>
		</p>
		<b>Rating:</b>
		<p><?= $movie['imdbRating'] ?></p>
		<img src="<?= $movie['cover'].'@._V1_SY450_.jpg' ?>"/>
	</article>
	

<?php $this->stop('main_content') ?>
