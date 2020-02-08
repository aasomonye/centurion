<?php
	namespace component\Directives\Account;
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
				<input  type="<?=(isset($this->props->type) ? $this->props->type : 'text')?>" name="<?=$this->props->name?>" placeholder="<?=$this->props->children?>" value="<?=$this->getVal($this->props->name)?>">
				<span class="has-error"><?=$this->getError($this->props->name)?></span>
			<?php } ?>

		
	<?php
	
	}


	public function getNationality()
	{
	
		return db($this->props->get)->get();
	
	}

	public function getVal($name)
	{
	
		$data = \Centurion\Models\Input::get();

		if ($data !== null)
		{
			return $data->{$name};
		}
	
	}

	public function getError($name)
	{
	
		$data = \Centurion\Models\Input::get();

		if ($data !== null)
		{
			return $data->onError($name);
		}
	
	}

	public static function ___cacheData()
	{
	  return "ec0d431e5d7ce2fb62cca1545366b669";
	}
	}