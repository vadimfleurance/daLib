<?php $this->layout('layout', ['title' => 'Perdu ?']) ?>

<?php $this->start('main_content'); ?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<h1>404: Would you be trying to cut your steak with a fork? <i class="fa fa-hand-scissors-o"></i></h1>
				<a href="<?= $this->url('home') ?>" title="Back to the homepage">back to home you naughty little chimp!!!</a>
			</div>
		</div>
	</div>
</section>
<?php $this->stop('main_content'); ?>