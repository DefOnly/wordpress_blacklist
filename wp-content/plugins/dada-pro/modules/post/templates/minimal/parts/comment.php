<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
if(  ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
	<!-- Entry Comment -->
		<div class="single-entry-comments">
		<i class="wdticon-comment-o"></i>
		<div class="comment-wrap"><?php
			comments_popup_link(
				esc_html__('No Comments', 'dada-pro'),
				esc_html__('1 Comment', 'dada-pro'),
				esc_html__('% Comments', 'dada-pro'),
				'',
				esc_html__('Comments Off', 'dada-pro')
			); ?>
		</div>
	</div><!-- Entry Comment --><?php
}
?>