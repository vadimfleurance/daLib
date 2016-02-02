<section>
	<?php if($moviesFound) : ?>
		<?php foreach($moviesFound as $movie) : ?>
			<a href="<?= $this->url('movie_detail', ['id' => $movie['id']]) ?>" title="Movie | <?=$movie['title']?>">
				<article class="row search-movies">
					<figure class="hidden-xs col-sm-3 col-md-3">
						<img src="<?=$movie['cover']?>._V1__SY100_.jpg" class="img-responsive center-block" alt="<?=$movie['title']?>">
					</figure>
					<div class="col-xs-12 col-sm-9 col-md-9">
						<h4><?=$movie['title']?> <small>(<?=$movie['year']?>)</small></h4>
						<p class="hidden-xs"><?=$movie['humans']?></p>
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
<footer><a href="<?= $this->url('add_movie') ?>" class="btn btn-link btn-block" target="_blank"><i class="fa fa-plus"></i> Add a movie</a></footer>