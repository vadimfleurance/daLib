<?php $this->layout('layout', ['title' => 'Détail du Movie']) ?>

<?php $this->start('main_content') ?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">	
				<h2>Movie : <?= $movie['title']; ?></h2>
				
				<form method="POST">
					<div class="form-group">
						<label class="sr-only" for="movieTitleInput">Title</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-font"></i></div>
							<input type="text" class="form-control" id="movieTitleInput" name="movie[title]" placeholder="Title" value="<?= $movie['title']; ?>">
						</div>
					</div>
					<!-- Message de confirmation-->
					<?php if (!empty( $updatedRows['title'] )) : ?>
						<ul class="text-success">
						<?php foreach ( $updatedRows['title'] as $updatedRow ) : ?>
							<li><?= $updatedRow; ?></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<div class="form-group">
						<label class="sr-only" for="movieSynopsisInput">Synopsis</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-align-justify"></i></div>
							<textarea rows="4" class="form-control" id="movieSynopsisInput" name="movie[synopsis]" placeholder="Synopsis"> <?= $movie['synopsis']; ?> </textarea>
						</div>
					</div>
					<!-- Message de confirmation-->
					<?php if (!empty( $updatedRows['synopsis'] )) : ?>
						<ul class="text-success">
						<?php foreach ( $updatedRows['synopsis'] as $updatedRow ) : ?>
							<li><?= $updatedRow; ?></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<div class="form-group">
						<label class="sr-only" for="movieDurationInput">Duration</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
							<input type="text" class="form-control" id="movieDurationInput" name="movie[duration]" placeholder="Duration" value="<?= $movie['duration']; ?>">
						</div>
					</div>
					<!-- Message de confirmation-->
					<?php if (!empty( $updatedRows['duration'] )) : ?>
						<ul class="text-success">
						<?php foreach ( $updatedRows['duration'] as $updatedRow ) : ?>
							<li><?= $updatedRow; ?></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<div class="form-group">
						<label class="sr-only" for="movieYearInput">Year</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
							<input type="text" class="form-control" id="movieYearInput" name="movie[year]" placeholder="Year" value="<?= $movie['year']; ?>">
						</div>
					</div>
					<!-- Message de confirmation-->
					<?php if (!empty( $updatedRows['year'] )) : ?>
						<ul class="text-success">
						<?php foreach ( $updatedRows['year'] as $updatedRow ) : ?>
							<li><?= $updatedRow; ?></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<div class="form-group">
						<label class="sr-only" for="movieImdbRefInput">imdbRef</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-ticket"></i></div>
							<input type="text" class="form-control" id="movieImdbRefInput" name="movie[imdbRef]" placeholder="imdbRef" value="<?= $movie['imdbRef']; ?>">
						</div>
					</div>
					<!-- Message de confirmation-->
					<?php if (!empty( $updatedRows['imdbRef'] )) : ?>
						<ul class="text-success">
						<?php foreach ( $updatedRows['imdbRef'] as $updatedRow ) : ?>
							<li><?= $updatedRow; ?></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<div class="form-group">
						<label class="sr-only" for="movieImdbRatingInput">imdbRating</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-star-half-full"></i></div>
							<input type="text" class="form-control" id="movieImdbRatingInput" name="movie[imdbRating]" placeholder="imdbRating" value="<?= $movie['imdbRating']; ?>">
						</div>
					</div>
					<!-- Message de confirmation-->
					<?php if (!empty( $updatedRows['imdbRating'] )) : ?>
						<ul class="text-success">
						<?php foreach ( $updatedRows['imdbRating'] as $updatedRow ) : ?>
							<li><?= $updatedRow; ?></li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<button type="submit" class="btn btn-default btn-block" name="action[modify]" value="modify" >Modify</button>
				</form>
				<br>
				<a href="<?= $this->url('back_office_movies')?>" class="btn btn-default" title="Back to the list of movies">Back to the list of movies</a>
			</div>
		</div>
	</div>
</section>
<?php $this->stop('main_content') ?>
