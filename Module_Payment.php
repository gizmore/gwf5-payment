<?php
include 'GWF_PaymentModule.php';
final class Module_Payment extends GWF_Module
{
	public $module_priority = 15;
	
	public function getClasses() { return ['GDO_Money', 'GDO_PaymentModule', 'GWF_Order', 'GWF_Orderable', 'Payment_Order']; }
	
	public function getConfig()
	{
		return array(
			
		);
	}
}
