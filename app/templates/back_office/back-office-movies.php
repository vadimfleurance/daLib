<?php $this->layout('layout', ['title' => 'Back Office | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">	
				<h1>Back-Office :: List of Movies</h1>
				
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>Year</th>
							<th>Duration</th>
							<th>Created</th>
							<th>Modified</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($movies as $movie ) : ?> 
						<tr>
							<td><?= $movie['id'] ?></td>
							<td><?= $movie['title'] ?></td>
							<td><?= $movie['year'] ?></td>
							<td><?= $movie['duration'] ?>min</td>
							<td><?= $movie['dateCreated'] ?></td>
							<td><?= $movie['dateModified'] ?></td>
							<td><a href="<?= $this->url('detail', ['id' => $movie['id']]); ?>" >Edition</td>
						</tr>
					<?php endforeach; ?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<?php $this->stop('main_content') ?> 