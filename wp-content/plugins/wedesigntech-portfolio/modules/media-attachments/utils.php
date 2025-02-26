<?php

// Dashboard Attachments Field
if(!function_exists('wdt_listing_attachments_field')) {
    function wdt_listing_attachments_field($item_id) {

        $output = '';

        $output .= '<div class="wdt-attachments-box-container">';

            $output .= '<div class="wdt-attachments-box-item-holder">';

                $wdt_media_attachments_titles = $wdt_media_attachments_items = '';
                if($item_id > 0) {
                    $wdt_media_attachments_titles = get_post_meta($item_id, 'wdt_media_attachments_titles', true);
                    $wdt_media_attachments_items  = get_post_meta($item_id, 'wdt_media_attachments_items', true);
                }

                $j = 0;
                if(is_array($wdt_media_attachments_titles) && !empty($wdt_media_attachments_titles)) {
                    foreach($wdt_media_attachments_titles as $wdt_media_attachments_title) {

                        $attachment_url = wp_get_attachment_url($wdt_media_attachments_items[$j]);

                        $output .= '<div class="wdt-attachments-box-item">
                                        <div class="wdt-column wdt-one-column first">
                                            <input name="wdt_media_attachments_titles[]" class="wdt_media_attachments_titles" type="text" value="'.esc_attr($wdt_media_attachments_title).'" placeholder="'.esc_html__('Title','wdt-portfolio').'" />
                                        </div>
                                        <div class="wdt-column wdt-one-column first wdt-upload-media-items-container">
                                            <input name="wdt_media_attachments_items_url" type="text" value="'.esc_url($attachment_url).'" placeholder="'.esc_html__('Item','wdt-portfolio').'" class="uploadfieldurl" readonly />
                                            <input name="wdt_media_attachments_items[]" type="hidden" value="'.esc_attr($wdt_media_attachments_items[$j]).'" placeholder="'.esc_html__('Item','wdt-portfolio').'" class="uploadfieldid" readonly />
                                            <input type="button" value="'.esc_html__('Upload','wdt-portfolio').'" class="wdt-upload-media-item-button show-preview" />
                                            <input type="button" value="'.esc_html__('Remove','wdt-portfolio').'" class="wdt-upload-media-item-reset" />
                                        </div>
                                        <div class="wdt-attachments-box-options">
                                            <span class="wdt-remove-attachments"><span class="fas fa-times"></span></span>
                                            <span class="wdt-sort-attachments"><span class="fas fa-arrows-alt"></span></span>
                                        </div>
                                    </div>';
                        $j++;
                    }
                }

            $output .= '</div>';

            $output .= '<a href="#" class="wdt-add-attachments-box custom-button-style">'.esc_html__('Add Attachment','wdt-portfolio').'</a>';

            $output .= '<div class="wdt-attachments-box-item-toclone hidden">
                            <div class="wdt-column wdt-one-column first">
                                <input id="wdt_media_attachments_titles" type="text" placeholder="'.esc_html__('Title','wdt-portfolio').'" />
                            </div>
                            <div class="wdt-column wdt-one-column first wdt-upload-media-items-container">
                                <input name="wdt_media_attachments_items_url" type="text" placeholder="'.esc_html__('Item','wdt-portfolio').'" class="uploadfieldurl" readonly />
                                <input id="wdt_media_attachments_items" type="hidden" placeholder="'.esc_html__('Item','wdt-portfolio').'" class="uploadfieldid" readonly />
                                <input type="button" value="'.esc_html__('Upload','wdt-portfolio').'" class="wdt-upload-media-item-button show-preview" />
                                <input type="button" value="'.esc_html__('Remove','wdt-portfolio').'" class="wdt-upload-media-item-reset" />
                            </div>
                            <div class="wdt-attachments-box-options">
                                <span class="wdt-remove-attachments"><span class="fas fa-times"></span></span>
                                <span class="wdt-sort-attachments"><span class="fas fa-arrows-alt"></span></span>
                            </div>
                        </div>';

        $output .= '</div>';

        return $output;

    }
}

?>