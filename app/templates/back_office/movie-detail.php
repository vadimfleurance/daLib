<?php $this->layout('layout', ['title' => 'Détail du Movie']) ?>

<?php $this->start('main_content') ?>
	
	<h2>Détail du movie : <?= $movie['title']; ?>  </h2>
	
	<form class="clearfix" method="POST">
	<div class="col-xs-7">
		<div class="form-group">
			<label class="sr-only" for="movieTitleInput">Title</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<input type="text" class="form-control" id="movieTitleInput" name="movie[title]" placeholder="Title" value="<?= $movie['title']; ?>">
			</div>
		</div>
	</div>
	<!-- Message de confirmation-->
	<?php 
		if (!empty( $updatedRows['title'] )) : 
			foreach ( $updatedRows['title'] as $updatedRow ) : ?>
				<p><?= $updatedRow; ?></p>
			<?php endforeach ;
		endif ; 
	?>

	<div class="col-xs-7">
		<div class="form-group">
			<label class="sr-only" for="movieSynopsisInput">Synopsis</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<textarea type="text" class="form-control" id="movieSynopsisInput" name="movie[synopsis]" placeholder="Synopsis"> <?= $movie['synopsis']; ?> </textarea>
			</div>
		</div>
	</div>
	<!-- Message de confirmation-->
	<?php 
		if (!empty( $updatedRows['synopsis'] )) : 
			foreach ( $updatedRows['synopsis'] as $updatedRow ) : ?>
				<p><?= $updatedRow; ?></p>
			<?php endforeach ;
		endif ; 
	?>

	<div class="col-xs-7">
		<div class="form-group">
			<label class="sr-only" for="movieDurationInput">Duration</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<input type="text" class="form-control" id="movieDurationInput" name="movie[duration]" placeholder="Duration" value="<?= $movie['duration']; ?>">
			</div>
		</div>
	</div>
	<!-- Message de confirmation-->
	<?php 
		if (!empty( $updatedRows['duration'] )) : 
			foreach ( $updatedRows['duration'] as $updatedRow ) : ?>
				<p><?= $updatedRow; ?></p>
			<?php endforeach ;
		endif ; 
	?>


	<div class="col-xs-7">
		<div class="form-group">
			<label class="sr-only" for="movieYearInput">Year</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<input type="text" class="form-control" id="movieYearInput" name="movie[year]" placeholder="Year" value="<?= $movie['year']; ?>">
			</div>
		</div>
	</div>
	<!-- Message de confirmation-->
	<?php 
		if (!empty( $updatedRows['year'] )) : 
			foreach ( $updatedRows['year'] as $updatedRow ) : ?>
				<p><?= $updatedRow; ?></p>
			<?php endforeach ;
		endif ; 
	?>

	<div class="col-xs-7">
		<div class="form-group">
			<label class="sr-only" for="movieImdbRefInput">imdbRef</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<input type="text" class="form-control" id="movieImdbRefInput" name="movie[imdbRef]" placeholder="imdbRef" value="<?= $movie['imdbRef']; ?>">
			</div>
		</div>
	</div>
	<!-- Message de confirmation-->
	<?php 
		if (!empty( $updatedRows['imdbRef'] )) : 
			foreach ( $updatedRows['imdbRef'] as $updatedRow ) : ?>
				<p><?= $updatedRow; ?></p>
			<?php endforeach ;
		endif ; 
	?>

	<div class="col-xs-7">
		<div class="form-group">
			<label class="sr-only" for="movieImdbRatingInput">imdbRating</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<input type="text" class="form-control" id="movieImdbRatingInput" name="movie[imdbRating]" placeholder="imdbRating" value="<?= $movie['imdbRating']; ?>">
			</div>
		</div>
	</div>

	<!-- Message de confirmation-->
	<?php 
		if (!empty( $updatedRows['imdbRating'] )) : 
			foreach ( $updatedRows['imdbRating'] as $updatedRow ) : ?>
				<p><?= $updatedRow; ?></p>
			<?php endforeach ;
		endif ; 
	?>

	<div class="col-xs-7">
		<button type="submit" class="btn btn-default btn-block" name="action[modify]" value="modify" >Modify</button>
	</div>
</form>

<?php $this->stop('main_content') ?>
