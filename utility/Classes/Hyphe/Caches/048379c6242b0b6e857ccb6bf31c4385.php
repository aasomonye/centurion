<?php
	namespace component\Directives\Account;
	class FormField extends \Hyphe\Engine {
	
	
	public function render()
	{
	
		$assets = $this->loadAssets();
	?>
	

			<?php if(isset($this->props->type) && $this->props->type == 'select') { ?>

				<div class="input-group mb-3">
					<select name="<?=$this->props->name?>" class="form-control">
						<option value=""><?=$this->props->children?></option>
						<?php $table = $this->getNationality();?>

						<?php while ($row = $table->obj()) { ?>
							<option value="<?=$row->nationalityid?>"><?=$row->country_name?></option>
						<?php } ?>
					</select>
				</div>

			<?php } else { ?>

				<div class="input-group mb-3">
					<input  type="<?=(isset($this->props->type) ? $this->props->type : 'text')?>" name="<?=$this->props->name?>" class="form-control" placeholder="<?=$this->props->children?>"  value="<?=((isset($this->props->value) && strlen($this->props->value) > 0 ? $this->props->value : $this->getVal($this->props->name)))?>" required="">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas <?=$this->props->icon?>"></span>
						</div>
					</div>
				</div>
				<span class="has-error" style="position:relative; top:-10px;"><?=$this->getError($this->props->name)?></span>
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
	  return "dd0580e2e8242b6ad4b7ea5e2069a33c";
	}
	}