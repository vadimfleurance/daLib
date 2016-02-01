<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $this->e($title) ?></title>
	
	<link rel="stylesheet" href="<?= $this->assetUrl('css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/bootstrap-checkbox.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/owl-carousel.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/owl-theme.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/main.min.css') ?>">
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 bg-dalib">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?= (isset($w_user)) ? $this->url('add_movie') : $this->url('home'); ?>"><i class="fa fa-film"></i> daLib</a>
					</div>
				</div>

				<?php if(isset($w_user)) : ?>
				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-10">
					<div class="row collapse navbar-collapse" id="navbar-main">
						<div class="col-xs-12 col-sm-6">
							<form id="search-form" class="navbar-left" action="" data-ajax="<?=$this->url('search_ajax')?>" autocomplete="off">
								<div class="form-group">
									<label class="sr-only" for="searchInput">Search</label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-search"></i></div>
										<input type="search" class="form-control" id="search-input" name="search" placeholder="Search in daLib ...">
									</div>
								</div>
							</form>
							<div id="result-search-form" class="hidden-xs"></div>
						</div>
					
						<div class="col-xs-12 col-sm-6">
							<ul class="nav navbar-nav navbar-right">
								<li><a href="<?= $this->url('add_movie')?>"><i class="fa fa-plus"></i> Add a movie</a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<img src="<?= $this->assetUrl('img/users/default.png') ?>" class="img-reponsive img-circle user-avatar" alt="Photo de profil de John Doe"> <span><?= (isset($w_user)) ? $w_user['username'] : 'John Doe'; ?></span> <i class="fa fa-caret-down"></i>
									</a>
									<ul class="dropdown-menu">
										<li><a href=""><i class="fa fa-database"></i> Collection</a></li>
										<li><a href=""><i class="fa fa-user"></i> Profile</a></li>
										<li role="separator" class="divider hidden-xs"></li>
										<li><a href="<?= $this->url('logout')?>"><i class="fa fa-power-off"></i> Logout</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</nav>

	<main>
		<?= $this->section('main_content') ?>
	</main>

	<footer class="main-footer">daLib &copy; 2015 - All rights reserved</footer>

	<!-- scripts -->
	<script src="<?= $this->assetUrl('js/jquery-2.2.0.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/owl.carousel.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/main.min.js') ?>"></script>
</body>
</html>