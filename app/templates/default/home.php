<?php $this->layout('layout', ['title' => 'daLib | Your collection of movies in your pocket', 'nav_title' => 'daLib']) ?>

<?php $this->start('main_content') ?>
	<section id="informations" class="full-section">
		<div class="container">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0">
					<header>
						<h3>daLib, what's it ?</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</header>
				</div>

				<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1">
					<!-- Nav tabs -->
					<div class="row">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active col-sm-6"><a href="#login-form" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
							<li role="presentation" class="col-sm-6"><a href="#register-form" aria-controls="register" role="tab" data-toggle="tab">Register</a></li>
						</ul>
					</div>

					<!-- Tab panes -->
					<div class="row">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="login-form">
								<?= $this->insert('user/form-login') ?>
							</div>
							<div role="tabpanel" class="tab-pane" id="register-form">
								<?= $this->insert('user/form-register' , [ 'errors' => $errors ]) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="top-10" class="full-section">
		<div class="container">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0">
					<header>
						<h1>Top 10</h1>
					</header>

					<div id="owl-demo" class="owl-carousel owl-theme">
						<!-- PHP - AJOUTER UNE BOUCLE QUI RECUPERE LE TOP 10 DES FILMS DE LA DB -->
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
						<div class="item">
							<img src="<?= $this->assetUrl('img/cover/test_thumb.jpg') ?>" class="img-responsive">
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
<?php $this->stop('main_content') ?>