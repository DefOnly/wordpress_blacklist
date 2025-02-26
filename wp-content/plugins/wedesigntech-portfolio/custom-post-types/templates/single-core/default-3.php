<?php
$listing_id = get_the_ID();
$listing_taxonomies = wp_get_post_terms($listing_id, 'wdt_listings_category', array ('orderby' => 'parent'));
$term_ids = array_column($listing_taxonomies, 'term_id');
$term_ids_str =  implode(',', $term_ids);
?>

<div class="wdt-portfolio-single type3">
    <div class="wdt-single-header-area">
        <div class="wdt-column column no-space wdt-three-fifth wdt-image-area">
            <?php echo do_shortcode('[wdt_sp_media_images carousel_effect="default" carousel_slidesperview="1" carousel_loopmode="true" carousel_arrowpagination="true" carousel_arrowpagination_type="type3" listing_id="'.$listing_id.'"]'); ?>
        </div>

        <div class="wdt-column column no-space wdt-two-fifth  wdt-info-area">
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_utils show_title="true" listing_id="'.$listing_id.'"]'); ?>
            </div>
            <span class="wdt-empty-space-20"> </span>
            <div class="wdt-column wdt-one-column first">
                <p><?php echo get_the_excerpt($listing_id); ?></p>
            </div>
            <span class="wdt-empty-space-20"> </span>
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_features listing_id="'.$listing_id.'" type="type2" columns="1"]'); ?>
            </div>
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_taxonomy taxonomy="wdt_listings_category" show_categories="true" show_label="true" listing_id="'.$listing_id.'" type="type1"]'); ?>
            </div>
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_post_date type="type1" with_label="true" listing_id="'.$listing_id.'"]'); ?>
            </div>
            <span class="wdt-empty-space-10"> </span>
            <div class="wdt-column wdt-one-column first">
                <?php echo do_shortcode('[wdt_sp_taxonomy taxonomy="wdt_listings_amenity" show_categories="true" show_label="true" listing_id="'.$listing_id.'" type="type1"]'); ?>
            </div>
        </div>
        <span class="wdt-empty-space-35"> </span>
        <div class="wdt-column wdt-one-column first">
            <h3>Related Projects</h3>
            <span class="wdt-empty-space-35"> </span>
            <?php echo do_shortcode('[wdt_listings_listing type="type1" post_per_page="4" columns="4" category_ids="'.$term_ids_str.'"]'); ?>
        </div>
        <?php echo do_shortcode('[wdt_sp_navigation type="type3" listing_id="'.$listing_id.'"]'); ?>
    </div>
    <span class="wdt-empty-space-50"> </span>
    <div class="wdt-column wdt-one-column first">
        <?php the_content(); ?>
    </div>
</div>