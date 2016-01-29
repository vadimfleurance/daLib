<?php $this->layout('layout', ['title' => 'ForgottenPassword | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	
	<h1>Forgot Password ?</h1>
	
	<p>Write your address email choosen when register on dalib.com</p>
	<p>An email will be send after you submit the form below</p>

	<form class="clearfix" method="POST" action="<?= $this->url('forgot_password')?>">
		<div class="col-xs-12">
			<div class="form-group">
				<label class="sr-only" for="emailForgotPasswordInput">Email Forgot Password</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
					<input type="email" class="form-control" id="emailForgotPasswordInput" name="emailForgotPasswordInput" placeholder="Email">
				</div>
			</div>
		</div>

		<!-- Message d'erreur pour une mauvaise saisie du formulaire -->
		<?php 
			if (!empty( $errors['total'] )) : 
				foreach ( $errors['total'] as $error ) : ?>
					<p><?= $error; ?></p>
				<?php endforeach ;
			endif ; 
		?>
		<!-- -->
		
		<div class="col-xs-12">
			<button type="submit" class="btn btn-default btn-block" name="action[sendEmail]" value="send" >Send Email</button>
		</div>
	</form>
<?php $this->stop('main_content') ?> 