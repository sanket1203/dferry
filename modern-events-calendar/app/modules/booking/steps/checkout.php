<?php
/** no direct access **/
defined('_MECEXEC_') or die();

$event_id = $event->ID;
$gateways = $this->main->get_gateways();

$active_gateways = array();
foreach($gateways as $gateway)
{
    if(!$gateway->enabled()) continue;
    $active_gateways[] = $gateway;
}
?>
<style>
	#order_review table tfoot tr:nth-child(1) {
    display: none;
}
</style>
<div id="mec_book_payment_form">
    <h4><?php _e('Checkout', 'mec'); ?></h4>
    <div class="mec-book-form-price">
        <?php if(isset($price_details['details']) and is_array($price_details['details']) and count($price_details['details'])): ?>
        <ul class="mec-book-price-details">
            <?php foreach($price_details['details'] as $detail): ?>
            <li class="mec-book-price-detail mec-book-price-detail-type<?php echo $detail['type']; ?>">
                <span class="mec-book-price-detail-description"><?php echo $detail['description']; ?></span>
                <span class="mec-book-price-detail-amount"><?php echo $this->main->render_price($detail['amount']); ?></span>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <!--span class="mec-book-price-total"><?php echo $this->main->render_price($price_details['total']); ?></span  by rabi-->
    </div>
    <?php if(isset($this->settings['coupons_status']) and $this->settings['coupons_status']): ?>
    <div class="mec-book-form-coupon">
        <form id="mec_book_form_coupon" onsubmit="mec_book_apply_coupon(); return false;">
            <input type="text" name="coupon" placeholder="<?php esc_attr_e('Discount Coupon', 'mec'); ?>">
            <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>" />
            <input type="hidden" name="action" value="mec_apply_coupon" />
            <?php wp_nonce_field('mec_apply_coupon_'.$transaction_id); ?>
            <button type="submit"><?php _e('Apply Coupon', 'mec'); ?></button>
        </form>
        <div class="mec-coupon-message mec-util-hidden"></div>
    </div>
    <?php endif; ?>
    <div class="mec-book-form-gateways">
        <?php foreach($active_gateways as $gateway): ?>
        <div class="mec-book-form-gateway-label">
            <label>
                <?php if(count($active_gateways) > 1): ?>
                <input type="radio" name="book[gateway]" onchange="mec_gateway_selected(this.value);" value="<?php echo $gateway->id(); ?>" /> 
                <?php endif; ?>
                <?php echo $gateway->title(); ?>
            </label>
        </div>
        <?php endforeach; ?>
        
        <?php foreach($active_gateways as $gateway): ?>
        <div class="mec-book-form-gateway-checkout <?php echo (count($active_gateways) == 1 ? '' : 'mec-util-hidden'); ?>" id="mec_book_form_gateway_checkout<?php echo $gateway->id(); ?>">
            <?php echo $gateway->comment(); ?>
            <?php $gateway->checkout_form($transaction_id, $detail); ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>
