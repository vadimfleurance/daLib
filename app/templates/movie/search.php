<?php $this->layout('layout', ['title' => 'Search | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>

<!-- Bouton previous et next en haut de la page -->
<?php if($page > 1):?>
	<a href="<?=$this->url('search', [ 'page' => $page - 1]) . '?search=' . $_GET['search']?>">Previous</a>
<?php endif; ?>

<?php if($page < $nbPage):?>
	<a href="<?=$this->url('search', [ 'page' => $page + 1]) . '?search=' . $_GET['search']?>">Next</a>
<?php endif; ?>
<br>
<!-- Affichage des numéros de page -->
<?php for($i=0; $i<$nbPage; $i++):?>
	<a href="<?=$this->url('search', [ 'page' => $i + 1]) . '?search=' . $_GET['search']?>"><?=$i+1?></a>
<?php endfor;?>

<!-- Affichage des résultats de la recherche -->
<?php foreach($moviesFound as $movie):?>
	<div>
		<a href="<?=$this->url('movie_detail', ['id' => $movie['id']])?>">
			<h4><?= $movie['title'] ?><?=$movie['year'] ? " <small>(" . $movie['year'] . ")</small>" : ''?></h4>
			<?php if($movie['cover']):?>
				<img src="<?=$movie['cover'] . '._V1__SY150_.jpg'?>" alt="<?=$movie['title']?>">
			<?php else:?>
				<img src="<?=$this->assetUrl('img/cover/placeholder_150.png')?>" alt="No cover available">
			<?php endif;?>
		<?php if($movie['directors']):?>
			<p>From : <?=$movie['directors']?></p>
		<?php endif;?>
		<?php if($movie['actors']):?>
			<p>With : <?=$movie['actors']?></p>
		<?php endif;?>
		</a>
	</div>
<?php endforeach; ?>

<!-- Bouton previous et next en bas de la page -->
<?php if($page > 1):?>
	<a href="<?=$this->url('search', [ 'page' => $page - 1]) . '?search=' . $_GET['search']?>">Previous</a>
<?php endif; ?>

<?php if($page < $nbPage):?>
	<a href="<?=$this->url('search', [ 'page' => $page + 1]) . '?search=' . $_GET['search']?>">Next</a>
<?php endif; ?>
<br>
<!-- Affichage des numéros de page -->
<?php for($i=0; $i<$nbPage; $i++):?>
	<a href="<?=$this->url('search', [ 'page' => $i + 1]) . '?search=' . $_GET['search']?>"><?=$i+1?></a>
<?php endfor;?>
<?php $this->stop('main_content') ?>