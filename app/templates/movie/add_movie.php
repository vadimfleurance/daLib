<?php $this->layout('layout', ['title' => 'Add movie']) ?>

<?php $this->start('main_content') ?>
<form class="clearfix" id="add-movie-form" method="post" novalidate>
	<div class="col-xs-12">
		<div class="form-group">
			<label for="search-input">Add movie</label>
			<div class="input-group">
				<input type="text" class="form-control" id="add-movie-input" name="add-movie-input" placeholder="Add movie">
			</div>
		</div>
		<input type="submit" value="Add movie">
	</div>
</form>
<?=empty($stateScrap) ? "" : $stateScrap?>
<?php $this->stop('main_content') ?>