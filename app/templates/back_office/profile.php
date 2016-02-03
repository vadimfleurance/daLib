<?php $this->layout('layout', ['title' => 'Détail du User']) ?>

<?php $this->start('main_content') ?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">		
				<h2>Profile of the user : <?= $user['username'] ?></h2>

				<p>Member since : <?php echo $user['dateCreated']; ?><br>
				Id du user : <?php echo $user['id']; ?></p>

				<form method="POST">
					<div class="form-group">
						<label class="sr-only" for="userRegisterInput">Username Register</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-user"></i></div>
							<input type="text" class="form-control" id="userRegisterInput" name="user[username]" placeholder="Username" value="<?= $user['username']; ?>">
						</div>
					</div>
					<!-- Message de confirmation-->
					<?php if (!empty( $updatedRows['username'] )) : ?>
						<ul class="text-success">
						<?php foreach ( $updatedRows['username'] as $updatedRow ) : ?>
							<li><?= $updatedRow; ?></li>
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
					<?php if (!empty( $updatedRows['email'] )) : ?>
						<ul class="text-success">
						<?php foreach ( $updatedRows['email'] as $updatedRow ) : ?>
							<li><?= $updatedRow; ?></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<div class="form-group">
						<select name="role" class="form-control">
							<?php if ( $user['role'] == 'admin' ) { ?>
								<option value="admin" selected>admin</option>
								<option value="user">user</option>
							<?php } else { ?>
								<option value="admin">admin</option>
								<option value="user" selected>user</option>
							<?php } ?>
						</select>
					</div>
					<!-- Message de confirmation-->
					<?php if (!empty( $updatedRows['role'] )) : ?>
						<ul class="text-success">
						<?php foreach ( $updatedRows['role'] as $updatedRow ) : ?>
							<li><?= $updatedRow; ?></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<button type="submit" class="btn btn-default btn-block" name="action[modify]" value="modify" >Modify</button>
				</form>
				<br>
				<a href="<?= $this->url('back_office_users')?>" class="btn btn-default" title="Back to the list of users">Back to the list of users</a>
			</div>
		</div>
	</div>
</section>
<?php $this->stop('main_content') ?>
