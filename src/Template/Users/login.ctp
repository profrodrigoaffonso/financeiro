<div id="fullscreen_bg" class="fullscreen_bg"/>

<div class="container">

	<?=$this->Form->create("form",["class"=>"form-signin"])?>
		<h1 class="form-signin-heading text-muted">Sign In</h1>
		<input type="text" name="login" class="form-control" placeholder="Login" required="" autofocus="">
		<input type="password" name="password" class="form-control" placeholder="Password" required="">
		<button class="btn btn-lg btn-primary btn-block" type="submit">
			Sign In
		</button>
	<?=$this->Form->end()?>

</div>