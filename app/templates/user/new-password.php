<?php $this->layout('layout', ['title' => 'New PassWord | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-sm-offset-2">
					<h1>Need a New Password</h1>
					
					<p>Do you need a new password ? If you are here you are in this case :).<br>
					Please write a new password in the field below<br>
					Rewrite your new password in the field below and remember it :) !</p>

					<!-- Message d'erreur pour une mauvaise saisie du formulaire -->
					<?php if(!empty($errors['total'])): ?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<?php foreach($errors['total'] as $error ): ?>
								<p><strong>Error !</strong> <?= $error; ?></p>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<form class="clearfix" method="POST">
						<div class="form-group">
							<label class="sr-only" for="newPasswordInput">New Password</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-lock"></i></div>
								<input type="password" class="form-control" id="newPasswordInput" name="user[newPassword]" placeholder="Your new password">
							</div>
						</div>
						<div class="form-group">
							<label class="sr-only" for="newPasswordInputConfirm">New Password Confirm</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-lock"></i></div>
								<input type="password" class="form-control" id="newPasswordInputConfirm" name="user[newPasswordBis]" placeholder="your new password again">
							</div>
						</div>

						<!-- Message d'erreur pour une mauvaise saisie du PASSWORD -->
						<?php if (!empty( $errors['password'] )) : ?>
							<ul class="text-danger">
							<?php foreach ( $errors['password'] as $error ) : ?>
								<li><?= $error; ?></li>
							<?php endforeach; ?>
							</ul>
						<?php endif; ?>
						<button type="submit" class="btn btn-default btn-block" name="action[sendRequest]" value="send" >Send request</button>
					</form>
				</div>
			</div>
		</div>
	</section>
<?php $this->stop('main_content') ?> 