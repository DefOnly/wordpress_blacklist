<?php
if ( post_password_required() ) {
	return;
}?>

<div id="comments" class="comments-area">
	<?php
	if ( have_comments() ) : ?>

	    <h3><?php comments_number(esc_html__('No Comments','wdt-portfolio'), esc_html__('Comments ( 1 )','wdt-portfolio'), esc_html__('Comments  ( % )','wdt-portfolio') );?></h3>

		<?php the_comments_navigation(); ?>

        <ul class="commentlist">
     		<?php wp_list_comments( array( 'avatar_size' => 50, 'callback' => 'wdt_modify_comments_html' ) ); ?>
        </ul>

        <?php the_comments_navigation();

    endif;

	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="nocomments"><?php esc_html_e( 'Comments are closed.','wdt-portfolio'); ?></p><?php
	endif;


	ob_start();
	comment_form();
	$comment_form = ob_get_contents();
	$comment_form = str_replace('<form ','<form enctype="multipart/form-data" ', $comment_form);
	if(is_user_logged_in()) {
		$comment_form = str_replace('class="comment-form"','class="comment-form wdt-comment-form-fields-holder"', $comment_form);
	}
	ob_end_clean();

	echo $comment_form;
	?>
</div>