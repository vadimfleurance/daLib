<form class="clearfix" method="POST" action="<?= $this->url('login')?>">
	<div class="col-xs-12">
		<div class="form-group">
			<label class="sr-only" for="userLoginInput">Username Login</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<input type="text" class="form-control" id="userLoginInput" name="user[usernameOrEmail]" placeholder="Username / Email">
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="form-group">
			<label class="sr-only" for="passwordLoginInput">Password Login</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-lock"></i></div>
				<input type="password" class="form-control" id="passwordLoginInput" name="user[password]" placeholder="Password">
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="checkbox">
					<label for="rememberInput">
						<input type="checkbox" id="rememberInput" name="user[remember]"> Remember me
					</label>
				</div>
			</div>
			<div class="col-xs-120 col-sm-6">
				<a href="#" class="pull-right btn-link btn-forgot">Forgot ?</a>
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

	<div class="col-xs-12">
		<button type="submit" class="btn btn-default btn-block" name="action[login]" value="login" >Login</button>
	</div>
</form>