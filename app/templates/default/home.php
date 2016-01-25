<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
<form class="clearfix" id="search-movie-form" method="get" action="<?=$this->url('search_movie')?>">
	<div class="col-xs-12">
		<div class="form-group">
			<label class="sr-only" for="userLoginInput">Username Login</label>
			<div class="input-group">
				<input type="search" class="form-control" id="search-input" name="search-input" placeholder="Recherche de films">
			</div>
		</div>
	</div>
</form>
<?php $this->stop('main_content') ?>