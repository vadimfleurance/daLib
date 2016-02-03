<?php $this->layout('layout', ['title' => 'Back Office | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">		
				<h1>Back-Office :: Scrapping in progress</h1>
				
				<p>Start to scrap on click the link below.<p>

				<div class="col-xs-12 col-sm-4">
						<a href="<?= $this->url('launch_scrapper')?>" class="btn btn-default btn-block">Start Scraper</a>
				</div>

				<p>Don't do anything until the current tab is loading (check the wheel).</p>

				<p>When is done (you can see the favicon on the tab) you can do what you want :).</p>

				<div class="col-xs-12 col-sm-4">
					<a href="<?= $this->url('back_office')?>" class="btn btn-default btn-block">Back to Back-Office</a>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $this->stop('main_content') ?> 