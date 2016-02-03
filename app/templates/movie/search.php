<?php $this->layout('layout', ['title' => 'Search | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
<section class="section-padding">
	<div class="container">
		<div class="row">
		<!-- Si des films sont trouvés -->
		<?php if($moviesFound):?>
			<!-- Affichage des résultats de la recherche -->
			<?php foreach($moviesFound as $movie):?>
				<a href="<?= $this->url('movie_detail', ['id' => $movie['id']]) ?>" title="Movie | <?=$movie['title']?>">
					<article class="col-xs-12 col-sm-6 search-movies">
						<figure class="hidden-xs col-sm-3 col-md-3">
						<?php if($movie['cover']):?>
							<img src="<?=$movie['cover']?>._V1__SY100_.jpg" class="img-responsive center-block" alt="Cover <?=$movie['title']?>">
						<?php else:?>
							<img src="<?=$this->assetUrl('img/cover/placeholder_100.png') ?>" class="img-responsive center-block" alt="No cover available">
						<?php endif;?>
						</figure>
						<div class="col-xs-12 col-sm-9 col-md-9">
							<h4><?=$movie['title']?><?=$movie['year'] ? " <small>(" . $movie['year'] . ")</small>" : ''?></h4>
						<?php if($movie['directors']):?>
							<p>From : <?=$movie['directors']?></p>
						<?php endif;?>
						<?php if($movie['actors']):?>
							<p>With : <?=$movie['actors']?></p>
						<?php endif;?>
						</div>
					</article>
				</a>
			<?php endforeach; ?>
		<!-- Sinon si la recherche ne donne aucun résultat -->
		<?php else:?>
			<p>No results found...</p>
		<?php endif;?>
		</div>

			<!-- Bouton previous et next en bas de la page -->
			<div class="row text-center">
				<nav class="search-pagination">
					<ul class="pagination">
						<?php if($page <= 1):?>
							<li class="disabled">
								<a href="" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
								</a>
							</li>
						<?php else:?>
							<li>
								<a href="<?=$this->url('search',['page' => $page-1]).'?search='.$_GET['search']?>" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
								</a>
							</li>
						<?php endif;?>

						<?php for($i=1 ; $i <= $nbPage; $i++): ?>
							<?php if($i == $page):?>
								<li class="active"><a href="<?=$this->url('search',['page'=>$i]).'?search='.$_GET['search']?>"><?=$i ?></a></li>
							<?php else:?>
								<li><a href="<?=$this->url('search',['page'=>$i]).'?search='.$_GET['search']?>"> <?=$i ?></a></li>
							<?php endif; ?>
						<?php endfor; ?>

						<?php if($page >= $nbPage):?>
							<li class="disabled">
								<a href="" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
								</a>
							</li>
						<?php else:?>
							<li>
								<a href="<?=$this->url('search',['page' => $page+1]).'?search='.$_GET['search']?>" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
								</a>
							</li>
						<?php endif;?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</section>
<?php $this->stop('main_content') ?>