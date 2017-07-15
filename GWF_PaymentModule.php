<?php
abstract class GWF_PaymentModule extends GWF_Module
{
	/**
	 * @var GWF_PaymentModule[]
	 */
	private static $paymentModules = [];
	/**
	 * @return GWF_PaymentModule[]
	 */
	public static function allPaymentModules() { return self::$paymentModules; }
	

	public $module_priority = 25;

	public function initModule()
	{
		self::$paymentModules[$this->getName()] = $this;
		return parent::initModule();
	}
	
	public function getConfig()
	{
		return array(
			GDO_Decimal::make('fee_buy')->digits(1, 4)->initial('0.0000'),
		);
	}
	
	public function cfgFeeBuy() { return $this->getConfigValue('fee_buy'); }
	
	public function getPrice($price)
	{
		return round(($this->cfgFeeBuy() + 1.00) * floatval($price), 2);
	}
	
	public function displayPaymentFee()
	{
		return sprintf('%.03f%%', $this->cfgFeeBuy());
	}
	
	/**
	 * @param string $href
	 * @return GDO_Button
	 */
	public function makePaymentButton(string $href)
	{
		return GDO_Button::make('buy_'.$this->getName())->href($href)->icon('attach_money');
// 		return $this->templatePHP('button.php', ['href' => $href]);
	}
	
	public function renderOrderFragment(GWF_Order $order)
	{
		return '';
	}
}
