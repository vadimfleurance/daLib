<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $this->e($title) ?></title>

	<link rel="stylesheet" href="<?= $this->assetUrl('css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/owl-carousel.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/owl-theme.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.min.css') ?>">
</head>
<body>
	<nav class="navbar navbar-default">
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
	</nav>

	<main>
		<!--
			Variable créée par le framework W contenant les infos de l'utilisateur 
			et permettant de vérifier que la connexion est réussie
		-->
		<?php  debug($w_user); ?>

		<?= $this->section('main_content') ?>
	</main>

	<footer class="main-footer">&copy; 2015 - All rights reserved</footer>

	<!-- scripts -->
	<script src="<?= $this->assetUrl('js/jquery-2.2.0.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/owl.carousel.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('js/main.min.js') ?>"></script>
</body>
</html>