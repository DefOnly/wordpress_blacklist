<?php
$listing_id = get_the_ID();
?>

<div class="wdt-portfolio-single type2">
    <div class="wdt-single-header-area">
        <div class="wdt-column column no-space wdt-three-fifth wdt-content-area">
            <?php echo do_shortcode('[wdt_sp_utils show_title="true" listing_id="'.$listing_id.'"]'); ?>
            <span class="wdt-empty-space-20"> </span>
            <p><?php echo get_the_excerpt($listing_id); ?></p>
            <span class="wdt-empty-space-20"> </span>
        </div>
        <span class="wdt-empty-space-30"> </span>
        <div class="wdt-column column no-space wdt-three-fifth wdt-info-area">
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_taxonomy taxonomy="wdt_listings_category" show_categories="true" show_label="true" listing_id="'.$listing_id.'" type="type2"]'); ?>
            </div>
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_post_date type="type2" with_label="true" listing_id="'.$listing_id.'"]'); ?>
            </div>
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_taxonomy taxonomy="wdt_listings_amenity" show_categories="true" show_label="true" listing_id="'.$listing_id.'" type="type2"]'); ?>
            </div>
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_social_links type="type3" listing_id="'.$listing_id.'"]'); ?>
            </div>
        </div>
    </div>
    <span class="wdt-empty-space-50"> </span>
    <div class="wdt-single-image-area wdt-image-list-area">
        <div class="wdt-column column no-space wdt-three-fifth">
            <?php echo do_shortcode('[wdt_sp_media_images_list columns="1" include_featured_image="false" with_space="false" image_ids="0" listing_id="'.$listing_id.'"]'); ?>
            <span class="wdt-empty-space-15"> </span>
            <?php echo do_shortcode('[wdt_sp_media_images_list columns="2" include_featured_image="false" with_space="false" image_ids="1,2" listing_id="'.$listing_id.'"]'); ?>
            <span class="wdt-empty-space-15"> </span>
            <?php echo do_shortcode('[wdt_sp_media_images_list columns="1" include_featured_image="false" with_space="false" image_ids="3" listing_id="'.$listing_id.'"]'); ?>
        </div>
        <span class="wdt-empty-space-50"> </span>
        <div class="wdt-column column no-space wdt-three-fifth wdt-content-area">
            <?php echo do_shortcode('[wdt_sp_navigation type="type2" listing_id="'.$listing_id.'"]'); ?>
        </div>
    </div>
    <span class="wdt-empty-space-50"> </span>
    <div class="wdt-column wdt-one-column first">
        <?php the_content(); ?>
    </div>
</div>