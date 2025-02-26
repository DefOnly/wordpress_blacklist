(function ($) {
    "use strict";
	$(document).ready(function() {
        if( $("#primary .side-navigation-container").length ) {
            $('.sidenav-sticky.side-navigation')
                .theiaStickySidebar({
                    additionalMarginTop: 90,
                    containerSelector: $('#primary .side-navigation-container')
                });
        }
    });
})(jQuery);