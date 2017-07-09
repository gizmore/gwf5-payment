<?php
/**
 * Table of orders for staff.
 * @author gizmore
 * @version 5.0
 */
final class Payment_Orders extends GWF_MethodQueryTable
{
	public function getPermission() { return 'staff'; }
	public function getQuery()
	{
		return GWF_Order::table()->select();
	}
	
	public function getHeaders()
	{
		$gdo = GWF_Order::table();
		return array(
			GDO_EditButton::make(),
			$gdo->gdoColumn('order_id'),
			$gdo->gdoColumn('order_at'),
			$gdo->gdoColumn('order_by'),
			$gdo->gdoColumn('order_title'),
			$gdo->gdoColumn('order_price'),
			$gdo->gdoColumn('order_paid'),
			$gdo->gdoColumn('order_executed'),
			GDO_Button::make('view'),
		);
	}
}
