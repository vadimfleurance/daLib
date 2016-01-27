<?php
foreach ($moviesFound as $movie) {
	?>
	<div>		
		<h4><?=$movie['title']?></h4>
		<p><?=$movie['year']?></p>
		<p>Stars : <?=$movie['humans']?></p>		
	</div>
<?php
}
?>
<a href="<?=$searchUrl?>" target="_blank">Rechercher <em><?=htmlentities($_GET['search-input'])?></em> sur IMDb</a>