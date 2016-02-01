<?php $this->layout('layout', ['title' => 'daLib | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	<section id="informations" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
					<header>
						<h1>daLib, what's that ?</h1>
						<p>Keep track of your personal movie collection in a user friendly interface. Foo library comes with many features.
						Add & delete movies or mark the ones you want to see. Get suggestions based on your tastes.
						You change ! Foo changes with you ! You're a fan join the dedicated chat and discuss with others !
						Join now or get your genitals cut off ! And as french says "foo parce qu'on est des foo !"</p>
					</header>
				</div>
				<div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2">
					<!-- Nav tabs -->
					<div class="row">
						<ul class="nav nav-tabs nav-justified" role="tablist">
							<li role="presentation" class="active"><a href="#login-form" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
							<li role="presentation"><a href="#register-form" aria-controls="register" role="tab" data-toggle="tab">Register</a></li>
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

	<section id="top-10" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0">
					<header>
						<h1>Top 10 movies of the week</h1>
					</header>
					
					<div id="owl-demo" class="owl-carousel owl-theme">
						<!-- PHP - AJOUTER UNE BOUCLE QUI RECUPERE LE TOP 10 DES FILMS DE LA DB -->
						<?php foreach($moviesFound as $movieFound):?>
							<div class="item">
								<a href="<?=$this->url('movie_detail', ['id' => $movieFound['id']])?>"><img src="<?=$movieFound['cover'] . '._V1_SY370_.jpg'?>" class="img-responsive"></a>
							</div>
						<?php endforeach;?>
					</div>

				</div>
			</div>
		</div>
	</section>
<?php $this->stop('main_content') ?>