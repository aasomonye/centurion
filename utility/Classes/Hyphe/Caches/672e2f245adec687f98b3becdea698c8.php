<?php
	namespace component\Directives\Admin;
	class AuthWrapper extends \Hyphe\Engine {
	
	public function render()
	{
	
		$assets = $this->loadAssets();
	?>
	
			<div class="login-box">
				<div class="login-logo">
				  <a href="<?=url("")?>">
					<b>Centurion</b>App</a>
				</div>
				<!-- /.login-logo -->
				<div class="card">
				  <div class="card-body login-card-body">
					<p class="login-box-msg"><?=$this->props->caption?></p>
			  
					<form action="" method="post">
					  <?=\Moorexa\Rexa::runDirective(true,'csrf')?>
					  <?=$this->props->children?>

					  <authbutton>
						<!-- /.col -->
						<div  class="<?=(isset($this->props->buttonsize) ? $this->props->buttonsize : 'col-4')?>">
							<button type="submit" class="btn btn-primary btn-block"><?=$this->props->button?></button>
						</div>
						<!-- /.col -->
					  </authbutton>
					</form>
			  
					<socialauthlinks>
						<div class="social-auth-links text-center mb-3">
							<p>- OR -</p>
							<a href="#" class="btn btn-block btn-primary">
								<i class="fab fa-facebook mr-2"></i> Sign in using Facebook
							</a>
							<a href="#" class="btn btn-block btn-danger">
								<i class="fab fa-google-plus mr-2"></i> Sign in using Google+
							</a>
						</div>
					</socialauthlinks>

					<socialsignup>
						<div class="social-auth-links text-center">
							<p>- OR -</p>
							<a href="#" class="btn btn-block btn-primary">
							  <i class="fab fa-facebook mr-2"></i>
							  Sign up using Facebook
							</a>
							<a href="#" class="btn btn-block btn-danger">
							  <i class="fab fa-google-plus mr-2"></i>
							  Sign up using Google+
							</a>
						</div>
					</socialsignup>

					<!-- /.social-auth-links -->
					<?=$this->props->inject['nav-link']?>

					
				  </div>
				  <!-- /.login-card-body -->
				</div>
			  </div>
			  <!-- /.login-box -->
			  
		
	<?php
	
	}

	public static function ___cacheData()
	{
	  return "78607f9b41b72818dca1cdf80541238d";
	}
	}