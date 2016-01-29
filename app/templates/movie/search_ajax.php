<?php foreach($moviesFound as $movie) : ?>
	<article class="row">
		<div class="col-xs-1">
			<img src="<?=$movie['cover']?>@._V1__SY75_.jpg" alt="">
		</div>
		<div class="col-xs-11">
			<h4><?=$movie['title']?> <small>(<?=$movie['year']?>)</small></h4>
			<p><?=$movie['humans']?></p>
		</div>
	</article>
<?php endforeach; ?>
<a href="<?=$searchUrl?>" target="_blank">Rechercher <em><?=htmlentities($_GET['search'])?></em> sur IMDb</a>