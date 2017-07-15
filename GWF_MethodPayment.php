<?php
abstract class GWF_MethodPayment extends GWF_Method
{
	public function isAlwaysTransactional() { return true; }

	/**
	 * @return GWF_Order
	 */
	public function getOrderPersisted()
	{
		if ($this->order = GWF_User::current()->tempGet('gwf_order'))
		{
			if ($this->order instanceof GWF_Order)
			{
				if (!$this->order->isPersisted())
				{
					$this->order->insert();
				}
			}
		}
		return $this->order;
	}
	
// 	public function getOrder()
// 	{
// 	}
	
	public function renderOrder(GWF_Order $order)
	{
		return $order->renderCard();
	}
	
}
