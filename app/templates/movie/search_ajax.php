<section>
	<?php if($moviesFound) : ?>
		<?php foreach($moviesFound as $movie) : ?>
			<article class="row search-movies">
				<a href="<?= $this->url('home') ?>" title="Movie | <?=$movie['title']?>">
					<figure class="hidden-xs col-sm-3 col-md-3">
						<img src="<?=$movie['cover']?>@._V1__SY100_.jpg" class="img-responsive center-block" alt="<?=$movie['title']?>">
					</figure>
					<div class="col-xs-12 col-sm-9 col-md-9">
						<h4><?=$movie['title']?> <small>(<?=$movie['year']?>)</small></h4>
						<p class="hidden-xs"><?=$movie['humans']?></p>
					</div>
				</a>
			</article>
		<?php endforeach; ?>
	<?php else : ?>
		<article class="row search-movies-notfound">
			<div class="col-xs-12 col-sm-9 col-md-9">
				<p class="text-center">No results found ...</p>
			</div>
		</article>
	<?php endif; ?>
</section>
<footer><a href="<?= $this->url('add_movie') ?>" class="btn btn-link btn-block" target="_blank"><i class="fa fa-plus"></i> Add a movie</a></footer>