<?php
abstract class GWF_PaymentModule extends GWF_Module
{
	/**
	 * @return GWF_PaymentModule[string]
	 */
	public static function allPaymentModules() { return self::$paymentModules; }
	private static $paymentModules = [];
	
	public $module_priority = 25;

	public function initModule()
	{
		self::$paymentModules[$this->getName()] = $this;
	}
	
	public function getConfig()
	{
		return array(
			GDO_Decimal::make('fee_buy')->digits(1, 4)->initial('0.0000'),
		);
	}
	
	public function makePaymentButton(string $href)
	{
		return $this->templatePHP('button.php', ['href' => $href]);
	}
}
