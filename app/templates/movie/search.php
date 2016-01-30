<?php $this->layout('layout', ['title' => 'Search | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
<?php
foreach ($moviesFound as $movie) {
	?>
	<div>
		<a href="<?=$this->url('movie_detail', ['id' => $movie['id']])?>">
			<h4><?=$movie['title']?></h4>
			<img src="<?=$movie['cover'] . '@._V1__SY150_.jpg'?>" alt="<?=$movie['title']?>">
			<p><?=$movie['year']?></p>
			<p>From : <?=$movie['directors']?></p>
			<p>With : <?=$movie['actors']?></p>
		</a>
	</div>
<?php
}
?>
<?php $this->stop('main_content') ?>