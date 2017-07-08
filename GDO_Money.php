<?php
class GDO_Money extends GDO_Decimal
{
	public static $CURRENCY = 'EUR';
	
	public $digitsBefore = 7;
	public $digitsAfter = 2;
	
	public function defaultLabel() { return $this->label('price'); }
	
	public function renderCell()
	{
		if (null === ($value = $this->getValue()))
		{
			return '---';
		}
		return sprintf('€%.02f', $value);
	}
	
	
}
