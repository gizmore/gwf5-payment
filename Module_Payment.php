<?php
include 'GDO_Money.php';
include 'GWF_PaymentModule.php';
final class Module_Payment extends GWF_Module
{
	public $module_priority = 15;
	public function href_administrate_module() { return href('Payment', 'Orders'); }
	public function getClasses() { return ['GDO_PaymentModule', 'GWF_Order', 'GWF_MethodPayment', 'GWF_Orderable', 'Payment_Order']; }
	public function onLoadLanguage() { $this->loadLanguage('lang/payment'); }
// 	public function getConfig()
// 	{
// 		return array(
// 		);
// 	}
}
