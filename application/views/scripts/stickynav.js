

// jquery 
//sticky nav
    function sticky_relocate() {
      var window_top = $(window).scrollTop();
      var div_top = $('#sticky-anchor').offset().top;

      if (window_top > div_top)
        $('#sticky').addClass('stick');
      else
        $('#sticky').removeClass('stick');
     }

$(window).scroll(function(event){

    // sticky nav css NON mobile way
       sticky_relocate();

       var st = $(this).scrollTop();

    // sticky nav iPhone android mobile way iOS<5

       if (navigator.userAgent.match(/OS 5(_\d)+ like Mac OS X/i)) {
            //do nothing uses sticky_relocate() css
       } else if ( navigator.userAgent.match(/(iPod|iPhone|iPad)/i) || navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) ) {

            var window_top = $(window).scrollTop();
            var div_top = $('#sticky-anchor').offset().top;

            if (window_top > div_top) {
                $('#sticky').css({'top' : st  , 'position' : 'absolute' });
            } else {
                $('#sticky').css({'top' : 'auto' });
            }
        };

});