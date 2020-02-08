<?php
	namespace component\Directives\Account;
	class AccountScreen extends \Hyphe\Engine {
	
	
	public function render()
	{
	
		$assets = $this->loadAssets();
	?>
	
			<div class="container-fluid">
				<div class="row">
					<?php $image = \Moorexa\Rexa::runDirective(true,'getImage',$this->props->image);?>
			
					<div class="col-md-6 col-xs-12 has-bg-image" style="background-image: url(<?=$image?>);">
						<div class="has-bg-content">
							<h1><?=$this->props->title?></h1>
							<p><?=$this->props->caption?></p>
						</div>
			
						<div class="has-bg-footer">
							<?=$this->props->nav?>
						</div>
					</div>
					
			
					<div class="col-md-6 col-xs-12 has-bg-form-area">
				
						<div class="has-bg-content">
							<div class="form-container">
								<?=\Moorexa\Rexa::runDirective(true,'alert')?>
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
	  return "4647e95ecd575db6662b0b45b880bab4";
	}
	}