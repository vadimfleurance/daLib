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

	<?= $this->insert('default/navigation') ?>

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