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
							<th class="hidden-xs">Year</th>
							<th class="hidden-xs">Duration</th>
							<th class="hidden-xs">Created</th>
							<th class="hidden-xs">Modified</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($movies as $movie ) : ?> 
						<tr>
							<td><?= $movie['id'] ?></td>
							<td><?= $movie['title'] ?></td>
							<td class="hidden-xs"><?= $movie['year'] ?></td>
							<td class="hidden-xs"><?= $movie['duration'] ?>min</td>
							<td class="hidden-xs"><?= $movie['dateCreated'] ?></td>
							<td class="hidden-xs"><?= $movie['dateModified'] ?></td>
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