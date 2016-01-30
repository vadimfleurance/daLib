<?php $this->layout('layout', ['title' => 'Collection | Your collection of movies on daLib']) ?>

<?php $this->start('main_content') ?>
<section>
	<?php foreach ($collection['movies'] as $key =>$movie ): ?>
		<article>
			<a href="<?= $this->url('movie_detail',['id'=>$movie['id'] ]) ?>">
				<img src=" <?= $movie['cover'].'@._V1_SY125_.jpg' ?>">
				<h6><?= $movie['title'] ?></h6>
				<div class="div-collection-icons">
					<i class="fa fa-eye collection-icon" data-icon-status-value="<?= $collection['statuses'][$key]['watched'] ?>"></i>
					<i class="fa fa-bookmark collection-icon" data-icon-status-value="<?= $collection['statuses'][$key]['toWatch'] ?>"></i>
					<i class="fa fa-hand-lizard-o collection-icon" data-icon-status-value="<?= $collection['statuses'][$key]['owned'] ?>"></i>
				</div>	
			</a>
			
		
			
			
		</article>
		
	<?php endforeach ?>
</section>

<?php $this->stop('main_content') ?>