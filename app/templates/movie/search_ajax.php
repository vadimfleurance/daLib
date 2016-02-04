<section>
	<?php if($moviesFound) : ?>
		<?php foreach($moviesFound as $movie) : ?>
			<a href="<?= $this->url('movie_detail', ['id' => $movie['id']]) ?>" title="Movie Detail | <?=$movie['title']?>">
				<article class="row search-movies">
					<figure class="hidden-xs col-sm-3 col-md-3">
					<?php if($movie['cover']):?>
						<img src="<?=$movie['cover']?>._V1__SY100_.jpg" class="img-responsive center-block" alt="Cover <?=$movie['title']?>">
					<?php else:?>
						<img src="<?=$this->assetUrl('img/cover/placeholder_100.png') ?>" class="img-responsive center-block" alt="No cover available">
					<?php endif;?>
					</figure>
					<div class="col-xs-12 col-sm-9 col-md-9">
						<h4><?=$movie['title']?><?=$movie['year'] ? " <small>(" . $movie['year'] . ")</small>" : ''?></h4>
					<?php if($movie['humans']):?>
						<p class="hidden-xs"><?=$movie['humans']?></p>
					<?php endif;?>
					</div>
				</article>
			</a>
		<?php endforeach; ?>
	<?php else : ?>
		<article class="row search-movies-notfound">
			<p class="text-center">No results found ...</p>
		</article>
	<?php endif; ?>
</section>
<footer><a href="<?= $this->url('add_movie') ?>" class="btn btn-link btn-block" title="Add a movie"><i class="fa fa-plus"></i> Add a movie</a></footer>