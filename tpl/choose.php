<?php
$user instanceof GWF_User;
$orderable instanceof GWF_Orderable;
$payment instanceof GWF_PaymentModule;
$order instanceof GWF_Order;

echo $orderable->renderCard()->getHTML();

echo $order->renderCard()->getHTML();

$bar = GDO_Bar::make();
$bar->addField($payment->makePaymentButton(href($payment->getName(), 'InitPayment')));
echo $bar->renderCell();
