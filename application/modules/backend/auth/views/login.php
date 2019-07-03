<p class="login-box-msg">Sign in to start your session</p>
<form action="<?php echo backend_url().'auth/login'; ?>" method="post">
  <div class="form-group has-feedback">
	<input id="identity" type="email" value="" name="identity" class="form-control" placeholder="Email">
	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
	  <input id="password" type="password" value="" name="password" class="form-control" placeholder="Password">
	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<?php if($message!=""){?>
<div class="callout callout-danger"><ul class="ul-callout"><?php echo $message;?></ul></div>
<?php }?>
  <div class="row">
	<div class="col-xs-8">
	  <div class="checkbox icheck">
		<label>
		  <input id="remember" value="1" name="remember" type="checkbox"> Remember Me
		</label>
	  </div>
	</div><!-- /.col -->
	<div class="col-xs-4">
	  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
	</div><!-- /.col -->
  </div>
</form>

<a href="<?php echo backend_url().'auth/forgot_password'; ?>">I forgot my password</a>
		 