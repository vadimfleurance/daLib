<?php $this->layout('layout', ['title' => 'New PassWord | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	
	<h1>Need a New Password</h1>
	
	<p>Do you need a new password ? If you are here you are in this case :).</p>

	<p>Please write a new password in the field below</p>

	<p>Rewrite your new password in the field below and remember it :) !</p>

	<form class="clearfix" method="POST">
		<div class="col-xs-12">
			<div class="form-group">
				<label class="sr-only" for="newPasswordInput">New Password</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-lock"></i></div>
					<input type="password" class="form-control" id="newPasswordInput" name="user[newPassword]" placeholder="Your new password">
				</div>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="form-group">
				<label class="sr-only" for="newPasswordInputConfirm"> New Password Confirm</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-lock"></i></div>
					<input type="password" class="form-control" id="newPasswordInputConfirm" name="user[newPasswordBis]" placeholder="your new password again">
				</div>
			</div>
		</div>

		<!-- Message d'erreur pour une mauvaise saisie du PASSWORD -->
		<?php 
			if (!empty( $errors['password'] )) : 
				foreach ( $errors['password'] as $error ) : ?>
					<p><?= $error; ?></p>
				<?php endforeach ;
			endif ; 
		?>
		<!-- -->

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
			<button type="submit" class="btn btn-default btn-block" name="action[sendRequest]" value="send" >Send request</button>
		</div>
	</form>

<?php $this->stop('main_content') ?> 