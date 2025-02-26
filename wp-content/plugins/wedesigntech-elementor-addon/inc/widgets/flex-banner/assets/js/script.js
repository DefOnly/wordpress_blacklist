(function ($) {

const wdtFlexBannerWidgetHandler = function($scope, $) {

    var $slider_effect = $scope.find('.wdt-flex-banner-options');
    var $content_option = $slider_effect.data('settings');

    if( $content_option['option'] == 'yes' ) {
        $(".wdt-flex-banner-option").hover(function(){
            $(".wdt-flex-banner-option").removeClass("active");
            $(this).addClass("active");
        });
    } else {
        $(".wdt-flex-banner-option").click(function(){
            $(".wdt-flex-banner-option").removeClass("active");
            $(this).addClass("active");
        });
    }


    $('.wdt-flex-banner-options.vertical-slider').find('.wdt-flex-banner-option').each(function(index) {
        const wdt_accordion = $(this);
        const wdt_accordion_header = wdt_accordion.find(".wdt-flex-banner-title-group");
        const wdt_header_content = wdt_accordion.find(".wdt-flex-banner-detail-group");
    
        wdt_accordion_header.on("click", () => {
            const wdt_accordion_Open = wdt_header_content.height() === wdt_header_content[0].scrollHeight;
    
            $('.wdt-flex-banner-options.vertical-slider').find('.wdt-flex-banner-option').each(function(i) {
                const wdt_acc_height = $(this).find(".wdt-flex-banner-detail-group");
    
                wdt_acc_height.height((i === index && !wdt_accordion_Open) ? wdt_acc_height[0].scrollHeight : 0);
            });
        });
    });     
    
}
            
$(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/wdt-flex-banner.default', wdtFlexBannerWidgetHandler);
});

})(jQuery);            
        