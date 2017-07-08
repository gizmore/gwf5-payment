<?php
interface GWF_Orderable
{
	public function getPrice();
	public function canPayWith(GWF_PaymentModule $module);
}
