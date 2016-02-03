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
							<th class="hidden-xs">Email</th>
							<th class="hidden-xs">Registered</th>
							<th class="hidden-xs">Role</th>
							<th colspan="3">Options</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user ) : ?> 
							<tr>
								<td><?= $user['username'] ?></td>
								<td class="hidden-xs"><?= $user['email'] ?></td>
								<td class="hidden-xs"><?= $user['dateCreated'] ?></td>
								<td class="hidden-xs"><?= $user['role'] ?></td>
								<td><a href="<?= $this-> url('profile', ['id' => $user['id']] ); ?>" >Edition</td>
								<td><a href="<?= $this-> url('generate_new_password_user', ['id' => $user['id']] ); ?>" >Generate a new password</td>
								<td><a href="<?= $this-> url('delete_user', ['id' => $user['id']] ); ?>" >Delete</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-offset-2">
				<a href="<?= $this->url('back_office')?>" class="btn btn-default">Back to Back-Office</a>
			</div>
		</div>
	</div>
</section>
<?php $this->stop('main_content') ?>