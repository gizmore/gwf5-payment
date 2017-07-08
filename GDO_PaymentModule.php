<?php
class GDO_PaymentModule extends GDO_ObjectSelect
{
	public $klass = "GWF_Module";
	
	public function initChoices()
	{
		return $this->choices ? $this : $this->choices(GWF_PaymentModule::allModules());
	}
	
}
