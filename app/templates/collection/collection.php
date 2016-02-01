<?php $this->layout('layout', ['title' => 'Collection | Your collection of movies on daLib']) ?>

<?php $this->start('main_content') ?>
<section>
	<?php foreach ($collection['movies'] as $key =>$movie ): ?>

		<article>
			<a href="<?= $this->url('movie_detail',['id'=>$movie['id'] ]) ?>">
				<img src=" <?= $movie['cover'].'@._V1_SY125_.jpg' ?>">
				<h6><?= $movie['title'] ?></h6>
				<h6><?= $movie['year'] ?></h6>
				<h6><?= $movie['imdbRating'] ?></h6>
				<div class="div-collection-icons">
					<i class="fa fa-eye collection-icon" data-icon-status-value="<?= $collection['statuses'][$key]['watched'] ?>"></i>
					<i class="fa fa-bookmark collection-icon" data-icon-status-value="<?= $collection['statuses'][$key]['toWatch'] ?>"></i>
					<i class="fa fa-hand-lizard-o collection-icon" data-icon-status-value="<?= $collection['statuses'][$key]['owned'] ?>"></i>
				</div>	
			</a>
			
		
			
			
		</article>
		
	<?php endforeach ?>

</section>
<div>
	<?php for ($i=1 ; $i <= $nbPages; $i++): ?>
		<?php if($i == $cPage):?>
			<span><?=$i ?></span>
		<?php else:?>
			<span><a href="<?=$this->url('show_collection',['cPage'=>$i])?>"> <?=$i ?></a></span>
		<?php endif; ?>

		
	<?php endfor ; ?>
	 
</div>

<?php $this->stop('main_content') ?>