<?php
final class GWF_Order extends GDO
{
	public function gdoColumns()
	{
		return array(
			GDO_AutoInc::make('order_id'),
			GDO_String::make('order_xtoken')->ascii()->caseS()->max(64),
			GDO_String::make('order_title_en'),
			GDO_String::make('order_title'),
			GDO_Money::make('order_price'),
			GDO_Serialize::make('order_item'),
			GDO_PaymentModule::make('order_module')->editable(false),
			GDO_CreatedBy::make('order_by'),
			GDO_CreatedAt::make('order_at'),
			GDO_DateTime::make('order_paid')->editable(false)->label('paid_at'),
			GDO_DateTime::make('order_executed')->editable(false)->label('executed_at'),
		);
	}
	
	public function href_edit() { return href('Payment', 'Order', '&id='.$this->getID()); }
	public function href_view() { return href('Payment', 'ViewOrder', '&id='.$this->getID()); }
	
	public function getXToken() { return $this->getVar('order_xtoken'); }
	
	/**
	 * @return GWF_User
	 */
	public function getUser()
	{
		return $this->getValue('order_by');
	}
	
	/**
	 * @return GWF_Orderable
	 */
	public function getOrderable()
	{
		return $this->getValue('order_item');
	}
	
	/**
	 * @return GWF_PaymentModule
	 */
	public function getPaymentModule()
	{
		return GWF5::instance()->getModuleByID($this->getVar('order_module'));
	}
	
	public function getPrice() { return $this->getVar('order_price'); }
	public function displayPrice() { return $this->gdoColumn('order_price')->renderCell(); }
	public function getTitle() { return $this->getVar('order_title'); }
	public function getTitleEN() { return $this->getVar('order_title_en'); }
	
	##############
	### Render ###
	##############
	public function renderCard()
	{
		return GWF_Template::modulePHP('Payment', 'card/order.php', ['gdo' => $this]);
	}
}
