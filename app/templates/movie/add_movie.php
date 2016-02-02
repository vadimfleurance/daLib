<?php $this->layout('layout', ['title' => 'Add movie']) ?>

<?php $this->start('main_content') ?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<?php if(!empty($errorScrap)): ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<p><strong>Error !</strong> <?= $errorScrap; ?></p>
					</div>
				<?php endif; ?>
				<?php if(!empty($successScrap)): ?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<p><strong>Success !</strong> <?= $successScrap; ?></p>
					</div>
				<?php endif; ?>
				
				<form class="clearfix" id="add-movie-form" method="post" novalidate>
					<div class="form-group">
						<label for="search-input">Add movie</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-film"></i></div>
							<input type="text" class="form-control" id="add-movie-input" name="add-movie-input" placeholder="URL or Ref IMDb">
						</div>
					</div>
					<button type="submit" class="btn btn-default btn-block btn-login" name="action[login]">Add movie</button>
				</form>
			</div>
		</div>
	</div>
</section>
<?php $this->stop('main_content') ?>