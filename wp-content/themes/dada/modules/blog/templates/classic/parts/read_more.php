<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
	if( $archive_readmore_text != '' ) :
		echo '<!-- Entry Button --><div class="entry-button wdt-core-button">';
			echo '<a href="'.get_permalink().'" title="'.the_title_attribute('echo=0').'" class="wdt-button">'.$archive_readmore_text.'<span>
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			viewBox="0 0 120 120" style="enable-background:new 0 0 120 120;" xml:space="preserve">
			<path d="M119,9.2c0-4.5-3.7-8.2-8.2-8.2L37.4,1c-4.4,0-8.2,3.3-8.5,7.7c-0.3,4.8,3.5,8.7,8.2,8.7h65.5c0,0,0,0,0,0l0,65.2
				c0,4.4,3.3,8.2,7.7,8.5c4.8,0.3,8.7-3.5,8.7-8.2V9.2z M15,116.6L116.6,15c0,0,0,0,0-0.1L105,3.4c0,0,0,0-0.1,0L3.4,105
				c-3.2,3.2-3.2,8.4,0,11.6l0,0C6.6,119.8,11.8,119.8,15,116.6z"/>
			</svg>
	   </span></a>';
		echo '</div><!-- Entry Button -->';
	endif; ?>