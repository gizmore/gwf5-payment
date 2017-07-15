<?php
interface GWF_Orderable
{
	public function getOrderCancelURL(GWF_User $user);
	public function getOrderSuccessURL(GWF_User $user);

	public function getOrderTitle(string $iso);
	public function getOrderPrice();

	public function canPayOrderWith(GWF_PaymentModule $module);
	
	/**
	 * @return GWF_Response
	 */
	public function onOrderPaid();
}
