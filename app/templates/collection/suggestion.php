<?php $this->layout('layout', ['title' => 'Suggestion | Your collection of movies on daLib']) ?>

<?php $this->start('main_content') ?>
<section id="suggestion" class="section-padding">
	<div class="container">

		<div class="row text-center">
			<?php foreach ($suggestion as $movie ): ?>
				<a href="<?= $this->url('movie_detail',['id'=>$movie['id'] ]) ?>">
					<article class="col-xs-6 col-md-2">
						<figure>
							<img src=" <?= $movie['cover'].'._V1_SY250_.jpg' ?>" class="img-responsive center-block">
						</figure>
						<h4><?= $movie['title'] ?> <small>(<?= $movie['year'] ?>)</small></h4>
						<p class=""><i class="fa fa-star"></i> <?= $movie['imdbRating'] ?>/10</p>
					</article>
				</a>
			<?php endforeach ?>
		</div>
		<div class="row text-center">

			<nav class="suggestion-pagination">
				<ul class="pagination">
					<?php if($cPage <= 1):?>
						<li class="disabled">
							<a href="" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
					<?php else:?>
						<li>
							<a href="<?=$this->url('show_suggestion',['cPage' => $cPage-1])?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
					<?php endif;?>
					<?php for ($i=1 ; $i <= $nbPages; $i++): ?>
						<?php if($i == $cPage):?>
							<li class="active"><a href="<?=$this->url('show_suggestion',['cPage'=>$i])?>"><?=$i ?></a></li>
						<?php else:?>
							<li><a href="<?=$this->url('show_suggestion',['cPage'=>$i])?>"> <?=$i ?></a></li>
						<?php endif; ?>
					<?php endfor ; ?>
					<?php if($cPage >= $nbPages):?>
						<li class="disabled">
							<a href="" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					<?php else:?>
						<li>
							<a href="<?=$this->url('show_suggestion',['cPage' => $cPage+1])?>" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
					<?php endif;?>
				</ul>
			</nav>
		</div>


<?php $this->stop('main_content') ?>