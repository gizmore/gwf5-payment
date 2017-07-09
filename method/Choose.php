<?php
/**
 * Step 1 – Choose a payment processor
 * @author gizmore
 */
final class Payment_Choose extends GWF_Method
{
	/**
	 * @var GWF_User
	 */
	private $user;
	
	/**
	 * @var GWF_Orderable
	 */
	private $orderable;
	
	/**
	 * @var GWF_PaymentModule
	 */
	private $paymentModule;
	
	/**
	 * @var GWF_Order
	 */
	private $order;
	
	/**
	 * @return GWF_Orderable|GDO
	 */
	public function getOrderable()
	{
		return GWF_User::current()->tempGet('gwf_orderable');
	}
	
	public function execute()
	{
		$this->user = GWF_User::current();
		if (!($this->orderable = $this->getOrderable()))
		{
			return $this->error('err_orderable');
		}
		$moduleName = Common::getRequestString('payment');
		if (!($this->paymentModule = GWF5::instance()->getModule($moduleName)))
		{
			return $this->error('err_module', [htmle($moduleName)]);
		}
		$this->order = GWF_Order::blank(array(
			'order_title_en' => $this->orderable->getOrderTitle('en'),
			'order_title' => $this->orderable->getOrderTitle(GWF_Trans::$ISO),
			'order_price' => $this->paymentModule->getPrice($this->orderable->getOrderPrice()),
			'order_item' => serialize($this->orderable),
			'order_module' => $this->paymentModule->getID(),
		));
		$this->user->tempSet('gwf_order', $this->order);
		$this->user->recache();
		
		$tVars = array(
			'user' => $this->user,
			'orderable' => $this->orderable,
			'payment' => $this->paymentModule,
			'order' => $this->order,
		);
		return $this->templatePHP('choose.php', $tVars);
	}
}
