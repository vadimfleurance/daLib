<?php $this->layout('layout', ['title' => 'Détail du User']) ?>

<?php $this->start('main_content') ?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">		
				<h2>Welcome on your profile page : <?= $user['username'] ?></h2>

				<p>Your are a daLib member since : <?php echo $user['dateCreated']; ?><br></p>

				<form method="POST">
					<div class="form-group">
						<label class="sr-only" for="userRegisterInput">Username Register</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-user"></i></div>
							<input type="text" class="form-control" id="userRegisterInput" name="user[username]" placeholder="Username" value="<?= $user['username']; ?>">
						</div>
					</div>
					
					<!-- Message de confirmation-->
					<?php 
						if (!empty( $updatedRows['username'] )) : 
							foreach ( $updatedRows['username'] as $updatedRow ) : ?>
								<p><?= $updatedRow; ?></p>
							<?php endforeach ;
						endif ; 
					?>

					<!-- Message d'erreur pour un USERNAME déjà utilisé  -->
					<?php if (!empty( $errors['username'] )) : ?>
						<ul class="text-danger">
						<?php foreach ( $errors['username'] as $error ) : ?>
							<li><?= $error; ?></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					
					<div class="form-group">
						<label class="sr-only" for="emailRegisterInput">Email Register</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
							<input type="email" class="form-control" id="emailRegisterInput" name="user[email]" placeholder="Email" value="<?= $user['email']; ?>">
						</div>
					</div>

					<!-- Message de confirmation-->
					<?php 
						if (!empty( $updatedRows['email'] )) : 
							foreach ( $updatedRows['email'] as $updatedRow ) : ?>
								<p><?= $updatedRow; ?></p>
							<?php endforeach ;
						endif ; 
					?>

					<!-- Message d'erreur pour une mauvaise saisie de l'EMAIL -->
					<?php if (!empty( $errors['email'] )) : ?>
						<ul class="text-danger">
						<?php foreach ( $errors['email'] as $error ) : ?>
							<li><?= $error; ?></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				
					<div class="form-group">
						<label class="sr-only" for="passwordRegisterInput">Password Register</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-lock"></i></div>
							<input type="password" class="form-control" id="passwordRegisterInput" name="user[password]" placeholder="Password">
						</div>
					</div>

					<div class="form-group">
						<label class="sr-only" for="passwordConfirmRegisterInput">Password Confirm Register</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-lock"></i></div>
							<input type="password" class="form-control" id="passwordConfirmRegisterInput" name="user[passwordBis]" placeholder="Password Confirm">
						</div>
					</div>

					<!-- Message de confirmation-->
					<?php 
						if (!empty( $updatedRows['password'] )) : 
							foreach ( $updatedRows['password'] as $updatedRow ) : ?>
								<p><?= $updatedRow; ?></p>
							<?php endforeach ;
						endif ; 
					?>

					<!-- Message d'erreur pour une mauvaise saisie du PASSWORD -->
					<?php if (!empty( $errors['password'] )) : ?>
						<ul class="text-danger">
						<?php foreach ( $errors['password'] as $error ) : ?>
							<li><?= $error; ?></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<label for="icone">Icône du fichier (JPG, PNG ou GIF | max. 15 Ko) :</label><br>
     				<input type="file" name="icone" id="icone"><br>
					
					<button type="submit" class="btn btn-default btn-block" name="action[modify]" value="modify" >Modify</button>
				</form>
			</div>
		</div>
	</div>
</section>
<?php $this->stop('main_content') ?>
