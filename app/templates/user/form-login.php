<!-- Message d'erreur pour une mauvaise saisie du formulaire -->
<?php if(!empty($errors['total'])): ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php foreach($errors['total'] as $error ): ?>
			<p><strong>Error !</strong> <?= $error; ?></p>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<form method="POST" action="<?= $this->url('login')?>">
	<div class="form-group">
		<label class="sr-only" for="user-login-input">Username Login</label>
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-user"></i></div>
			<input type="text" class="form-control" id="user-login-input" name="user[usernameOrEmail]" placeholder="Username / Email">
		</div>
	</div>

	<div class="form-group">
		<label class="sr-only" for="password-login-input">Password Login</label>
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-lock"></i></div>
			<input type="password" class="form-control" id="password-login-input" name="user[password]" placeholder="Password">
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-7">
			<div class="checkbox">
				<input type="checkbox" id="remember-input" name="user[rememberMe]" value="checked">
				<label for="remember-input">
					Remember me
				</label>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<a href="<?= $this->url('forgot_password')?>" class="btn btn-link btn-forgot" title="Reset your password">Forgot ?</a>
		</div>
	</div>

	<button type="submit" class="btn btn-default btn-block btn-login" name="action[login]" value="login" >Login</button>
</form>