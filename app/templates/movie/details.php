<?php $this->layout('layout', ['title' => 'Movie Details | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	<section id="movie-details" class="section-padding">
		<article class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<figure>
					<?php if($movie['cover']):?>
						<img src="<?= $movie['cover'].'._V1_SY500_.jpg' ?>" class="img-responsive center-block" alt="Cover <?= $movie['title'] ?>">
					<?php else:?>
						<img src="<?=$this->assetUrl('img/cover/placeholder_500.png') ?>" class="img-responsive center-block" alt="No cover available">
					<?php endif;?>
					</figure>
				</div>
				<div class="col-xs-12 col-sm-8">
					<header>
						<h1><?= $movie['title'] ?> <?=$movie['year'] ? "<small>(" . $movie['year'] . ")</small>" : ''?></h1>
						<?php if($movie['genres']):?>
						<p class="genre">
							<?php $i = 0;?>
							<?php foreach($movie['genres'] as $genre):?>
								<?php $i++;?>
								<?php if($genresNb == $i ):?>
								<span><?=$genre?></span>
								<?php else:?>
								<span><?=$genre . ', '?></span>
								<?php endif;?>
							<?php endforeach ?>
						</p>
						<?php endif;?>
					</header>
					<div class="row">
						<div class="col-xs-12 col-sm-8">
							<dl class="row">
							<?php if($movie['duration']):?>
								<dt class="col-xs-4 col-sm-3">Duration</dt>
								<dd class="col-xs-8 col-sm-9"><?=$movie['duration']?></dd>
							<?php endif;?>
							<?php if($movie['directors']):?>
								<dt class="col-xs-4 col-sm-3">Directors</dt>
								<dd class="col-xs-8 col-sm-9">
								<?php $i = 0;?>
									<?php foreach($movie['directors'] as $director): ?>
										<?php $i++;?>
										<?php if($directorsNb == $i ):?>
											<span><?= $director?></span>
										<?php else:?>
											<span><?=$director . ', '?></span>
										<?php endif;?>
									<?php endforeach ?>
							<?php endif;?>
								</dd>
								<?php if($movie['writers']):?>
								<dt class="col-xs-4 col-sm-3">Writers</dt>
								<dd class="col-xs-8 col-sm-9">
								<?php $i = 0;?>
									<?php foreach($movie['writers'] as $writer): ?>
										<?php $i++;?>
										<?php if($writersNb == $i ):?>
											<span><?= $writer?></span>
										<?php else:?>
											<span><?=$writer . ', '?></span>
										<?php endif;?>
									<?php endforeach ?>
								<?php endif;?>
								</dd>
								<?php if($movie['stars']):?>
								<dt class="col-xs-4 col-sm-3">Stars</dt>
								<dd class="col-xs-8 col-sm-9">
								<?php $i = 0;?>
									<?php foreach($movie['stars'] as $star): ?>
										<?php $i++;?>
										<?php if($starsNb == $i ):?>
											<span><?= $star?></span>
										<?php else:?>
											<span><?=$star . ', '?></span>
										<?php endif;?>
									<?php endforeach ?>
								<?php endif;?>
								</dd>
							</dl>
						</div>
						<?php if($movie['imdbRating']):?>
						<div class="col-xs-12 col-sm-4">
							<div class="c100 p<?= $movie['imdbRating']*10 ?> small">
								<span><?= $movie['imdbRating'] ?>/10</span>
								<div class="slice">
									<div class="bar"></div>
									<div class="fill"></div>
								</div>
							</div>
						</div>
						<?php endif;?>
					</div>
					<?php if($movie['synopsis']):?>
						<p><?= $movie['synopsis'] ?></p>
					<?php else: ?>
						<p>No synopsis</p>
					<?php endif;?>

					<?php if($isPresent): ?>
						<a href="<?= $this->url('manage_collection') ?>" class="btn btn-default to-collection" data-state="remove" data-mov-id="<?= $movie['id'] ?>"><i class="fa fa-minus"></i> Remove</a>
						<span>	
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($statusValues['watched'] === '1') ? 'btn-watched' : '' 	?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="watched" data-status-value="<?= $statusValues['watched'] ?>" ><i class="fa fa-eye"></i> Watched</a>
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($statusValues['toWatch'] === '1') ? 'btn-toWatch' : '' ?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="toWatch" data-status-value="<?= $statusValues['toWatch'] ?>" ><i class="fa fa-bookmark"></i> To Watch</a>
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($statusValues['owned'] === '1') ? 'btn-owned' : '' ?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="owned" data-status-value="<?= $statusValues['owned'] ?>" ><i class="fa fa-hand-lizard-o"></i> Got it!</a>
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($statusValues['wanted'] === '1') ? 'btn-wanted' : '' ?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="wanted" data-status-value="<?= $statusValues['wanted'] ?>" ><i class="fa fa-heart-o"></i> Want!</a>
						</span>
					<?php else: ?>
						<a href="<?= $this->url('manage_collection') ?>" class="btn btn-default to-collection" data-state="add" data-mov-id="<?= $movie['id'] ?>"><i class="fa fa-plus"></i> Add</a>
						<span class="hidden">
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($statusValues['watched'] === '1') ? 'btn-watched' : '' 	?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="watched" data-status-value="<?= $statusValues['watched'] ?>" ><i class="fa fa-eye"></i> Watched</a>
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($statusValues['toWatch'] === '1') ? 'btn-toWatch' : '' ?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="toWatch" data-status-value="<?= $statusValues['toWatch'] ?>" ><i class="fa fa-bookmark"></i> To Watch</a>
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($statusValues['owned'] === '1') ? 'btn-owned' : '' ?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="owned" data-status-value="<?= $statusValues['owned'] ?>" ><i class="fa fa-hand-lizard-o"></i> Got it!</a>
							<a href="<?= $this->url('status_manage') ?>" class="btn btn-default status-link <?= ($statusValues['wanted'] === '1') ? 'btn-wanted' : '' ?>" data-mov-id="<?= $movie['id'] ?>" data-status-type="wanted" data-status-value="<?= $statusValues['wanted'] ?>" ><i class="fa fa-heart-o"></i> Want!</a>
						</span>
					<?php endif; ?>
				</div>
			</div>
		</article>
	</section>
<?php $this->stop('main_content') ?>