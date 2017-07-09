<?php
$gdo instanceof GWF_Order;
$payment = $gdo->getPaymentModule();
?>
<md-card class="gwf-downloadtoken">
  <md-card-title>
    <md-card-title-text>
      <span class="md-headline">
        <div><?php l('card_title_order'); ?></div>
        <div class="gwf-card-subtitle"><?php html($gdo->getTitle()); ?></div>
      </span>
    </md-card-title-text>
  </md-card-title>
  <gwf-div></gwf-div>
  <md-card-content flex>
    <div><?php l('price'); ?>: <?php echo GDO_Money::make()->value($gdo->getOrderable()->getOrderPrice())->renderCell(); ?></div>
    <div><?php l('payment'); ?>: <?php html($payment->gdoHumanName()); ?></div>
    <div><?php l('payment_fee'); ?>: <?php html($payment->displayPaymentFee()); ?></div>
    <div><?php l('total'); ?>: <?php echo $gdo->displayPrice(); ?></div>
    <?php echo $payment->renderOrderFragment($gdo); ?>
  </md-card-content>
</md-card>
