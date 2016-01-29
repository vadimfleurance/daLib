<!-- 
	Les erreurs sont envoyées dans un tableau associatif via le fichier "register.php" 
	qui insert le fichier courant ("form-register.php"). 
	C'est lors de cet insert qu'est passé en argument le tableau "$errors". 
	Ce tableau contient les erreurs correspondantes à chaque champs de saisi 
	du formulaire sous forme d'index : username, email, password et total.
	Cette étape est effectuée dans "UserController.php" dans sa méthode "register".

	Le "foreach" permet de pouvoir les afficher aux différents endroits et en fonctions du champs
	mal renseigné. 

	Le message d'erreur "$errors['total']" est appelé en bas du code car c'est le cas où aucun champs
	est correctement renseigné.
-->
<!-- Message d'erreur pour une mauvaise saisie du formulaire -->
<?php if(!empty($errors['total'])): ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php foreach($errors['total'] as $error ): ?>
			<p><strong>Error !</strong> <?= $error; ?></p>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<form class="clearfix" method="POST" action="<?= $this->url('register')?>">
	<div class="col-xs-12">
		<div class="form-group">
			<label class="sr-only" for="userRegisterInput">Username Register</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<input type="text" class="form-control" id="userRegisterInput" name="user[username]" placeholder="Username">
			</div>
			<!-- Message d'erreur pour un USERNAME déjà utilisé  -->
			<?php if (!empty( $errors['username'] )) : ?>
				<ul class="text-danger">
				<?php foreach ( $errors['username'] as $error ) : ?>
					<li><?= $error; ?></li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="form-group">
			<label class="sr-only" for="emailRegisterInput">Email Register</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
				<input type="email" class="form-control" id="emailRegisterInput" name="user[email]" placeholder="Email">
			</div>
			<!-- Message d'erreur pour une mauvaise saisie de l'EMAIL -->
			<?php if (!empty( $errors['email'] )) : ?>
				<ul class="text-danger">
				<?php foreach ( $errors['email'] as $error ) : ?>
					<li><?= $error; ?></li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>
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
			<?php if (!empty( $errors['password'] )) : ?>
				<ul class="text-danger">
				<?php foreach ( $errors['password'] as $error ) : ?>
					<li><?= $error; ?></li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
	<div class="col-xs-12">
		<button type="submit" class="btn btn-default btn-block btn-register" name="action[register]" value="register" >Register</button>
	</div>
</form>