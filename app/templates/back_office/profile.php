<?php $this->layout('layout', ['title' => 'Détail du User']) ?>

<?php $this->start('main_content') ?>
	
	<!-- <?= debug($user); ?> -->

	<h2>Détail du user : <?= $user['username'] ?></h2>

	Date d'inscription : <?php echo $user['dateCreated']; ?><br>
	Id du user : <?php echo $user['id']; ?><br>
	<br>
	<br>
	<form class="clearfix" method="POST">
		<div class="col-xs-12">
			<div class="form-group">
				<label class="sr-only" for="userRegisterInput">Username Register</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-user"></i></div>
					<input type="text" class="form-control" id="userRegisterInput" name="user[username]" placeholder="Username" value="<?= $user['username']; ?>">
				</div>

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
				
				<!-- Message d'erreur pour un USERNAME déjà utilisé  -->
				<?php 
					if (!empty( $errors['username'] )) : 
						foreach ( $errors['username'] as $error ) : ?>
							<p><?= $error; ?></p>
						<?php endforeach ;
					endif ; 
				?>
				<!-- -->

			</div>
		</div>
		<div class="col-xs-12">
			<div class="form-group">
				<label class="sr-only" for="emailRegisterInput">Email Register</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
					<input type="email" class="form-control" id="emailRegisterInput" name="user[email]" placeholder="Email" value="<?= $user['email']; ?>">
				</div>

				<!-- Message d'erreur pour une adresse EMAIL déjà utilisé -->
				<?php 
					if (!empty( $errors['email'] )) : 
						foreach ( $errors['email'] as $error ) : ?>
							<p><?= $error; ?></p>
						<?php endforeach ;
					endif ; 
				?>
				<!-- -->

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
		
		<select name="role">
			<option value="admin">admin</option>
			<option value="user">user</option>
		</select>
		
		


		<div class="col-xs-12">
			<button type="submit" class="btn btn-default btn-block" name="action[modify]" value="modify" >Modify</button>
		</div>
	</form>




<?php $this->stop('main_content') ?>
