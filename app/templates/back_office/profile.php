<?php $this->layout('layout', ['title' => 'Détail du User']) ?>

<?php $this->start('main_content') ?>
	
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
			</div>
		</div>
		<div class="col-xs-12">
			<div class="form-group">
				<label class="sr-only" for="emailRegisterInput">Email Register</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
					<input type="email" class="form-control" id="emailRegisterInput" name="user[email]" placeholder="Email" value="<?= $user['email']; ?>">
				</div>
			</div>
		</div>

		<select name="role" selected>
			<option value="admin">admin</option>
			<option value="user">user</option>
		</select>
		
		<div class="col-xs-12">
			<button type="submit" class="btn btn-default btn-block" name="action[modify]" value="modify" >Modify</button>
		</div>
	</form>

<?php $this->stop('main_content') ?>
