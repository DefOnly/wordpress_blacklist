<?php
// Modifying Comments Template
if(!function_exists('wdt_modifying_comment_template_from_module')) {
	function wdt_modifying_comment_template_from_module( $comment_template ) {

		if ( is_singular('wdt_listings') ) {
			return WDT_COMMENTS_PLUGIN_PATH . '/comments.php';
		}

		return $comment_template;

	}
	add_filter('comments_template', 'wdt_modifying_comment_template_from_module', 999);
}

// Comments Listing Html
if(!function_exists('wdt_modify_comments_html')) {
	function wdt_modify_comments_html($comment, $args, $depth) {

		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		$commenter = wp_get_current_commenter();
		if ( $commenter['comment_author_email'] ) {
			$moderation_note = esc_html__( 'Your comment is awaiting moderation.','wdt-portfolio');
		} else {
			$moderation_note = esc_html__( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.','wdt-portfolio');
		}

		?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

				<div class="comment-content">

					<div class="wdt-comment-content">
						<?php
						$wdt_title     = get_comment_meta( $comment->comment_ID, 'wdt_title', true );
						$wdt_media_ids = get_comment_meta( $comment->comment_ID, 'wdt_media_ids', true );
						$wdt_rating    = get_comment_meta( $comment->comment_ID, 'wdt_rating', true );

						if($wdt_title != '') {
							echo '<h2>'.esc_html($wdt_title).'</h2>';
						}

						if($wdt_rating != '') {
							echo '<div class="wdt-comment-rating">';
								echo wdt_comment_rating_display($wdt_rating);
								echo '<div class="wdt-comment-rating-overall"><span>'.esc_html( $wdt_rating ).'</span>/<span>5</span></div>';
							echo '</div>';
						}

						comment_text();

						if(is_array($wdt_media_ids) && !empty($wdt_media_ids)) {

							echo '<ul class="wdt-comment-gallery">';
							foreach($wdt_media_ids as $wdt_media_id) {
                                $thumbnail_url = wp_get_attachment_image_src($wdt_media_id, 'thumbnail');
                                $thumbnail_item = (isset($thumbnail_url[0]) && !empty($thumbnail_url[0])) ? $thumbnail_url[0] : '';
                                $full_url      = wp_get_attachment_image_src($wdt_media_id, 'full');
                                $full_item = (isset($full_url[0]) && !empty($full_url[0])) ? $full_url[0] : '';
                                if($thumbnail_item != '' && $full_item != '') {
                                    echo '<li>
                                            <a href="'.esc_url($full_url[0]).'" rel="prettyPhoto[comment_gallery_'.esc_attr($comment->comment_ID).']" class="wdt_comment_gallery_item"><img src="'.esc_url($thumbnail_url[0]).'" title="'.esc_html__('Comment Media','wdt-portfolio').'" all="'.esc_html__('Comment Media','wdt-portfolio').'" /></a>
                                        </li>';
                                }
							}
							echo '</ul>';

							wp_enqueue_style ( 'prettyPhoto' );
							wp_enqueue_script ( 'prettyPhoto' );

						}

						?>
					</div>
				</div><!-- .comment-content -->

				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php
						if ( 0 != $args['avatar_size'] ) {
							echo get_avatar( $comment, $args['avatar_size'] );
						}
						?>
						<?php
							printf(
								/* translators: %s: Comment author link. */
								__( '%s <span class="says">says:</span>' ),
								sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) )
							);
						?>
						<div class="comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php
										/* translators: 1: Comment date, 2: Comment time. */
										printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
									?>
								</time>
							</a>
							<?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .comment-metadata -->
					</div><!-- .comment-author -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<em class="comment-awaiting-moderation"><?php echo esc_html( $moderation_note ); ?></em>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply">',
							'after'     => '</div>',
						)
					)
				);
				?>
			</article><!-- .comment-body -->
		<?php

	}
}

// Custom Comment Form Fields

if(!function_exists('wdt_comment_form_fields')) {

	function wdt_comment_form_fields( $fields ) {

		$wdt_sp_comments_title  = get_query_var('wdt_sp_comments_title');
		$wdt_sp_comments_rating = get_query_var('wdt_sp_comments_rating');
		$wdt_sp_comments_media  = get_query_var('wdt_sp_comments_media');

		if($wdt_sp_comments_title == 'true') {
			$fields['wdt_title']  = '<p class="comment-form-title">
											<input id="wdt_title" name="wdt_title" type="text" value="" placeholder="'.esc_html__( 'Title','wdt-portfolio').'" />
											<span></span>
										</p>';
		}

		if($wdt_sp_comments_rating == 'true') {
			$fields['wdt_rating']  = '<p class="comment-form-rating wdt-ratings-holder">
											<label for="wdt_rating">'.esc_html__('Rating','wdt-portfolio').'</label>
											'.wdt_comment_rating_display(0).'
											<input id="wdt_rating" name="wdt_rating" type="hidden" value="" />
										</p>';
		}

		if($wdt_sp_comments_media == 'true') {
			$fields['wdt_media']  = '<p class="comment-form-media">
										<span>
											<input id="wdt_media" class="wdt-comment-media-upload" name="wdt_media[]" type="file" multiple="multiple" />
											<label for="wdt_media" class="wdt-comment-media-label">'.esc_html__('Attach File','wdt-portfolio').'</label>
										</span>
									</p>';
		}

		return $fields;

	}

	add_filter( 'comment_form_default_fields', 'wdt_comment_form_fields' );

}

// Custom Comment Form Fields to show after user logged in

if(!function_exists('wdt_comment_fields_after_login')) {

	function wdt_comment_fields_after_login () {

		$wdt_sp_comments_title  = get_query_var('wdt_sp_comments_title');
		$wdt_sp_comments_rating = get_query_var('wdt_sp_comments_rating');
		$wdt_sp_comments_media  = get_query_var('wdt_sp_comments_media');

		if($wdt_sp_comments_title == 'true') {
			echo '<p class="comment-form-title">
					<input id="wdt_title" name="wdt_title" type="text" value="" placeholder="'.esc_html__( 'Title','wdt-portfolio').'" />
					<span></span>
				</p>';
		}

		if($wdt_sp_comments_rating == 'true') {
			echo '<p class="comment-form-rating wdt-ratings-holder">
					<label for="wdt_rating">'.esc_html__('Rating','wdt-portfolio').'</label>
					'.wdt_comment_rating_display(0).'
					<input id="wdt_rating" name="wdt_rating" type="hidden" value="" />
				</p>';
		}

		if($wdt_sp_comments_media == 'true') {
			echo '<p class="comment-form-media">
					<span>
						<input id="wdt_media" class="wdt-comment-media-upload" name="wdt_media[]" type="file" multiple="multiple" />
						<label for="wdt_media" class="wdt-comment-media-label">'.esc_html__('Attach File','wdt-portfolio').'</label>
					</span>
				</p>';
		}

	}

	add_action( 'comment_form_logged_in_after', 'wdt_comment_fields_after_login' );

}

// Move comment field to bottom

if(!function_exists('wdt_reorder_comment_form_fields')) {

	function wdt_reorder_comment_form_fields( $fields ) {

		if(is_singular('wdt_listings')) {

			$comment_field     = '<p class="comment-form-comment">
									<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" placeholder="'.esc_attr__( 'Comment *','wdt-portfolio').'" required="required"></textarea>
									<span></span>
								</p>';
			$author_field      = '<p class="comment-form-author">
									<input id="author" name="author" type="text" value="" size="30" maxlength="245" placeholder="'.esc_attr__( 'Name *','wdt-portfolio').'" required="required">
									<span></span>
								</p>';
			$email_field       = '<p class="comment-form-email">
									<input id="email" name="email" type="email" value="" size="30" maxlength="100" aria-describedby="email-notes"  placeholder="'.esc_attr__('Email *','wdt-portfolio').'" required="required">
									<span></span>
								</p>';


			//$comment_field     = $fields['comment'];
			//$author_field      = $fields['author'];
			//$email_field       = $fields['email'];
			$url_field         = $fields['url'];
			$cookies_field     = $fields['cookies'];
			$wdt_title_field  = isset($fields['wdt_title']) ? $fields['wdt_title'] : '';
			$wdt_rating_field = isset($fields['wdt_rating']) ? $fields['wdt_rating'] : '';
			$wdt_media_field  = isset($fields['wdt_media']) ? $fields['wdt_media'] : '';

			unset( $fields['comment'] );
			unset( $fields['author'] );
			unset( $fields['email'] );
			unset( $fields['url'] );
			unset( $fields['cookies'] );
			unset( $fields['wdt_title'] );
			unset( $fields['wdt_rating'] );
			unset( $fields['wdt_media'] );

			$fields['wdt_rating'] = '<div class="wdt-comment-form-fields-holder">'.$wdt_rating_field;
			$fields['author']      = '<div class="wdt-comment-form-fields-item">'.$author_field;
			$fields['email']       = $email_field;
			$fields['wdt_title']  = $wdt_title_field;
			$fields['wdt_media']  = $wdt_media_field.'</div>';
			$fields['comment']     = $comment_field;
			$fields['cookies']     = $cookies_field;

		}

		return $fields;

	}

	add_filter( 'comment_form_fields', 'wdt_reorder_comment_form_fields' );

}

// Comment submit button

if(!function_exists('wdt_modify_comment_form_submit_field')) {

	function wdt_modify_comment_form_submit_field( $submit_field, $args ) {

		if(is_singular('wdt_listings')) {
			$submit_field = $submit_field.'</div>';
		}

		return $submit_field;

	}

	add_filter( 'comment_form_submit_field', 'wdt_modify_comment_form_submit_field', 10, 2 );

}

// Save the comment meta data along with comment

if(!function_exists('wdt_save_comment_fields')) {

	function wdt_save_comment_fields( $comment_id, $comment_approved, $commentdata ) {

		if(get_post_type($commentdata['comment_post_ID']) != 'wdt_listings') {
            return;
        }

		require_once ABSPATH . 'wp-admin/includes/image.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';

		if ($_POST['wdt_title'] != '') {
			$wdt_title = wp_filter_nohtml_kses($_POST['wdt_title']);
			add_comment_meta( $comment_id, 'wdt_title', $wdt_title );
		}

		if ($_POST['wdt_rating'] != '') {
			$wdt_rating = wp_filter_nohtml_kses($_POST['wdt_rating']);
			add_comment_meta( $comment_id, 'wdt_rating', $wdt_rating );
		}

		$media_ids = array ();
		$mediaFiles = $_FILES['wdt_media'];

	  	if(is_array($mediaFiles) && !empty($mediaFiles)) {
		    foreach ($mediaFiles['name'] as $key => $value) {
		        if ($mediaFiles['name'][$key]) {
		            $file = array (
				                'name' => $mediaFiles['name'][$key],
				                'type' => $mediaFiles['type'][$key],
				                'tmp_name' => $mediaFiles['tmp_name'][$key],
				                'error' => $mediaFiles['error'][$key],
				                'size' => $mediaFiles['size'][$key]
				            );
		            $_FILES = array ('comment-medias' => $file);

		            foreach ($_FILES as $file => $array) {
			          $media_item_id = media_handle_upload( $file, $commentdata['comment_post_ID'] );
			          array_push($media_ids, $media_item_id);
		            }
		        }
		    }
			add_comment_meta( $comment_id, 'wdt_media_ids',  $media_ids );
		}

		if( $comment_approved == 1 ) {
			$listing_id = $commentdata['comment_post_ID'];
			$average_ratings = wdt_get_average_comment_ratings($listing_id);
			update_post_meta($listing_id, 'wdt_average_ratings', $average_ratings);
		}


		// Update Recent Activities

			$comment_post = get_post($commentdata['comment_post_ID']);
			$author_id    = $comment_post->post_author;

			$recentActivitiesData['type']       = 'review';
			$recentActivitiesData['date']       = date(get_option('date_format').' '.get_option('time_format'));
			$recentActivitiesData['user_id']    = $commentdata['user_id'];
			$recentActivitiesData['name'] 		= $commentdata['comment_author'];
			$recentActivitiesData['phone']      = '';
			$recentActivitiesData['email']      = $commentdata['comment_author_email'];
			$recentActivitiesData['listing_id'] = $commentdata['comment_post_ID'];
			$recentActivitiesData['comment_id'] = $comment_id;

			$wdt_recent_activities = get_user_meta($author_id, 'wdt_recent_activities', true);
			$wdt_recent_activities = (is_array($wdt_recent_activities) && !empty($wdt_recent_activities)) ? $wdt_recent_activities : array ();

			if(!empty($wdt_recent_activities)) {

				if(count($wdt_recent_activities) >= 20) {
					$wdt_recent_activities = array_slice($wdt_recent_activities, 0, 20);
					array_unshift($wdt_recent_activities, $recentActivitiesData);
				} else {
					array_unshift($wdt_recent_activities, $recentActivitiesData);
				}

			} else {

				array_unshift($wdt_recent_activities, $recentActivitiesData);

			}

			update_user_meta($author_id, 'wdt_recent_activities', $wdt_recent_activities);


	}

	add_action( 'comment_post', 'wdt_save_comment_fields', 10, 3 );

}


## Backend - Comments ##

// Comments Metabox

if(!function_exists('wdt_comment_custom_metabox')) {

	function wdt_comment_custom_metabox() {
	    add_meta_box( 'title', esc_html__( 'Comment Options','wdt-portfolio'), 'wdt_comment_backend_custom_metabox_fields', 'comment', 'normal', 'high' );
	}

	add_action( 'add_meta_boxes_comment', 'wdt_comment_custom_metabox' );

}

if(!function_exists('wdt_comment_backend_custom_metabox_fields')) {

	function wdt_comment_backend_custom_metabox_fields ( $comment ) {

	    $wdt_title  = get_comment_meta( $comment->comment_ID, 'wdt_title', true );
	    $wdt_rating = get_comment_meta( $comment->comment_ID, 'wdt_rating', true );

	    wp_nonce_field( 'wdt_comment_update', 'wdt_comment_update', false );

	    $output = '';
		$output .= '<div class="wdt-custom-box">
						<div class="wdt-column wdt-one-fifth first">
							'.esc_html__('Title','wdt-portfolio').'
						</div>
						<div class="wdt-column wdt-four-fifth">
							<input id="wdt_title" name="wdt_title" type="text" placeholder="'.esc_html__('Title','wdt-portfolio').'" value="'.esc_attr($wdt_title).'" />
						</div>
					</div>';

		$output .= '<div class="wdt-custom-box">
						<div class="wdt-column wdt-one-fifth first">
							'.esc_html__('Ratings','wdt-portfolio').'
						</div>
						<div class="wdt-column wdt-four-fifth wdt-ratings-holder">
							'.wdt_comment_rating_display($wdt_rating).'
							<input id="wdt_rating" name="wdt_rating" value="'.esc_attr($wdt_rating).'" type="hidden" />
						</div>
					</div>';

		$output .= '<div class="wdt-custom-box">
						<div class="wdt-column wdt-one-column first">
							<div class="wdt-column wdt-one-fifth first">
								'.esc_html__('Media','wdt-portfolio').'
							</div>
							<div class="wdt-column wdt-four-fifth">
								'.wdt_comment_backend_media_field($comment->comment_ID).'
							</div>
						</div>
					</div>';

		echo $output;

	}

}

// Update comment meta data from comment edit screen

if(!function_exists('wdt_comment_backend_edit_metafields')) {

	function wdt_comment_backend_edit_metafields( $comment_id, $commentdata ) {

	    if( ! isset( $_POST['wdt_comment_update'] ) || ! wp_verify_nonce( $_POST['wdt_comment_update'], 'wdt_comment_update' ) ) {
	    	return;
	    }

		// Update title

			if (isset( $_POST['wdt_title']) && $_POST['wdt_title'] != '') {
				$wdt_title = wp_filter_nohtml_kses($_POST['wdt_title']);
				update_comment_meta($comment_id, 'wdt_title', $wdt_title);
			} else {
				delete_comment_meta($comment_id, 'wdt_title');
			}

		// Ratings

			if (isset( $_POST['wdt_rating']) && $_POST['wdt_rating'] != '') {
				$wdt_rating = wp_filter_nohtml_kses($_POST['wdt_rating']);
				update_comment_meta($comment_id, 'wdt_rating', $wdt_rating);
			} else {
				delete_comment_meta($comment_id, 'wdt_rating');
			}

		// Update media

			if (isset( $_POST['wdt_media_attachment_ids']) && $_POST['wdt_media_attachment_ids'] != '') {
				update_comment_meta($comment_id, 'wdt_media_ids', wdt_sanitize_fields($_POST['wdt_media_attachment_ids']));
			} else {
				delete_comment_meta($comment_id, 'wdt_media_ids');
			}

		// Update average rating

			if( $commentdata['comment_approved'] == 1 ) {
				$listing_id = $commentdata['comment_post_ID'];
				$average_ratings = wdt_get_average_comment_ratings($listing_id);
				update_post_meta($listing_id, 'wdt_average_ratings', $average_ratings);
			}

	}

	add_action( 'edit_comment', 'wdt_comment_backend_edit_metafields', 10, 2 );

}

// Comment rating disaply html

if(!function_exists('wdt_comment_rating_display')) {
	function wdt_comment_rating_display($rating_value) {

		$output = '';

        if($rating_value == ''){
            $rating_value = 0;
        }

		$average_rating_half_empty = '';
		if(strpos($rating_value, '.') !== false) {
			$average_rating_half_empty = ceil($rating_value);
		}

		$average_rating_ceil = ceil($rating_value);
		$average_rating_floor = floor($rating_value);

		for($i = 1; $i <= 5; $i++) {
			if($i <= $average_rating_floor) {
				$output .= '<span class="zmdi zmdi-star">'.esc_html( $i ).'</span>';
			}
			if($average_rating_half_empty != '' && $average_rating_half_empty == $i) {
				$output .= '<span class="zmdi zmdi-star-half">'.esc_html( $i ).'</span>';
			}
			if($i > $average_rating_ceil) {
				$output .= '<span class="zmdi zmdi-star-outline">'.esc_html( $i ).'</span>';
			}
		}

		return $output;

	}
}

// Calculate average comment rating

if(!function_exists('wdt_get_average_comment_ratings')) {
	function wdt_get_average_comment_ratings($listing_id) {

		$comments = get_approved_comments( $listing_id );
		$total_comments = count($comments);

		$total_commentrating = 0;
		foreach($comments as $comment) {
			$commentrating = get_comment_meta( $comment->comment_ID, 'wdt_rating', true );
			$total_commentrating = (int)$total_commentrating + (int)$commentrating;
		}

		$average_rating = ($total_comments > 0) ? ($total_commentrating/$total_comments) : 0;

		return $average_rating;

	}
}

// Update average ratings on comment transition

if(!function_exists('wdt_updateratings_on_transition_comment_status')) {

	function wdt_updateratings_on_transition_comment_status( $new_status, $old_status, $commentdata ) {

		if( $new_status === 'approved' || $new_status === 'unapproved' ) {
			$listing_id = $commentdata->comment_post_ID;
			$average_ratings = wdt_get_average_comment_ratings($listing_id);
			update_post_meta($listing_id, 'wdt_average_ratings', $average_ratings);
		}

	}

	add_action( 'transition_comment_status', 'wdt_updateratings_on_transition_comment_status', 10, 3 );

}

// Update average ratings on comment delete

if(!function_exists('wdt_updateratings_on_delete_comment')) {

	function wdt_updateratings_on_delete_comment( $comment_id ) {

		$commentdata = get_comment($comment_id);

		$listing_id = $commentdata->comment_post_ID;
		$average_ratings = wdt_get_average_comment_ratings($listing_id);
		update_post_meta($listing_id, 'wdt_average_ratings', $average_ratings);

	}

	add_action( 'delete_comment', 'wdt_updateratings_on_delete_comment', 10, 1 );
	add_action( 'trash_comment', 'wdt_updateratings_on_delete_comment', 10, 1 );

}

// Attach media from backend field

if(!function_exists('wdt_comment_backend_media_field')) {
	function wdt_comment_backend_media_field($comment_id) {

		$output = '';

		$wdt_media_ids = array ();
		if($comment_id > 0) {
			$wdt_media_ids = get_comment_meta($comment_id, 'wdt_media_ids', true);
		}

		$output .= '<div class="wdt-upload-media-items-container">

						<div class="wdt-upload-media-items-holder">
							<ul class="wdt-upload-media-items">';

								if(is_array($wdt_media_ids) && !empty($wdt_media_ids)) {
									$i = 0;
									foreach($wdt_media_ids as $wdt_media_id) {
										if($wdt_media_id != '') {
											$thumbnail_url = wp_get_attachment_image_src($wdt_media_id, 'thumbnail');
											$output .= '<li data-imageid="'.$wdt_media_id.'">
															<img src="'.esc_url($thumbnail_url[0]).'" title="'.esc_html__('Media Title','wdt-portfolio').'" all="'.esc_html__('Media Title','wdt-portfolio').'" />
															<input name="wdt_media_attachment_ids[]" type="hidden" class="uploadfieldid hidden" readonly value="'.$wdt_media_id.'"/>
															<span class="wdt-remove-media-item"><span class="fas fa-times"></span></span>
														</li>';
											$i++;
										}
									}
								}

				$output .= '</ul>
						</div>

						<input type="button" value="'.esc_html__('Upload Media','wdt-portfolio').'" class="wdt-upload-media-item-button multiple" />
						<input type="button" value="'.esc_html__('Remove Media','wdt-portfolio').'" class="wdt-upload-media-item-reset" />

					</div>';

		return $output;

	}
}

?>