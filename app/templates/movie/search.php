<?php $this->layout('layout', ['title' => 'Search | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
<form method="get" action="">
	<input type="hidden" name="search" value="<?=htmlentities($_GET['search'])?>">
	<label for="element">Number of elements</label>
	<select id ="elements" name="elements">
		<option selected>10</option>
		<option>20</option>
		<option>30</option>
	</select>
	<input type="submit">
</form>
<?php
foreach($moviesFound as $movie){
	?>
	<div>
		<a href="<?=$this->url('movie_detail', ['id' => $movie['id']])?>">
			<h4><?=$movie['title']?></h4>
			<img src="<?=$movie['cover'] . '._V1__SY150_.jpg'?>" alt="<?=$movie['title']?>">
			<p><?=$movie['year']?></p>
			<p>From : <?=$movie['directors']?></p>
			<p>With : <?=$movie['actors']?></p>
		</a>
	</div>
<?php
}
if (!empty($_GET['page'])){
	if($_GET['page'] > 1){
		?>
		<a href="<?=$this->url('search')?>">Previous</a>
	<?php		
	}
}
?>
<?php $this->stop('main_content') ?>