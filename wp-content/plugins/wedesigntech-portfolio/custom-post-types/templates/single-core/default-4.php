<?php
$listing_id = get_the_ID();
?>

<div class="wdt-portfolio-single type4">
    <div class="wdt-single-header-area">
        <div class="wdt-column column no-space wdt-three-fifth wdt-image-area">
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_media_images_list columns="1" include_featured_image="false" with_space="false" image_ids="0" listing_id="'.$listing_id.'"]'); ?>
            </div>
            <span class="wdt-empty-space-15"> </span>
            <div class="wdt-column wdt-one-column first">
                <div class="wdt-column wdt-one-half first">
                    <?php echo do_shortcode('[wdt_sp_media_images_list columns="1" include_featured_image="false" with_space="false" image_ids="1" listing_id="'.$listing_id.'"]'); ?>
                </div>
                <div class="wdt-column wdt-one-half">
                    <?php echo do_shortcode('[wdt_sp_media_images_list columns="1" include_featured_image="false" with_space="false" image_ids="2" listing_id="'.$listing_id.'"]'); ?>
                    <span class="wdt-empty-space-15"> </span>
                    <?php echo do_shortcode('[wdt_sp_media_images_list columns="1" include_featured_image="false" with_space="false" image_ids="3" listing_id="'.$listing_id.'"]'); ?>
                </div>
            </div>
        </div>

        <div class="wdt-column column no-space wdt-two-fifth wdt-portfolio-sticky-section-container">
            <div class="wdt-portfolio-sticky-section">
                <div class="wdt-info-area wdt-portfolio-sticky-section-inner">
                    <div class="wdt-column wdt-one-column first">
                        <?php echo do_shortcode('[wdt_sp_taxonomy taxonomy="wdt_listings_category" show_categories="true" show_label="false" listing_id="'.$listing_id.'" type="type3"]'); ?>
                    </div>
                    <span class="wdt-empty-space-10"> </span>
                    <div class="wdt-column wdt-one-column first">
                        <?php echo do_shortcode('[wdt_sp_utils show_title="true" listing_id="'.$listing_id.'"]'); ?>
                    </div>
                    <span class="wdt-empty-space-20"> </span>
                    <div class="wdt-column wdt-one-column first">
                        <p><?php echo get_the_excerpt($listing_id); ?></p>
                    </div>
                    <span class="wdt-empty-space-10"> </span>
                    <div class="wdt-column wdt-one-column first">
                        <?php echo do_shortcode('[wdt_sp_post_date type="type1" with_label="true" listing_id="'.$listing_id.'"]'); ?>
                    </div>
                    <span class="wdt-empty-space-10"> </span>
                    <div class="wdt-column wdt-one-column first">
                        <?php echo do_shortcode('[wdt_sp_taxonomy taxonomy="wdt_listings_amenity" show_categories="true" show_label="true" listing_id="'.$listing_id.'" type="type1"]'); ?>
                    </div>
                    <span class="wdt-empty-space-30"> </span>
                    <div class="wdt-column wdt-one-column first">
                        <?php echo do_shortcode('[wdt_sp_social_share show_facebook="true" show_twitter="true" show_linkedin="true" show_pinterest="true" listing_id="'.$listing_id.'" type="type2"]'); ?>
                        <?php echo do_shortcode('[wdt_sp_utils show_favourite="true" listing_id="'.$listing_id.'"]'); ?>
                    </div>
                </div>
            </div>
        </div>
        <span class="wdt-empty-space-50"> </span>
        <?php echo do_shortcode('[wdt_sp_navigation type="type1" listing_id="'.$listing_id.'"]'); ?>
    </div>
    <span class="wdt-empty-space-50"> </span>
    <div class="wdt-column wdt-one-column first">
        <?php the_content(); ?>
    </div>
</div>