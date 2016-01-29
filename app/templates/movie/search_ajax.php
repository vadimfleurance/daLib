<?php foreach($moviesFound as $movie) : ?>
	<article class="row search-movies">
		<div class="hidden-xs col-sm-3 col-md-3">
			<img src="<?=$movie['cover']?>@._V1__SY100_.jpg" class="img-responsive" alt="">
		</div>
		<div class="col-xs-12 col-sm-9 col-md-9">
			<a href="<?= $this->url('home') ?>"><h4><?=$movie['title']?> <small>(<?=$movie['year']?>)</small></h4></a>
			<p class="hidden-xs"><?=$movie['humans']?></p>
		</div>
	</article>
<?php endforeach; ?>
<a href="<?=$searchUrl?>" target="_blank">Rechercher <em><?=htmlentities($_GET['search'])?></em> sur IMDb</a>