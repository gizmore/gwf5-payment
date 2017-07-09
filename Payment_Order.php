<?php
abstract class Payment_Order extends GWF_MethodForm
{
	/**
	 * @return GWF_Orderable
	 */
	public abstract function getOrderable();
	
	public function isUserRequired() { return true; }
	
	public function formValidated(GWF_Form $form)
	{
		return $this->initOrderable($form);
	}
	
	public function initOrderable(GWF_Form $form=null)
	{
		$user = GWF_User::current();
		$orderable = $this->getOrderable();
		if (!($orderable instanceof GDO))
		{
			throw new GWF_Exception('err_gdo_type', [$this->order->gdoClassName(), 'GDO']);
		}
		if (!($orderable instanceof GWF_Orderable))
		{
			throw new GWF_Exception('err_gdo_type', [$this->order->gdoClassName(), 'GWF_Orderable']);
		}
		$user->tempSet('gwf_orderable', $orderable);
		$user->recache();
		
		return $this->renderOrderableForm($orderable);
	}
	
	public function renderOrderableForm(GWF_Orderable $orderable)
	{
		$form = new GWF_Form();
		$form->addField(GDO_HTML::make('card')->content($orderable->renderCard()->getHTML())); 
		foreach (GWF_PaymentModule::allPaymentModules() as $module)
		{
			if ($orderable->canPayOrderWith($module))
			{
				$form->addField($module->makePaymentButton(href('Payment', 'Choose', '&payment='.$module->getName())));
			}
		}
		return $form->render();
	}
	
}
