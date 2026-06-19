function traveller_agency_openNav() {
  jQuery(".sidenav").addClass('show');
}
function traveller_agency_closeNav() {
  jQuery(".sidenav").removeClass('show');
}

( function( window, document ) {
  function traveller_agency_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const traveller_agency_nav = document.querySelector( '.sidenav' );

      if ( ! traveller_agency_nav || ! traveller_agency_nav.classList.contains( 'show' ) ) {
        return;
      }

      const elements = [...traveller_agency_nav.querySelectorAll( 'input, a, button' )],
        traveller_agency_lastEl = elements[ elements.length - 1 ],
        traveller_agency_firstEl = elements[0],
        traveller_agency_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && traveller_agency_lastEl === traveller_agency_activeEl ) {
        e.preventDefault();
        traveller_agency_firstEl.focus();
      }

      if ( shiftKey && tabKey && traveller_agency_firstEl === traveller_agency_activeEl ) {
        e.preventDefault();
        traveller_agency_lastEl.focus();
      }
    } );
  }
  traveller_agency_keepFocusInMenu();
} )( window, document );

var btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

jQuery(document).ready(function() {
  var owl = jQuery('#top-slider .owl-carousel');
    owl.owlCarousel({
      margin: 0,
      nav: true,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      // autoHeight: true,
      loop: true,
      dots:false,
      navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1024: {
          items: 1
      }
    }
  })
})

window.addEventListener('load', (event) => {
  jQuery(".loading").delay(2000).fadeOut("slow");
});

 jQuery('document').ready(function(){
  jQuery(".kksr-legend").html(function() {
    var text1 = jQuery(this).text().trim().split(" ");
    var third = text1[0];
    var fourth = text1[1];
    var updatedText1 = `<span class='star_rating'>${third}</span>`;
    text1.splice(0, 1);
    text1.splice(0, 0, updatedText1);
    var updatedText2 = `<span class='rating_text'>${fourth}</span>`;
    text1.splice(1, 1);
    text1.splice(1, 0, updatedText2);
    return text1.join(" ");
  });
  });

  //  var headline = document.getElementById("kksr-legend");
// headline.innerHTML = "(3 view)";
(function ($) {
  
  // Some script here
  $('.kksr-legend').text(function () {
    return $(this).text().replace('vote', 'review');
  });
  
 })(jQuery);