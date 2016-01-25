<?php $this->layout('layout', ['title' => 'daLib | Your collection of movies in your pocket', 'nav_title' => 'daLib']) ?>

<?php $this->start('main_content') ?>
	<section id="informations" class="full-section">
		<div class="container">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0">
					<header>
						<h3>daLib, what's it ?</h3>
						<p>Keep track of your personal movie collection in a user friendly interface. Foo library comes with many features.
						Add & delete movies or mark the ones you want to see. Get suggestions based on your tastes.
						You change ! Foo changes with you ! You're a fan join the dedicated chat and discuss with others !
						Join now or get your genitals cut off ! And as french says "foo parce qu'on est des foo !"</p>
					</header>
				</div>

				<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1">
					<!-- Nav tabs -->
					<div class="row">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active col-xs-6 col-sm-6"><a href="#login-form" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
							<li role="presentation" class="col-xs-6 col-sm-6"><a href="#register-form" aria-controls="register" role="tab" data-toggle="tab">Register</a></li>
						</ul>
					</div>

					<!-- Tab panes -->
					<div class="row">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="login-form">
								<?= $this->insert('user/form-login') ?>
							</div>
							<div role="tabpanel" class="tab-pane" id="register-form">
								<?= $this->insert('user/form-register') ?>
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