<?php $this->layout('layout', ['title' => 'Back Office | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">	
				<h1>Back-Office :: List of Users</h1>
				
				<table class="table">
					<thead>
						<tr>
							<th>Username</th>
							<th>Email</th>
							<th>Registered</th>
							<th>Role</th>
							<th colspan="3">Options</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user ) : ?> 
							<tr>
								<td><?= $user['username'] ?></td>
								<td><?= $user['email'] ?></td>
								<td><?= $user['dateCreated'] ?></td>
								<td><?= $user['role'] ?></td>
								<td><a href="<?= $this-> url('profile', ['id' => $user['id']] ); ?>" >Edition</td>
								<td><a href="<?= $this-> url('forgot_password'); ?>" >Generate a new password</td>
								<td><a href="<?= $this-> url('delete_user', ['id' => $user['id']] ); ?>" >Delete</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<?php $this->stop('main_content') ?>