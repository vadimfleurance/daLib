<?php $this->layout('layout', ['title' => 'Back Office | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	
	<h1>Back-Office</h1>
	
	<p>Users</p>

	<table>

		<?php foreach ($users as $user ) : ?> 

			<tr>
				<td><?= $user['username'] ?></td>
				<td><?= $user['email'] ?></td>
				<td><?= $user['dateCreated'] ?></td>
				<td><?= $user['role'] ?></td>
				<td><a href="<?= $this-> url('profile', ['id' => $user['id']] ); ?>" >Custom</td>
				<td><a href="<?= $this-> url('forgot_password'); ?>" >Generate a new password</td>
				<td><a href="<?= $this-> url('delete_user', ['id' => $user['id']] ); ?>" >Delete</td>
			</tr>

		<?php endforeach; ?>	

	</table>

<?php $this->stop('main_content') ?>