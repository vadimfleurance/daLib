<?php $this->layout('layout', ['title' => 'Back Office | Your collection of movies in your pocket']) ?>

<?php $this->start('main_content') ?>
	
	<h1>Back-Office</h1>
		
	<p>Movies</p>

	<table>

		<?php foreach ($movies as $movie ) : ?> 

			<tr>
				<td><?= $movie['id'] ?></td>
				<td><?= $movie['title'] ?></td>
				<td><?= $movie['year'] ?></td>
				<td><?= $movie['duration'] ?></td>
				<td><?= $movie['dateCreated'] ?></td>
				<td><?= $movie['dateModified'] ?></td>
				<td><a href="<?= $this->url('detail', ['id' => $movie['id']]); ?>" >Custom</td>
			</tr>

		<?php endforeach; ?>	

	</table>

<?php $this->stop('main_content') ?> 