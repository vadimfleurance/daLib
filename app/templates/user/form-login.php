<form class="clearfix">
	<div class="col-xs-12">
		<div class="form-group">
			<label class="sr-only" for="userLoginInput">Username Login</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<input type="text" class="form-control" id="userLoginInput" name="user[username]" placeholder="Username / Email">
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="form-group">
			<label class="sr-only" for="passwordLoginInput">Password Login</label>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-lock"></i></div>
				<input type="password" class="form-control" id="passwordLoginInput" name="user[password]" placeholder="Password">
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-12 col-sm-7">
				<div class="checkbox">
					<input type="checkbox" id="rememberInput" name="user[remember]">
					<label for="rememberInput">
						Remember me
					</label>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<a href="#" class="btn btn-link btn-forgot">Password ?</a>
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<button type="submit" name="action[login]" class="btn btn-default btn-block btn-login">Login</button>
	</div>
</form>