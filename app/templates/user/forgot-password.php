<?php $this->layout('layout', ['title' => 'ForgottenPassword | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	<section class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-8 col-md-offset-2">
					<h1>Forgot Password ?</h1>
					
					<p>Write your email address choosen when registered on dalib.com !<br>
					An email will be send after you submit the form below.</p>

					<!-- Message d'erreur pour une mauvaise saisie du formulaire -->
					<?php if(!empty($errors['total'])): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<?php foreach($errors['total'] as $error ): ?>
								<p><strong>Error !</strong> <?= $error; ?></p>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<form method="POST" action="<?= $this->url('forgot_password')?>">
						<div class="form-group">
							<label class="sr-only" for="emailForgotPasswordInput">Email Forgot Password</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
								<input type="email" class="form-control" id="emailForgotPasswordInput" name="emailForgotPasswordInput" placeholder="Email">
							</div>
						</div>
						<button type="submit" class="btn btn-default btn-block" name="action[sendEmail]" value="send" >Send Email</button>
					</form>
				</div>
			</div>
		</div>
	</section>
<?php $this->stop('main_content') ?> 