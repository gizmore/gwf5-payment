<?php
/**
 * Table of orders for staff.
 * @author gizmore
 * @version 5.0
 */
final class Payment_History extends GWF_MethodQueryList
{
	public function isUserRequired() { return true; }
	
	public function gdoTable() { return GWF_Order::table(); }
	
	public function getQuery()
	{
		return GWF_Order::table()->select()->where('order_by='.GWF_User::current()->getID());
	}
}
