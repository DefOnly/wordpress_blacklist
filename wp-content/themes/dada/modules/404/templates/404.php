<?php
    if( isset( $enable_404message ) && ( $enable_404message == 1 || $enable_404message == true )  ) {
        $class = $notfound_style;
        $class .= ( isset( $notfound_darkbg ) && ( $notfound_darkbg == 1 ) ) ? " wdt-dark-bg" :"";
    ?>
    <div class="wrapper <?php echo esc_attr( $class );?>">
        <div class="container">
            <div class="center-content-wrapper">
                <div class="center-content">
                    <div class="error-box square">
                        <div class="error-box-inner">
                        <img class="error-image" alt="The Page Not Found" src="<?php echo esc_url(DADA_ROOT_URI.'/assets/images/404-hang-tag.png');?>"/>
                        <h2>404</h2> 
                        <h3>Error</h2> 
                        <h4>Page Not Found</h2> 
                        <a class="wdt-button filled small" target="_self" href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e("Back to Home",'dada');?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><?php
}?>