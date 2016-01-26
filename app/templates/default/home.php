<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
<form class="clearfix" id="search-movie-form" method="get" action="" data-ajax="<?=$this->url('search_ajax')?>">
	<div class="col-xs-12">
		<div class="form-group">
			<label for="search-input">Recherche de films</label>
			<div class="input-group">
				<input type="search" class="form-control" id="search-input" name="search-input" placeholder="Recherche de films">
			</div>
		</div>
	</div>
</form>
<div id="#result-search"></div>
<?php $this->stop('main_content') ?>