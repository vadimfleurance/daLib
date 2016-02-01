<?php $this->layout('layout', ['title' => 'Search | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>

<!-- Bouton previous et next en haut de la page -->
<?php if($page > 1):?>
	<a href="<?=$this->url('search', [ 'page' => $page - 1, 'search' => $search])?>">Previous</a>
<?php endif; ?>

<?php if($page < $nbPage):?>
	<a href="<?=$this->url('search', [ 'page' => $page + 1, 'search' => $search])?>">Next</a>
<?php endif; ?>
<br>
<!-- Affichage des numéros de page -->
<?php for($i=0; $i<$nbPage; $i++):?>
	<a href="<?=$this->url('search', [ 'page' => $i + 1, 'search' => $search])?>"><?=$i+1?></a>
<?php endfor;?>

<?php foreach($moviesFound as $movie):?>
	<div>
		<a href="<?=$this->url('movie_detail', ['id' => $movie['id']])?>">
			<h4><?=$movie['title']?></h4>
			<img src="<?=$movie['cover'] . '._V1__SY150_.jpg'?>" alt="<?=$movie['title']?>">
			<p><?=$movie['year']?></p>
			<p>From : <?=$movie['directors']?></p>
			<p>With : <?=$movie['actors']?></p>
		</a>
	</div>
<?php endforeach; ?>

<!-- Bouton previous et next en bas de la page -->
<?php if($page > 1):?>
	<a href="<?=$this->url('search', [ 'page' => $page - 1, 'search' => $search])?>">Previous</a>
<?php endif; ?>

<?php if($page < $nbPage):?>
	<a href="<?=$this->url('search', [ 'page' => $page + 1, 'search' => $search])?>">Next</a>
<?php endif; ?>
<br>
<!-- Affichage des numéros de page -->
<?php for($i=0; $i<$nbPage; $i++):?>
	<a href="<?=$this->url('search', [ 'page' => $i + 1, 'search' => $search])?>"><?=$i+1?></a>
<?php endfor;?>
<?php $this->stop('main_content') ?>