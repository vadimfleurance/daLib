<?php $this->layout('layout', ['title' => 'Movie Details | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	<section id="movie-details" class="section-padding">
		<article class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<figure>
						<img src="<?= $movie['cover'].'._V1_SY500_.jpg' ?>" class="img-responsive center-block" alt="Cover <?= $movie['title'] ?>">
					</figure>
				</div>
				<div class="col-xs-12 col-sm-8">
					<header>
						<h1><?= $movie['title'] ?> <small>(<?= $movie['year'] ?>)</small></h1>
						<p class="genre">
							<?php foreach($movie['genres'] as $genre):?>
								<span><?= $genre ?></span>
							<?php endforeach ?>
						</p>
					</header>
					<div class="row">
						<div class="col-xs-12 col-sm-8">
							<dl class="row">
								<dt class="col-xs-4 col-sm-3">Duration</dt>
								<dd class="col-xs-8 col-sm-9"><?= $movie['duration'] ?> min</dd>
								<dt class="col-xs-4 col-sm-3">Directors</dt>
								<dd class="col-xs-8 col-sm-9">
									<?php foreach($movie['directors'] as $director): ?>
										<span><?= $director ?></span>
									<?php endforeach ?>
								</dd>
								<dt class="col-xs-4 col-sm-3">Writers</dt>
								<dd class="col-xs-8 col-sm-9">
									<?php foreach($movie['writers'] as $writer): ?>
										<span><?= $writer ?></span>
									<?php endforeach ?>
								</dd>
								<dt class="col-xs-4 col-sm-3">Stars</dt>
								<dd class="col-xs-8 col-sm-9">
									<?php foreach($movie['stars'] as $star): ?>
										<span><?= $star ?></span>
									<?php endforeach ?>
								</dd>
							</dl>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="c100 p<?= $movie['imdbRating']*10 ?> small">
								<span><?= $movie['imdbRating'] ?>/10</span>
								<div class="slice">
									<div class="bar"></div>
									<div class="fill"></div>
								</div>
							</div>
						</div>
					</div>
					<p><?= $movie['synopsis'] ?></p>

					<?php if($movieCollectionFound): ?>
						<a href="<?= $this->url('manage_collection') ?>" class="btn btn-default to-collection" data-state="remove" data-mov-id="<?= $movie['id'] ?>"><i class="fa fa-minus"></i> Remove</a>
						<span>	
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($movieCollectionFound['watched'] === '1') ? 'btn-watched' : '' 	?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="watched" data-status-value="<?= $movieCollectionFound['watched'] ?>" ><i class="fa fa-eye"></i> Watched</a>
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($movieCollectionFound['toWatch'] === '1') ? 'btn-toWatch' : '' ?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="toWatch" data-status-value="<?= $movieCollectionFound['toWatch'] ?>" ><i class="fa fa-bookmark"></i> To Watch</a>
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($movieCollectionFound['owned'] === '1') ? 'btn-owned' : '' ?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="owned" data-status-value="<?= $movieCollectionFound['owned'] ?>" ><i class="fa fa-hand-lizard-o"></i> Got it!</a>
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($movieCollectionFound['wanted'] === '1') ? 'btn-wanted' : '' ?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="wanted" data-status-value="<?= $movieCollectionFound['wanted'] ?>" ><i class="fa fa-heart-o"></i> Want!</a>
						</span>
					<?php else: ?>
						<a href="<?= $this->url('manage_collection') ?>" class="btn btn-default to-collection" data-state="add" data-mov-id="<?= $movie['id'] ?>"><i class="fa fa-plus"></i> Add</a>
						<span class="hidden">
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($movieCollectionFound['watched'] === '1') ? 'btn-watched' : '' 	?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="watched" data-status-value="<?= $movieCollectionFound['watched'] ?>" ><i class="fa fa-eye"></i> Watched</a>
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($movieCollectionFound['toWatch'] === '1') ? 'btn-toWatch' : '' ?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="toWatch" data-status-value="<?= $movieCollectionFound['toWatch'] ?>" ><i class="fa fa-bookmark"></i> To Watch</a>
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($movieCollectionFound['owned'] === '1') ? 'btn-owned' : '' ?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="owned" data-status-value="<?= $movieCollectionFound['owned'] ?>" ><i class="fa fa-hand-lizard-o"></i> Got it!</a>
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($movieCollectionFound['wanted'] === '1') ? 'btn-wanted' : '' ?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="wanted" data-status-value="<?= $movieCollectionFound['wanted'] ?>" ><i class="fa fa-heart-o"></i> Want!</a>
						</span>
					<?php endif; ?>

					

				</div>
			</div>
		</article>
	</section>
<?php $this->stop('main_content') ?>
