(function ($) {
    // "use strict";

    $(document).ready(function(){
        var loadercounter = 0;
        var loadercount = 0;
        var loader = setInterval(function(){
            $(".loader3 .loader-counter-3 span").html(loadercount + "%");
            $(".loader3").css("--width",loadercount + "%");
            
            loadercounter++;
            loadercount++;
            if(loadercounter == 101){
            clearInterval(loader);
            // $(".pre-loader3").css("display","none");
            $(".pre-loader3").css("transform",`translateY(${loadercount}%)`);
            }
        },50);
    });


})(jQuery);