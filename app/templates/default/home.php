<?php $this->layout('layout', ['title' => 'daLib | Your collection of movies in your pocket', 'nav_title' => 'daLib']) ?>

<?php $this->start('main_content') ?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0">
					<header>
						<h3>daLib, what's it ?</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</header>
				</div>
				<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
						<li role="presentation"><a href="#register" aria-controls="register" role="tab" data-toggle="tab">Register</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="login">
							<div class="row">
								<form class="form-inline">
									<div class="col-xs-12">
										<div class="form-group">
											<label class="sr-only" for="userLoginInput">Username Login</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-user"></i></div>
												<input type="text" class="form-control" id="userLoginInput" placeholder="Username / Email">
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group">
											<label class="sr-only" for="passwordLoginInput">Password Login</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-lock"></i></div>
												<input type="password" class="form-control" id="passwordLoginInput" placeholder="Password">
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="checkbox">
											<label>
												<input type="checkbox"> Remember me
											</label>
										</div>
									</div>
									<div class="col-xs-12">
										<button type="submit" class="btn btn-primary">Login</button>
									</div>
								</form>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="register">
							<div class="row">
								<form class="form-inline">
									<div class="col-xs-12">
										<div class="form-group">
											<label class="sr-only" for="userRegisterInput">Username Register</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-user"></i></div>
												<input type="text" class="form-control" id="userRegisterInput" placeholder="Username">
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group">
											<label class="sr-only" for="emailRegisterInput">Email Register</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-user"></i></div>
												<input type="email" class="form-control" id="emailRegisterInput" placeholder="Email">
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group">
											<label class="sr-only" for="passwordRegisterInput">Password Register</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-lock"></i></div>
												<input type="password" class="form-control" id="passwordRegisterInput" placeholder="Password">
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group">
											<label class="sr-only" for="passwordConfirmRegisterInput">Password Confirm Register</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-lock"></i></div>
												<input type="password" class="form-control" id="passwordConfirmRegisterInput" placeholder="Password Confirm">
											</div>
										</div>
									</div>
									<div class="col-xs-12">
										<button type="submit" class="btn btn-primary">Login</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1">
					<header>
						<h1>Top 10</h1>
					</header>

					<p></p>	

				</div>
			</div>
		</div>
	</section>
<?php $this->stop('main_content') ?>
