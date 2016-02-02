<?php $this->layout('layout', ['title' => 'Suggestions | Your collection of movies on daLib']) ?>

<?php $this->start('main_content') ?>
	<?php foreach ($suggestion as $movie ): ?>
		<article>
			<a href="<?= $this->url('movie_detail',['id'=>$movie['id'] ]) ?>">
			
			</a>
		</article>

	<?php endforeach ?>

<?php $this->stop('main_content') ?>