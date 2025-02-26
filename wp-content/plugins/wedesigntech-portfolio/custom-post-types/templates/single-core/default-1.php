<?php
$listing_id = get_the_ID();
$listing_taxonomies = wp_get_post_terms($listing_id, 'wdt_listings_category', array ('orderby' => 'parent'));
$term_ids = array_column($listing_taxonomies, 'term_id');
$term_ids_str =  implode(',', $term_ids);
?>

<div class="wdt-portfolio-single type1">
    <div class="wdt-single-header-area">
        <div class="wdt-column wdt-three-fourth first wdt-content-area">
            <?php echo do_shortcode('[wdt_sp_utils show_title="true" listing_id="'.$listing_id.'"]'); ?>
            <span class="wdt-empty-space-20"> </span>
            <p><?php echo get_the_excerpt($listing_id); ?></p>
            <span class="wdt-empty-space-20"> </span>
            <?php echo do_shortcode('[wdt_sp_utils show_favourite="true" listing_id="'.$listing_id.'"]'); ?>
        </div>
        <div class="wdt-column wdt-one-fourth wdt-info-area">
            <div class="wdt-column wdt-one-column first">
                <span class="wdt-empty-space-30"> </span>
                <?php echo do_shortcode('[wdt_sp_features listing_id="'.$listing_id.'" type="type2" columns="1"]'); ?>
            </div>
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_taxonomy taxonomy="wdt_listings_category" show_categories="true" show_label="true" listing_id="'.$listing_id.'" type="type1"]'); ?>
            </div>
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_post_date type="type1" with_label="true" listing_id="'.$listing_id.'"]'); ?>
            </div>
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_social_links type="default" listing_id="'.$listing_id.'"]'); ?>
            </div>
        </div>
    </div>
    <span class="wdt-empty-space-30"> </span>
    <div class="wdt-single-image-area wdt-image-list-area">
        <div class="wdt-column wdt-one-half first">
            <?php echo do_shortcode('[wdt_sp_media_images_list columns="2" include_featured_image="false" with_space="false" image_ids="0,1" listing_id="'.$listing_id.'"]'); ?>
            <span class="wdt-empty-space-15"> </span>
            <?php echo do_shortcode('[wdt_sp_media_images_list columns="1" include_featured_image="false" with_space="false" image_ids="2" listing_id="'.$listing_id.'"]'); ?>
        </div>
        <div class="wdt-column wdt-one-half">
            <?php echo do_shortcode('[wdt_sp_media_images_list columns="1" include_featured_image="false" with_space="false" image_ids="3" listing_id="'.$listing_id.'"]'); ?>
            <span class="wdt-empty-space-15"> </span>
            <?php echo do_shortcode('[wdt_sp_media_images_list columns="2" include_featured_image="false" with_space="false" image_ids="4,5" listing_id="'.$listing_id.'"]'); ?>
        </div>
    </div>
    <span class="wdt-empty-space-35"> </span>
    <div class="wdt-column wdt-one-column first">
        <h3>Related Projects</h3>
        <span class="wdt-empty-space-35"> </span>
        <?php echo do_shortcode('[wdt_listings_listing type="type2" post_per_page="4" columns="4" category_ids="'.$term_ids_str.'"]'); ?>
    </div>
    <span class="wdt-empty-space-30"> </span>
    <?php echo do_shortcode('[wdt_sp_navigation type="type2" listing_id="'.$listing_id.'"]'); ?>
    <span class="wdt-empty-space-50"> </span>
    <div class="wdt-column wdt-one-column first">
        <?php the_content(); ?>
    </div>
</div>