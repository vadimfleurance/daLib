<?php $this->layout('layout', ['title' => 'Back Office | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<h1>Back-Office</h1>

				<p>Welcome, <span class="text-primary"><?= $w_user['username']; ?></span> ! You are admin of daLib.com ! Be carefull </p>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<a href="<?= $this->url('scrapper_home')?>" class="btn btn-default btn-block">Scraper</a>
					</div>
					<div class="col-xs-12 col-sm-4">
						<a href="<?= $this->url('back_office_users')?>" class="btn btn-default btn-block">List of Users</a>
					</div>
					<div class="col-xs-12 col-sm-4">
						<a href="<?= $this->url('back_office_movies')?>" class="btn btn-default btn-block">List of Movies</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $this->stop('main_content') ?> 