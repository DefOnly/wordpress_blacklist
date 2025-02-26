<?php

global $post; $post_id = $post->ID;
echo '<input type="hidden" name="wdt_woocommerce_meta_nonce" value="'.wp_create_nonce('wdt_woocommerce_nonce').'" />';

$_regular_price = get_post_meta( $post_id, '_regular_price', true );
$_sale_price = get_post_meta( $post_id, '_sale_price', true );

?>

<div class="custom-box">
	<div class="column one-sixth">
		<label><?php echo esc_html__('Regular price','wdt-portfolio'). ' (' . get_woocommerce_currency_symbol() . ')'; ?></label>
	</div>
	<div class="column five-sixth last">
		<input type="text" class="short wc_input_price"  name="_regular_price" id="_regular_price" value="<?php if ( isset( $_regular_price ) ) { echo esc_attr( $_regular_price ); } ?>" placeholder="">
        <div class="clear"></div>
	</div>
</div>

<div class="custom-box">
	<div class="column one-sixth">
		<label><?php echo esc_html__('Sale price','wdt-portfolio'). ' (' . get_woocommerce_currency_symbol() . ')'; ?></label>
	</div>
	<div class="column five-sixth last">
		<input type="text" class="short wc_input_price"  name="_sale_price" id="_sale_price" value="<?php if ( isset( $_sale_price ) ) { echo esc_attr( $_sale_price ); } ?>" placeholder="">
        <div class="clear"></div>
	</div>
</div>