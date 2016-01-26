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
	<!-- <nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-2 navbar-title bg-dalib">
					<h1><i class="fa fa-book"></i> <?= $this->e($nav_title) ?></h1>
				</div>
				
				<div class="col-xs-12 col-sm-9 col-md-10">
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<form>
								<label class="sr-only" for="searchInput">Search</label>
								<input type="search" class="form-control" id="searchInput" name="Search in daLib ...">
							</form>
						</div>
						<div class="col-xs-12 col-sm-6">
							<a href="#"><i class="fa fa-plus"></i> Add a movie</a>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</nav> -->

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-2 bg-dalib">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><i class="fa fa-film"></i> <?= $this->e($nav_title) ?></a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-10">
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<form id="search-form">
									<div class="form-group">
										<label class="sr-only" for="searchInput">Search</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-search"></i></div>
											<input type="search" class="form-control" id="searchInput" name="search" placeholder="Search in daLib ...">
										</div>
									</div>
								</form>
							</div>
							<div class="col-xs-12 col-sm-6">
								<ul class="nav navbar-nav">
									<li><a href="#"><i class="fa fa-plus"></i> Add a movie</a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
											<img src="<?= $this->assetUrl('img/users/.png') ?>" class="img-reponsive img-circle" alt="Photo de profil de John Doe">
											<p>John Doe</p>
											<i class="fa fa-caret-down"></i>
										</a>
										<ul class="dropdown-menu">
											<li><a href="#">Collection</a></li>
											<li><a href="#">Settings</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="#">Logout</a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
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