<form class="clearfix" method="POST" action="<?= $this->url('register')?>">
	<div class="col-xs-12">
		<div class="form-group">
			<label class="sr-only" for="userRegisterInput">Username Register</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<input type="text" class="form-control" id="userRegisterInput" name="user[username]" placeholder="Username">
			</div>

			<!-- Message d'erreur pour un USERNAME déjà utilisé -->
			<?=  $errors['username']; ?>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="form-group">
			<label class="sr-only" for="emailRegisterInput">Email Register</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<input type="email" class="form-control" id="emailRegisterInput" name="user[email]" placeholder="Email">
			</div>

			<!-- Message d'erreur pour une adresse EMAIL déjà utilisé -->
			<?= $errors['email']; ?>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="form-group">
			<label class="sr-only" for="passwordRegisterInput">Password Register</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-lock"></i></div>
				<input type="password" class="form-control" id="passwordRegisterInput" name="user[password]" placeholder="Password">
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="form-group">
			<label class="sr-only" for="passwordConfirmRegisterInput">Password Confirm Register</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-lock"></i></div>
				<input type="password" class="form-control" id="passwordConfirmRegisterInput" name="user[passwordBis]" placeholder="Password Confirm">
			</div>

			<!-- Message d'erreur pour une mauvaise saisie du PASSWORD -->
			<?= $errors['password']; ?>
		</div>
	</div>
	

	<div class="col-xs-12">
		<button type="submit" class="btn btn-default btn-block" name="action[register]" value="register" action="">Login</button>
	</div>
</form>