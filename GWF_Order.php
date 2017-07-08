<?php
final class GWF_Order extends GDO
{
	public function gdoColumns()
	{
		return array(
			GDO_AutoInc::make('order_id'),
			GDO_Money::make('order_price'),
			GDO_Serialize::make('order_item'),
			GDO_PaymentModule::make('order_module'),
			GDO_DateTime::make('order_paid'),
			GDO_CreatedAt::make('order_at'),
			GDO_CreatedBy::make('order_by'),
		);
	}
}
