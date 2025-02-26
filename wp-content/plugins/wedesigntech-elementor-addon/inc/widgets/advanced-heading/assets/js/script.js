(function ($) {

    const wdtAdvancedHeadingwidgetHandler = function($scope, $) {

        var $animation_elements = $scope.find('.wdt-heading-content-wrapper span');
        var $window = $(window);
        
        $window.on('scroll resize', check_if_in_view);

        function check_if_in_view() {

            var window_height = $window.height();
            var window_top_position = $window.scrollTop();
            var window_bottom_position = (window_top_position + window_height);
          
            $.each($animation_elements, function() {
              var $element = $(this);
              var element_height = $element.outerHeight();
              var element_top_position = $element.offset().top;
              var element_bottom_position = (element_top_position + element_height);

              var rotateAngle = 15;
              var x_value = 0;
              var y_value = 200;
              var $prevElement = $element.parent();

              $prevElement.css({"display":"block", "position": "relative"});
          
              //check to see if this current container is within viewport
              if ((element_bottom_position >= window_top_position) &&
                  (element_top_position <= window_bottom_position)) {

                $element.removeAttr('style');

                // $element.css("transform", "translate("+x_value+"%", +y_value+"%)");
                // $element.css("transform", "translate(0%", "200%)");
                // $element.css("transform", "rotate("+ rotateAngle +"deg)");

              } else {
                // $element.removeClass('in-view');

                $element.css({
                    "display":"block", 
                    "text-align":"start", 
                    "position":"relative", 
                    "opacity":"0",
                    "transform": "translate(" +x_value+ "%, "+y_value+"%)",
                    "rotate": rotateAngle +"deg"
                });
                
              }
            });
        }

        // const split_texts = gsap.utils.toArray('span');

        var $splitanimation = $scope.find('.wdt-heading-holder');
        const $moduleId = $splitanimation.data('id');

        //Title split animation

         let splitTitle = gsap.utils.toArray(".splitanimation-"+$moduleId);

          splitTitle.forEach(splitTextLine => {
            const itemTitleSplitted = new SplitText(splitTextLine, { type: "words, lines" });
            itemTitleSplitted.split({ type: "lines", tag: "span", linesClass:"wdtsplitanimation" });
          });

          //Title default animation
          let defaultTitle = gsap.utils.toArray(".defaultanimation-"+$moduleId);

          defaultTitle.forEach(splitTextLine => {
            const itemTitleSplitted = new SplitText(splitTextLine, { type: "words, lines" });
            itemTitleSplitted.split({ type: "words", tag: "span"});
          });

          //Title letter animation
          let letterTitle = gsap.utils.toArray(".charsplit-"+$moduleId);

          letterTitle.forEach(splitTextLine => {
            const itemTitleSplitted = new SplitText(splitTextLine, { type: "words, lines" });
            itemTitleSplitted.split({ type: "chars", tag: "span"});
          });

          let $heading_each_spans = $splitanimation.find('.charsplit-'+$moduleId);
          let $heading_ele = $heading_each_spans.find('span');

          $i = '30';
          $.each( $heading_ele, function(){
              $this_element = $(this);
              $this_element.css({ "animation-delay": $i+'ms' });
              $i = parseInt($i)+30;
          } );

          //Content skew animation

          let skewTitle = gsap.utils.toArray(".skew-"+$moduleId);

          skewTitle.forEach(skewTextLine => {
            const itemTitleSplitted = new SplitText(skewTextLine, { type: "words, lines" });
            itemTitleSplitted.split({ type: "lines", tag: "span", linesClass:"wdtsplitanimation" });
          });
      
          //Content fade in left animation

          let fadeinleft = gsap.utils.toArray(".fadeleft-"+$moduleId);

          fadeinleft.forEach(contentfade => {
            const itemcontentSplitted = new SplitText(contentfade, { type: "words, lines" });
            itemcontentSplitted.split({ type: "lines", tag: "span", linesClass:"wdtsplitanimation" });
          });

          //Content fade in right animation

          let fadeinright = gsap.utils.toArray(".faderight-"+$moduleId);

          fadeinright.forEach(contentfaderight => {
            const itemcontentfade = new SplitText(contentfaderight, { type: "words, lines"});
            itemcontentfade.split({ type: "lines", tag: "span", linesClass:"wdtsplitanimation" });
          });


        const $content_holder = $scope.find('.wdt-heading-holder');
        const $content_wrapper = $content_holder.find('.wdt-heading-content-wrapper');
        const $content_each = $content_wrapper.find('.wdt-content-animation');
        const $content_each_span = $content_each.find('.wdtsplitanimation');

        $i = '0';
        $.each( $content_each_span, function(){
            $this_element = $(this);
            $this_element.css({ "--line-index": $i});
            $i = parseInt($i)+1;
        } );


        const $heading_holder = $scope.find('.wdt-heading-holder');
        const $heading_wrapper = $heading_holder.find('.wdt-heading-title-wrapper');
        const $heading_each = $heading_wrapper.find('.wdt-heading-title');
        const $heading_each_span = $heading_each.find('.wdtsplitanimation');

        $i = '0';
        $.each( $heading_each_span, function(){
            $this_element = $(this);
            $this_element.css({ "--line-indexs": $i});
            $i = parseInt($i)+1;
        } );

        const $def_heading_holder = $scope.find('.wdt-heading-holder');
        const $def_heading_wrapper = $def_heading_holder.find('.wdt-heading-title-wrapper');
        const $def_heading_each = $def_heading_wrapper.find('.wdt-heading-title[class*="defaultanimation-"]');
        const $def_heading_each_span = $def_heading_each.find('span');

        $i = '0';
        $.each( $def_heading_each_span, function(){
            $this_element = $(this);
            $this_element.css({ "--line-indexs": $i});
            $i = parseInt($i)+1;
        } );

        const $content_holders = $scope.find('.wdt-heading-holder');
        const $content_wrapper_c = $content_holders.find('.wdt-heading-content-wrapper');
        const $content_each_c = $content_wrapper_c.find('.wdt-content-animation');
        const $content_each_c_span = $content_each_c.find('.wdt-content-skew');

        $i = '0';
        $.each( $content_each_c_span, function(){
            $this_element = $(this);
            $this_element.css({ "--line-index": $i});
            $i = parseInt($i)+1;
        } );

            
    };
  
    $(window).on('elementor/frontend/init', function () {
          elementorFrontend.hooks.addAction('frontend/element_ready/wdt-advanced-heading.default', wdtAdvancedHeadingwidgetHandler);
    });
  
  })(jQuery);
  