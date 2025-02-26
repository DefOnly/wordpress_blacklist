// hamburger menu js
(function ($) {

    var dtHamburgerMenuWidgetHandler = function($scope, $){


        var hamber_menu_left = $('.wdt-hamburger-header-menu');
        var hamber_menu_left_asign = $('.wdt-hamburger-header-menu > .hamburger-menu-container');
        if( hamber_menu_left.length ) {
            hamber_menu_left.each(function(){
                var hamber_left = $(this).offset().left;
                hamber_menu_left_asign.css('--hamber-left', hamber_left+'px');
            });
        }

        var $widget_module_id = $scope.attr('data-id');
        var menu_container = $scope.find($('#menuToggle-'+$widget_module_id+' .hamburger-menu-container ul > li.menu-item-has-children a:has(+ ul)'));
        menu_container.click( function() {
            $(this).toggleClass('wdt-active');
        } );

        menu_container.attr('href', 'javascript:void(0)')


    };

    //Elementor JS Hooks
    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/wdt-hamburger-header-menu.default', dtHamburgerMenuWidgetHandler);

    });

})(jQuery);