<?php $this->layout('layout', ['title' => 'Search | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
<?php
foreach ($moviesFound as $movie) {
	?>
	<div>
		<h4><?=$movie['title']?></h4>
		<img src="<?=$movie['cover'] . '@._V1__SY200_.jpg'?>">
		<p><?=$movie['year']?></p>
		<p>From : <?=$movie['directors']?></p>
		<p>With : <?=$movie['actors']?></p>
	</div>
<?php
}
?>
<?php $this->stop('main_content') ?>