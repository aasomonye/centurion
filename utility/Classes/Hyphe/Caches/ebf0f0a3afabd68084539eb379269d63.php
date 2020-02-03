<?php
	namespace components\Directives\Account;
	class Input extends \Hyphe\Engine {
	
	
	public function render()
	{
	

		$assets = $this->loadAssets();
	?>
	
			<input  type="<?=(isset($this->props->type) ? $this->props->type : 'text')?>" name="$this->props->name" placeholder="<?=$this->props->children?>">
		
	<?php

	
	}

	public static function ___cacheData()
	{
	  return "43345b97f37f8cc0a84a0afc7522f40b";
	}
	}