<?php
	namespace components\Directives\Account;
	class AccountScreen extends \Hyphe\Engine {
	
	
	public function render()
	{
	

		$assets = $this->loadAssets();
	?>
	
			<div class="container-fluid">
				<div class="row">
					<?php $image = \Moorexa\Rexa::runDirective(true,'getImage','slide7-bg');?>
			
					<div class="col-md-6 col-xs-12 has-bg-image" style="background-image: url(<?=$image?>);">
						<div class="has-bg-content">
							<h1><?=$this->props->title?></h1>
							<p><?=$this->props->caption?></p>
						</div>
			
						<div class="has-bg-footer">
							<a href="<?=url("register")?>"><img src="<?=$assets->image("arrow-left.png")?>"> Become a member</a>
						</div>
					</div>
					
			
					<div class="col-md-6 col-xs-12 has-bg-form-area">
						<div class="has-bg-content">
							<div class="form-container">
								<form action="" method="POST">
									<?=\Moorexa\Rexa::runDirective(true,'csrf')?>
									<?=$this->props->children?>
									<button type="submit"><span><?=$this->props->button?></span> <img src="<?=$assets->image("icons/arrow-right.png")?>"></button>
								</form>
							</div>
						</div>
			
						<div class="has-bg-footer">
							<p>© copyright <?=date('Y')?> Centurion Apartments. All rights reserved.</p>
						</div>
					</div>
				</div>
			</div>
		
	<?php

	
	}

	public static function ___cacheData()
	{
	  return "f1a5c9866de06f9144904276f52a75b5";
	}
	}