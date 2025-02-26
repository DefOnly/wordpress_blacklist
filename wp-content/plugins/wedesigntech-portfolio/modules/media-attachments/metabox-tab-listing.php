<div class="wdt-custom-box">

    <label><?php echo esc_html__('Add Attachments','wdt-portfolio'); ?></label>
    <?php echo wdt_listing_attachments_field($list_id); ?>

    <div class="wdt-note">
        <?php echo sprintf( esc_html__('Add attachments for your %1$s here.','wdt-portfolio'), strtolower($listing_singular_label) ); ?>
    </div>

</div>