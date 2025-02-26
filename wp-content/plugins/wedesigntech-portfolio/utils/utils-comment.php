<?php

// Modifying Comments Template

if(!function_exists('wdt_modifying_comment_template')) {
	function wdt_modifying_comment_template( $comment_template ) {

		$wdt_modules = wdtportfolio_instance()->active_modules;
		$wdt_modules = (is_array($wdt_modules) && !empty($wdt_modules)) ? $wdt_modules : array ();

		if ( is_singular('wdt_listings') ) {
			if ( !in_array('comments', $wdt_modules) ) {
				return WDT_PLUGIN_PATH . '/utils/comments.php';
			}
		}

		return $comment_template;

	}
	add_filter('comments_template', 'wdt_modifying_comment_template');
}

?>