function vw_kindergarten_menu_open_nav() {
	window.vw_kindergarten_responsiveMenu=true;
	jQuery(".sidenav").addClass('show');
}
function vw_kindergarten_menu_close_nav() {
	window.vw_kindergarten_responsiveMenu=false;
 	jQuery(".sidenav").removeClass('show');
}

jQuery(function($){
 	"use strict";
 	jQuery('.main-menu > ul').superfish({
		delay: 500,
		animation: {opacity:'show',height:'show'},  
		speed: 'fast'
 	});
});

jQuery(document).ready(function () {
	window.vw_kindergarten_currentfocus=null;
  	vw_kindergarten_checkfocusdElement();
	var vw_kindergarten_body = document.querySelector('body');
	vw_kindergarten_body.addEventListener('keyup', vw_kindergarten_check_tab_press);
	var vw_kindergarten_gotoHome = false;
	var vw_kindergarten_gotoClose = false;
	window.vw_kindergarten_responsiveMenu=false;
 	function vw_kindergarten_checkfocusdElement(){
	 	if(window.vw_kindergarten_currentfocus=document.activeElement.className){
		 	window.vw_kindergarten_currentfocus=document.activeElement.className;
	 	}
 	}
 	function vw_kindergarten_check_tab_press(e) {
		"use strict";
		// pick passed event or global event object if passed one is empty
		e = e || event;
		var activeElement;

		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.vw_kindergarten_responsiveMenu){
			if (!e.shiftKey) {
				if(vw_kindergarten_gotoHome) {
					jQuery( ".main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				vw_kindergarten_gotoHome = true;
			} else {
				vw_kindergarten_gotoHome = false;
			}

		}else{

			if(window.vw_kindergarten_currentfocus=="responsivetoggle"){
				jQuery( "" ).focus();
			}}}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.vw_kindergarten_currentfocus=="header-search"){
				jQuery(".responsivetoggle").focus();
			}else{
				if(window.vw_kindergarten_responsiveMenu){
				if(vw_kindergarten_gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".main-menu ul:first li:first a:first-child" ).is(":focus")) {
					vw_kindergarten_gotoClose = true;
				} else {
					vw_kindergarten_gotoClose = false;
				}
			
			}else{

			if(window.vw_kindergarten_responsiveMenu){
			}}}}
		}
	 	vw_kindergarten_checkfocusdElement();
	}
});

jQuery('document').ready(function($){
  setTimeout(function () {
		jQuery("#preloader").fadeOut("slow");
  },1000);
});

jQuery(document).ready(function () {
	jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 100) {
      jQuery('.scrollup i').fadeIn();
    } else {
      jQuery('.scrollup i').fadeOut();
    }
	});
	jQuery('.scrollup i').click(function () {
    jQuery("html, body").animate({
      scrollTop: 0
    }, 600);
    return false;
	});
});

jQuery(document).ready(function () {
	  function vw_kindergarten_search_loop_focus(element) {
	  var vw_kindergarten_focus = element.find('select, input, textarea, button, a[href]');
	  var vw_kindergarten_firstFocus = vw_kindergarten_focus[0];  
	  var vw_kindergarten_lastFocus = vw_kindergarten_focus[vw_kindergarten_focus.length - 1];
	  var KEYCODE_TAB = 9;

	  element.on('keydown', function vw_kindergarten_search_loop_focus(e) {
	    var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

	    if (!isTabPressed) { 
	      return; 
	    }

	    if ( e.shiftKey ) /* shift + tab */ {
	      if (document.activeElement === vw_kindergarten_firstFocus) {
	        vw_kindergarten_lastFocus.focus();
	          e.preventDefault();
	        }
	      } else /* tab */ {
	      if (document.activeElement === vw_kindergarten_lastFocus) {
	        vw_kindergarten_firstFocus.focus();
	          e.preventDefault();
	        }
	      }
	  });
	}
	jQuery('.search-box a').click(function(){
    jQuery(".serach_outer").slideDown(1000);
  	vw_kindergarten_search_loop_focus(jQuery('.serach_outer'));
  });

  jQuery('.closepop a').click(function(){
    jQuery(".serach_outer").slideUp(1000);
  });
});