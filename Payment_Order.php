<?php
abstract class Payment_Order extends GWF_MethodForm
{
	/**
	 * @return GWF_Orderable
	 */
	public abstract function getOrder();
	
	/**
	 * @var GWF_Orderable
	 */
	private $order;
	
	public function isUserRequired() { return true; }
	
	public function init()
	{
		$user = GWF_User::current();
		$this->order = $this->getOrder();
		$user->tempSet('gwf_order', $this->order);
	}
	
	public function createForm(GWF_Form $form)
	{
		$order = $this->getOrder();
		foreach (GWF_PaymentModule::allPaymentModules() as $module)
		{
			if ($order->canPayWith($module))
			{
				$form->addField($module->makePaymentButton(href('Payment', 'Choose')));
			}
			$form->addField($button);
		}
	}
}
