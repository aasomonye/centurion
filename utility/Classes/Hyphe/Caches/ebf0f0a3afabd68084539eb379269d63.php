<?php
	namespace components\Directives\Account;
	class Input extends \Hyphe\Engine {
	
	
	public function render()
	{
	
		$assets = $this->loadAssets();
	?>
	

			<?php if(isset($this->props->type) && $this->props->type == 'select') { ?>

				<select name="<?=$this->props->name?>">
					<option value=""><?=$this->props->children?></option>
					<?php $table = $this->getNationality();?>

					<?php while ($row = $table->obj()) { ?>
						<option value="<?=$row->nationalityid?>"><?=$row->country_name?></option>
					<?php } ?>

				</select>

			<?php } else { ?>
				<input  type="<?=(isset($this->props->type) ? $this->props->type : 'text')?>" name="<?=$this->props->name?>" placeholder="<?=$this->props->children?>">
			<?php } ?>

		
	<?php
	
	}

	public function getNationality()
	{
	
		return db($this->props->get)->get();
	
	}

	public static function ___cacheData()
	{
	  return "fdcf1dc8b773ef6b1a472183931b8f6a";
	}
	}