<?php
	$template_args['post_ID'] = $ID;
	$template_args['post_Style'] = $Post_Style;
	$template_args = array_merge( $template_args, dada_single_post_params() ); ?>

    <?php dada_template_part( 'post', 'templates/'.$Post_Style.'/parts/image', '', $template_args ); ?>

	<!-- Post Meta -->
    <div class="post-meta">

		<!-- Meta Right -->
        <div class="meta-posted-item">
            <?php dada_template_part( 'post', 'templates/'.$Post_Style.'/parts/date', '', $template_args ); ?>
            <?php dada_template_part( 'post', 'templates/'.$Post_Style.'/parts/comment', '', $template_args ); ?>
        </div><!-- Meta Right -->

    </div><!-- Post Meta -->

    <!-- Post Dynamic -->
    <?php echo apply_filters( 'dada_single_post_dynamic_template_part', dada_get_template_part( 'post', 'templates/'.$Post_Style.'/parts/dynamic', '', $template_args ) ); ?><!-- Post Dynamic -->