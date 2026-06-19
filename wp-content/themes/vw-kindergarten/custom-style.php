<?php

	$vw_kindergarten_custom_css= "";

	/*--------------------- Global First Color --------------------*/

	$vw_kindergarten_first_color = get_theme_mod('vw_kindergarten_first_color');

	if($vw_kindergarten_first_color != false){
		$vw_kindergarten_custom_css .='.more-btn a:hover,input[type="submit"]:hover,#comments input[type="submit"]:hover,#comments a.comment-reply-link:hover,.pagination .current,.pagination a:hover,#footer .tagcloud a:hover,#sidebar .tagcloud a:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.widget_product_search button:hover,nav.woocommerce-MyAccount-navigation ul li:hover, .main-navigation ul.sub-menu>li>a:before, #slider, .slider-btn a:hover, .about-btn a:hover, .view-all-btn a:hover, .more-btn a:hover, #comments input[type="submit"]:hover,#comments a.comment-reply-link:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.pro-button a:hover, #preloader, #footer-2, .scrollup i, .pagination span, .pagination a, .widget_product_search button{';
			$vw_kindergarten_custom_css .='background-color: '.esc_attr($vw_kindergarten_first_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	if($vw_kindergarten_first_color != false){
		$vw_kindergarten_custom_css .='h1,h2,h3,h4,h5,h6, .post-main-box h2 a, .single-post .post-info:hover span a, .post-main-box:hover .post-info a,.middle-bar h6, .woocommerce div.product p.price, .woocommerce div.product span.price,.woocommerce ul.products li.product .price{';
			$vw_kindergarten_custom_css .='color: '.esc_attr($vw_kindergarten_first_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	/*--------------------- Global Second Color --------------------*/

	$vw_kindergarten_second_color = get_theme_mod('vw_kindergarten_second_color');

	if($vw_kindergarten_second_color != false){
		$vw_kindergarten_custom_css .='.social-icons p:nth-child(2) a, .social-icons p:nth-child(5) a, .search-box i, span.cart_no i, .slider-btn a, .about-btn a, .view-all-btn a,.more-btn a,#comments input[type="submit"],#comments a.comment-reply-link,input[type="submit"],.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,nav.woocommerce-MyAccount-navigation ul li,.pro-button a, .woocommerce a.added_to_cart.wc-forward, #about-sec h2:after, #about-sec .about-img .image-outerbox, #footer .wp-block-search .wp-block-search__button, #sidebar .wp-block-search .wp-block-search__button, #sidebar h3, .woocommerce span.onsale, .toggle-nav button, .bradcrumbs a:hover, .bradcrumbs span,.post-categories li a{';
			$vw_kindergarten_custom_css .='background-color: '.esc_attr($vw_kindergarten_second_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	if($vw_kindergarten_second_color != false){
		$vw_kindergarten_custom_css .='a, p.site-title a, .logo h1 a, .top-header a.phone i, .top-header a.email i, .main-navigation a:hover, #about-sec strong, .copyright a:hover, .post-main-box:hover h2 a, #footer .textwidget a,#footer li a:hover,.post-main-box:hover h3 a,#sidebar ul li a:hover,.post-navigation a:hover .post-title, .post-navigation a:focus .post-title,.post-navigation a:hover,.post-navigation a:focus{';
			$vw_kindergarten_custom_css .='color: '.esc_attr($vw_kindergarten_second_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	if($vw_kindergarten_second_color != false){
		$vw_kindergarten_custom_css .='.more-btn a:hover,input[type="submit"]:hover,#comments input[type="submit"]:hover,#comments a.comment-reply-link:hover,.pagination .current,.pagination a:hover,#footer .tagcloud a:hover,#sidebar .tagcloud a:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.widget_product_search button:hover,nav.woocommerce-MyAccount-navigation ul li:hover{';
			$vw_kindergarten_custom_css .='box-shadow: outset 0 0 0 2em '.esc_attr($vw_kindergarten_second_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	/*---------------------------Width Layout -------------------*/

	$vw_kindergarten_theme_lay = get_theme_mod( 'vw_kindergarten_width_option','Full Width');
    if($vw_kindergarten_theme_lay == 'Boxed'){
		$vw_kindergarten_custom_css .='body{';
			$vw_kindergarten_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_kindergarten_custom_css .='}';
	}else if($vw_kindergarten_theme_lay == 'Wide Width'){
		$vw_kindergarten_custom_css .='body{';
			$vw_kindergarten_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_kindergarten_custom_css .='}';
	}else if($vw_kindergarten_theme_lay == 'Full Width'){
		$vw_kindergarten_custom_css .='body{';
			$vw_kindergarten_custom_css .='max-width: 100%;';
		$vw_kindergarten_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$vw_kindergarten_theme_lay = get_theme_mod( 'vw_kindergarten_slider_opacity_color','0.3');
	if($vw_kindergarten_theme_lay == '0'){
		$vw_kindergarten_custom_css .='#slider img{';
			$vw_kindergarten_custom_css .='opacity:0';
		$vw_kindergarten_custom_css .='}';
		}else if($vw_kindergarten_theme_lay == '0.1'){
		$vw_kindergarten_custom_css .='#slider img{';
			$vw_kindergarten_custom_css .='opacity:0.1';
		$vw_kindergarten_custom_css .='}';
		}else if($vw_kindergarten_theme_lay == '0.2'){
		$vw_kindergarten_custom_css .='#slider img{';
			$vw_kindergarten_custom_css .='opacity:0.2';
		$vw_kindergarten_custom_css .='}';
		}else if($vw_kindergarten_theme_lay == '0.3'){
		$vw_kindergarten_custom_css .='#slider img{';
			$vw_kindergarten_custom_css .='opacity:0.3';
		$vw_kindergarten_custom_css .='}';
		}else if($vw_kindergarten_theme_lay == '0.4'){
		$vw_kindergarten_custom_css .='#slider img{';
			$vw_kindergarten_custom_css .='opacity:0.4';
		$vw_kindergarten_custom_css .='}';
		}else if($vw_kindergarten_theme_lay == '0.5'){
		$vw_kindergarten_custom_css .='#slider img{';
			$vw_kindergarten_custom_css .='opacity:0.5';
		$vw_kindergarten_custom_css .='}';
		}else if($vw_kindergarten_theme_lay == '0.6'){
		$vw_kindergarten_custom_css .='#slider img{';
			$vw_kindergarten_custom_css .='opacity:0.6';
		$vw_kindergarten_custom_css .='}';
		}else if($vw_kindergarten_theme_lay == '0.7'){
		$vw_kindergarten_custom_css .='#slider img{';
			$vw_kindergarten_custom_css .='opacity:0.7';
		$vw_kindergarten_custom_css .='}';
		}else if($vw_kindergarten_theme_lay == '0.8'){
		$vw_kindergarten_custom_css .='#slider img{';
			$vw_kindergarten_custom_css .='opacity:0.8';
		$vw_kindergarten_custom_css .='}';
		}else if($vw_kindergarten_theme_lay == '0.9'){
		$vw_kindergarten_custom_css .='#slider img{';
			$vw_kindergarten_custom_css .='opacity:0.9';
		$vw_kindergarten_custom_css .='}';
	}

	/*---------------------- Slider Image Overlay ------------------------*/

	$vw_kindergarten_slider_image_overlay = get_theme_mod('vw_kindergarten_slider_image_overlay', true);
	if($vw_kindergarten_slider_image_overlay == false){
		$vw_kindergarten_custom_css .='#slider img{';
			$vw_kindergarten_custom_css .='opacity:1;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_slider_image_overlay_color = get_theme_mod('vw_kindergarten_slider_image_overlay_color', true);
	if($vw_kindergarten_slider_image_overlay_color != false){
		$vw_kindergarten_custom_css .='#slider{';
			$vw_kindergarten_custom_css .='background-color: '.esc_attr($vw_kindergarten_slider_image_overlay_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	/*--------------------Slider Content Layout -------------------*/

	$vw_kindergarten_theme_lay = get_theme_mod( 'vw_kindergarten_slider_content_option','Left');
    if($vw_kindergarten_theme_lay == 'Left'){
		$vw_kindergarten_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_kindergarten_custom_css .='left:10%; right:45%; text-align:left;';
		$vw_kindergarten_custom_css .='}';
		$vw_kindergarten_custom_css .='@media screen and (min-width: 720px) and (max-width:768px){
		#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_kindergarten_custom_css .='right:30%;';
		$vw_kindergarten_custom_css .='} }';
		$vw_kindergarten_custom_css .='@media screen and (max-width:720px){
		#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_kindergarten_custom_css .='left:15%; right: 15%';
		$vw_kindergarten_custom_css .='} }';
	}else if($vw_kindergarten_theme_lay == 'Center'){
		$vw_kindergarten_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_kindergarten_custom_css .='text-align:center; left:30%; right:30%;';
		$vw_kindergarten_custom_css .='}';
	}else if($vw_kindergarten_theme_lay == 'Right'){
		$vw_kindergarten_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_kindergarten_custom_css .='left: 45%; right: 10%; text-align: right;';
		$vw_kindergarten_custom_css .='}';
		$vw_kindergarten_custom_css .='@media screen and (min-width: 720px) and (max-width:768px){
		#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_kindergarten_custom_css .='left:30%;';
		$vw_kindergarten_custom_css .='} }';
		$vw_kindergarten_custom_css .='@media screen and (max-width:720px){
		#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_kindergarten_custom_css .='left:15%; right: 15%';
		$vw_kindergarten_custom_css .='} }';
	}

	/*------------------ Slider Height ------------*/

	$vw_kindergarten_slider_height = get_theme_mod('vw_kindergarten_slider_height');
	if($vw_kindergarten_slider_height != false){
		$vw_kindergarten_custom_css .='#slider img{';
			$vw_kindergarten_custom_css .='height: '.esc_attr($vw_kindergarten_slider_height).';';
		$vw_kindergarten_custom_css .='}';
	}

	/*------------- Slider ------------*/

	$vw_kindergarten_slider = get_theme_mod('vw_kindergarten_slider_hide_show', false);
	if($vw_kindergarten_slider == false){
		$vw_kindergarten_custom_css .='.page-template-custom-home-page .main-header{';
			$vw_kindergarten_custom_css .='position: static;';
		$vw_kindergarten_custom_css .='}';
	}

	/*----------------Responsive Media -----------------------*/

	$vw_kindergarten_resp_slider = get_theme_mod( 'vw_kindergarten_resp_slider_hide_show',false);
	if($vw_kindergarten_resp_slider == true && get_theme_mod( 'vw_kindergarten_slider_hide_show', false) == false){
    	$vw_kindergarten_custom_css .='#slider{';
			$vw_kindergarten_custom_css .='display:none;';
		$vw_kindergarten_custom_css .='} ';
	}
    if($vw_kindergarten_resp_slider == true){
    	$vw_kindergarten_custom_css .='@media screen and (max-width:575px) {';
		$vw_kindergarten_custom_css .='#slider{';
			$vw_kindergarten_custom_css .='display:block;';
		$vw_kindergarten_custom_css .='} }';
	}else if($vw_kindergarten_resp_slider == false){
		$vw_kindergarten_custom_css .='@media screen and (max-width:575px) {';
		$vw_kindergarten_custom_css .='#slider{';
			$vw_kindergarten_custom_css .='display:none;';
		$vw_kindergarten_custom_css .='} }';
		$vw_kindergarten_custom_css .='@media screen and (max-width:575px){';
		$vw_kindergarten_custom_css .='.page-template-custom-home-page.admin-bar .homepageheader{';
			$vw_kindergarten_custom_css .='margin-top: 45px;';
		$vw_kindergarten_custom_css .='} }';
	}

	$vw_kindergarten_resp_sidebar = get_theme_mod( 'vw_kindergarten_sidebar_hide_show',true);
    if($vw_kindergarten_resp_sidebar == true){
    	$vw_kindergarten_custom_css .='@media screen and (max-width:575px) {';
		$vw_kindergarten_custom_css .='#sidebar{';
			$vw_kindergarten_custom_css .='display:block;';
		$vw_kindergarten_custom_css .='} }';
	}else if($vw_kindergarten_resp_sidebar == false){
		$vw_kindergarten_custom_css .='@media screen and (max-width:575px) {';
		$vw_kindergarten_custom_css .='#sidebar{';
			$vw_kindergarten_custom_css .='display:none;';
		$vw_kindergarten_custom_css .='} }';
	}

	$vw_kindergarten_resp_scroll_top = get_theme_mod( 'vw_kindergarten_resp_scroll_top_hide_show',true);
	if($vw_kindergarten_resp_scroll_top == true && get_theme_mod( 'vw_kindergarten_hide_show_scroll',true) == false){
    	$vw_kindergarten_custom_css .='.scrollup i{';
			$vw_kindergarten_custom_css .='visibility:hidden !important;';
		$vw_kindergarten_custom_css .='} ';
	}
    if($vw_kindergarten_resp_scroll_top == true){
    	$vw_kindergarten_custom_css .='@media screen and (max-width:575px) {';
		$vw_kindergarten_custom_css .='.scrollup i{';
			$vw_kindergarten_custom_css .='visibility:visible !important;';
		$vw_kindergarten_custom_css .='} }';
	}else if($vw_kindergarten_resp_scroll_top == false){
		$vw_kindergarten_custom_css .='@media screen and (max-width:575px){';
		$vw_kindergarten_custom_css .='.scrollup i{';
			$vw_kindergarten_custom_css .='visibility:hidden !important;';
		$vw_kindergarten_custom_css .='} }';
	}

	$vw_kindergarten_resp_menu_toggle_btn_bg_color = get_theme_mod('vw_kindergarten_resp_menu_toggle_btn_bg_color');
	if($vw_kindergarten_resp_menu_toggle_btn_bg_color != false){
		$vw_kindergarten_custom_css .='.toggle-nav button{';
			$vw_kindergarten_custom_css .='background: '.esc_attr($vw_kindergarten_resp_menu_toggle_btn_bg_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	/*-------------- Menus Settings ----------------*/


	$vw_kindergarten_navigation_menu_font_size = get_theme_mod('vw_kindergarten_navigation_menu_font_size');
	if($vw_kindergarten_navigation_menu_font_size != false){
		$vw_kindergarten_custom_css .='.main-navigation a{';
			$vw_kindergarten_custom_css .='font-size: '.esc_attr($vw_kindergarten_navigation_menu_font_size).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_navigation_menu_font_weight = get_theme_mod('vw_kindergarten_navigation_menu_font_weight','500');
	if($vw_kindergarten_navigation_menu_font_weight != false){
		$vw_kindergarten_custom_css .='.main-navigation a{';
			$vw_kindergarten_custom_css .='font-weight: '.esc_attr($vw_kindergarten_navigation_menu_font_weight).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_theme_lay = get_theme_mod( 'vw_kindergarten_menu_text_transform','Capitalize');
	if($vw_kindergarten_theme_lay == 'Capitalize'){
		$vw_kindergarten_custom_css .='.main-navigation a{';
			$vw_kindergarten_custom_css .='text-transform:Capitalize;';
		$vw_kindergarten_custom_css .='}';
	}
	if($vw_kindergarten_theme_lay == 'Lowercase'){
		$vw_kindergarten_custom_css .='.main-navigation a{';
			$vw_kindergarten_custom_css .='text-transform:Lowercase;';
		$vw_kindergarten_custom_css .='}';
	}
	if($vw_kindergarten_theme_lay == 'Uppercase'){
		$vw_kindergarten_custom_css .='.main-navigation a{';
			$vw_kindergarten_custom_css .='text-transform:Uppercase;';
		$vw_kindergarten_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_kindergarten_theme_lay = get_theme_mod( 'vw_kindergarten_blog_layout_option','Default');
    if($vw_kindergarten_theme_lay == 'Default'){
		$vw_kindergarten_custom_css .='.post-main-box{';
			$vw_kindergarten_custom_css .='';
		$vw_kindergarten_custom_css .='}';
	}else if($vw_kindergarten_theme_lay == 'Center'){
		$vw_kindergarten_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn{';
			$vw_kindergarten_custom_css .='text-align:center;';
		$vw_kindergarten_custom_css .='}';
		$vw_kindergarten_custom_css .='.post-info{';
			$vw_kindergarten_custom_css .='margin-top:10px;';
		$vw_kindergarten_custom_css .='}';
		$vw_kindergarten_custom_css .='.post-info hr{';
			$vw_kindergarten_custom_css .='margin:15px auto;';
		$vw_kindergarten_custom_css .='}';
	}else if($vw_kindergarten_theme_lay == 'Left'){
		$vw_kindergarten_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn, #our-services p{';
			$vw_kindergarten_custom_css .='text-align:Left;';
		$vw_kindergarten_custom_css .='}';
		$vw_kindergarten_custom_css .='.post-info hr{';
			$vw_kindergarten_custom_css .='margin-bottom:10px;';
		$vw_kindergarten_custom_css .='}';
		$vw_kindergarten_custom_css .='.post-main-box h2{';
			$vw_kindergarten_custom_css .='margin-top:10px;';
		$vw_kindergarten_custom_css .='}';
	}

	/*--------------------- Blog Page Posts -------------------*/

	$vw_kindergarten_blog_page_posts_settings = get_theme_mod( 'vw_kindergarten_blog_page_posts_settings','Into Blocks');
		if($vw_kindergarten_blog_page_posts_settings == 'Without Blocks'){
		$vw_kindergarten_custom_css .='.post-main-box{';
			$vw_kindergarten_custom_css .='box-shadow: none; border: none; margin:30px 0;';
		$vw_kindergarten_custom_css .='}';
	}

	// featured image dimention
	$vw_kindergarten_blog_post_featured_image_dimension = get_theme_mod('vw_kindergarten_blog_post_featured_image_dimension', 'default');
	$vw_kindergarten_blog_post_featured_image_custom_width = get_theme_mod('vw_kindergarten_blog_post_featured_image_custom_width',250);
	$vw_kindergarten_blog_post_featured_image_custom_height = get_theme_mod('vw_kindergarten_blog_post_featured_image_custom_height',250);
	if($vw_kindergarten_blog_post_featured_image_dimension == 'custom'){
		$vw_kindergarten_custom_css .='.post-main-box img{';
			$vw_kindergarten_custom_css .='width: '.esc_attr($vw_kindergarten_blog_post_featured_image_custom_width).'; height: '.esc_attr($vw_kindergarten_blog_post_featured_image_custom_height).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_featured_image_border_radius = get_theme_mod('vw_kindergarten_featured_image_border_radius', 0);
	if($vw_kindergarten_featured_image_border_radius != false){
		$vw_kindergarten_custom_css .='.box-image img, .feature-box img{';
			$vw_kindergarten_custom_css .='border-radius: '.esc_attr($vw_kindergarten_featured_image_border_radius).'px;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_featured_image_box_shadow = get_theme_mod('vw_kindergarten_featured_image_box_shadow',0);
	if($vw_kindergarten_featured_image_box_shadow != false){
		$vw_kindergarten_custom_css .='.box-image img, .feature-box img, #content-vw img{';
			$vw_kindergarten_custom_css .='box-shadow: '.esc_attr($vw_kindergarten_featured_image_box_shadow).'px '.esc_attr($vw_kindergarten_featured_image_box_shadow).'px '.esc_attr($vw_kindergarten_featured_image_box_shadow).'px #cccccc;';
		$vw_kindergarten_custom_css .='}';
	}
	
	/*---------------- Button Settings ------------------*/

	$vw_kindergarten_button_border_radius = get_theme_mod('vw_kindergarten_button_border_radius');
	if($vw_kindergarten_button_border_radius != false){
		$vw_kindergarten_custom_css .='.post-main-box .more-btn a{';
			$vw_kindergarten_custom_css .='border-radius: '.esc_attr($vw_kindergarten_button_border_radius).'px;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_button_padding_top_bottom = get_theme_mod('vw_kindergarten_button_padding_top_bottom');
	$vw_kindergarten_button_padding_left_right = get_theme_mod('vw_kindergarten_button_padding_left_right');
	if($vw_kindergarten_button_padding_top_bottom != false || $vw_kindergarten_button_padding_left_right != false){
		$vw_kindergarten_custom_css .='.post-main-box .more-btn a{';
			$vw_kindergarten_custom_css .='padding-top: '.esc_attr($vw_kindergarten_button_padding_top_bottom).'!important; padding-bottom: '.esc_attr($vw_kindergarten_button_padding_top_bottom).'!important;padding-left: '.esc_attr($vw_kindergarten_button_padding_left_right).'!important;padding-right: '.esc_attr($vw_kindergarten_button_padding_left_right).'!important;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_button_font_size = get_theme_mod('vw_kindergarten_button_font_size',14);
	$vw_kindergarten_custom_css .='.post-main-box .more-btn a{';
		$vw_kindergarten_custom_css .='font-size: '.esc_attr($vw_kindergarten_button_font_size).';';
	$vw_kindergarten_custom_css .='}';

	$vw_kindergarten_theme_lay = get_theme_mod( 'vw_kindergarten_button_text_transform','Uppercase');
	if($vw_kindergarten_theme_lay == 'Capitalize'){
		$vw_kindergarten_custom_css .='.post-main-box .more-btn a{';
			$vw_kindergarten_custom_css .='text-transform:Capitalize;';
		$vw_kindergarten_custom_css .='}';
	}
	if($vw_kindergarten_theme_lay == 'Lowercase'){
		$vw_kindergarten_custom_css .='.post-main-box .more-btn a{';
			$vw_kindergarten_custom_css .='text-transform:Lowercase;';
		$vw_kindergarten_custom_css .='}';
	}
	if($vw_kindergarten_theme_lay == 'Uppercase'){ 
		$vw_kindergarten_custom_css .='.post-main-box .more-btn a{';
			$vw_kindergarten_custom_css .='text-transform:Uppercase;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_button_letter_spacing = get_theme_mod('vw_kindergarten_button_letter_spacing',14);
	$vw_kindergarten_custom_css .='.post-main-box .more-btn a{';
		$vw_kindergarten_custom_css .='letter-spacing: '.esc_attr($vw_kindergarten_button_letter_spacing).';';
	$vw_kindergarten_custom_css .='}';
	
	/*---------------- Single Blog Page Settings ------------------*/

	$vw_kindergarten_single_blog_comment_title = get_theme_mod('vw_kindergarten_single_blog_comment_title', 'Leave a Reply');
	if($vw_kindergarten_single_blog_comment_title == ''){
		$vw_kindergarten_custom_css .='#comments h2#reply-title {';
			$vw_kindergarten_custom_css .='display: none;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_single_blog_comment_button_text = get_theme_mod('vw_kindergarten_single_blog_comment_button_text', 'Post Comment');
	if($vw_kindergarten_single_blog_comment_button_text == ''){
		$vw_kindergarten_custom_css .='#comments p.form-submit {';
			$vw_kindergarten_custom_css .='display: none;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_comment_width = get_theme_mod('vw_kindergarten_single_blog_comment_width');
	if($vw_kindergarten_comment_width != false){
		$vw_kindergarten_custom_css .='#comments textarea{';
			$vw_kindergarten_custom_css .='width: '.esc_attr($vw_kindergarten_comment_width).';';
		$vw_kindergarten_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_kindergarten_footer_widgets_heading = get_theme_mod( 'vw_kindergarten_footer_widgets_heading','Left');
    if($vw_kindergarten_footer_widgets_heading == 'Left'){
		$vw_kindergarten_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label{';
		$vw_kindergarten_custom_css .='text-align: left;';
		$vw_kindergarten_custom_css .='}';
	}else if($vw_kindergarten_footer_widgets_heading == 'Center'){
		$vw_kindergarten_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label{';
			$vw_kindergarten_custom_css .='text-align: center;';
		$vw_kindergarten_custom_css .='}';
	}else if($vw_kindergarten_footer_widgets_heading == 'Right'){
		$vw_kindergarten_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label{';
			$vw_kindergarten_custom_css .='text-align: right;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_footer_widgets_content = get_theme_mod( 'vw_kindergarten_footer_widgets_content','Left');
    if($vw_kindergarten_footer_widgets_content == 'Left'){
		$vw_kindergarten_custom_css .='#footer .widget{';
		$vw_kindergarten_custom_css .='text-align: left;';
		$vw_kindergarten_custom_css .='}';
	}else if($vw_kindergarten_footer_widgets_content == 'Center'){
		$vw_kindergarten_custom_css .='#footer .widget{';
			$vw_kindergarten_custom_css .='text-align: center;';
		$vw_kindergarten_custom_css .='}';
	}else if($vw_kindergarten_footer_widgets_content == 'Right'){
		$vw_kindergarten_custom_css .='#footer .widget{';
			$vw_kindergarten_custom_css .='text-align: right;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_copyright_alingment = get_theme_mod('vw_kindergarten_copyright_alingment');
	if($vw_kindergarten_copyright_alingment != false){
		$vw_kindergarten_custom_css .='.copyright p{';
			$vw_kindergarten_custom_css .='text-align: '.esc_attr($vw_kindergarten_copyright_alingment).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_footer_padding = get_theme_mod('vw_kindergarten_footer_padding');
	if($vw_kindergarten_footer_padding != false){
		$vw_kindergarten_custom_css .='#footer{';
			$vw_kindergarten_custom_css .='padding: '.esc_attr($vw_kindergarten_footer_padding).' 0;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_footer_icon = get_theme_mod('vw_kindergarten_footer_icon');
	if($vw_kindergarten_footer_icon == false){
		$vw_kindergarten_custom_css .='.copyright p{';
			$vw_kindergarten_custom_css .='width:100%; text-align:center; float:none;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_footer_background_image = get_theme_mod('vw_kindergarten_footer_background_image');
	if($vw_kindergarten_footer_background_image != false){
		$vw_kindergarten_custom_css .='#footer{';
			$vw_kindergarten_custom_css .='background: url('.esc_attr($vw_kindergarten_footer_background_image).');';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_footer_background_color = get_theme_mod('vw_kindergarten_footer_background_color');
	if($vw_kindergarten_footer_background_color != false){
		$vw_kindergarten_custom_css .='#footer{';
			$vw_kindergarten_custom_css .='background-color: '.esc_attr($vw_kindergarten_footer_background_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_theme_lay = get_theme_mod( 'vw_kindergarten_img_footer','scroll');
	if($vw_kindergarten_theme_lay == 'fixed'){
		$vw_kindergarten_custom_css .='#footer{';
			$vw_kindergarten_custom_css .='background-attachment: fixed !important;';
		$vw_kindergarten_custom_css .='}';
	}elseif ($vw_kindergarten_theme_lay == 'scroll'){
		$vw_kindergarten_custom_css .='#footer{';
			$vw_kindergarten_custom_css .='background-attachment: scroll !important;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_footer_img_position = get_theme_mod('vw_kindergarten_footer_img_position','center center');
	if($vw_kindergarten_footer_img_position != false){
		$vw_kindergarten_custom_css .='#footer{';
			$vw_kindergarten_custom_css .='background-position: '.esc_attr($vw_kindergarten_footer_img_position).'!important;';
		$vw_kindergarten_custom_css .='}';
	} 

	$vw_kindergarten_copyright_background_color = get_theme_mod('vw_kindergarten_copyright_background_color');
	if($vw_kindergarten_copyright_background_color != false){
		$vw_kindergarten_custom_css .='#footer-2{';
			$vw_kindergarten_custom_css .='background-color: '.esc_attr($vw_kindergarten_copyright_background_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	/*----------------Woocommerce Products Settings ------------------*/

	$vw_kindergarten_related_product_show_hide = get_theme_mod('vw_kindergarten_related_product_show_hide',true);
	if($vw_kindergarten_related_product_show_hide != true){
		$vw_kindergarten_custom_css .='.related.products{';
			$vw_kindergarten_custom_css .='display: none;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_products_btn_padding_top_bottom = get_theme_mod('vw_kindergarten_products_btn_padding_top_bottom');
	if($vw_kindergarten_products_btn_padding_top_bottom != false){
		$vw_kindergarten_custom_css .='.woocommerce a.button{';
			$vw_kindergarten_custom_css .='padding-top: '.esc_attr($vw_kindergarten_products_btn_padding_top_bottom).' !important; padding-bottom: '.esc_attr($vw_kindergarten_products_btn_padding_top_bottom).' !important;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_products_btn_padding_left_right = get_theme_mod('vw_kindergarten_products_btn_padding_left_right');
	if($vw_kindergarten_products_btn_padding_left_right != false){
		$vw_kindergarten_custom_css .='.woocommerce a.button{';
			$vw_kindergarten_custom_css .='padding-left: '.esc_attr($vw_kindergarten_products_btn_padding_left_right).' !important; padding-right: '.esc_attr($vw_kindergarten_products_btn_padding_left_right).' !important;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_woocommerce_sale_position = get_theme_mod( 'vw_kindergarten_woocommerce_sale_position','left');
    if($vw_kindergarten_woocommerce_sale_position == 'left'){
		$vw_kindergarten_custom_css .='.woocommerce ul.products li.product .onsale{';
			$vw_kindergarten_custom_css .='left: -10px; right: auto;';
		$vw_kindergarten_custom_css .='}';
	}else if($vw_kindergarten_woocommerce_sale_position == 'right'){
		$vw_kindergarten_custom_css .='.woocommerce ul.products li.product .onsale{';
			$vw_kindergarten_custom_css .='left: auto !important; right: 15px !important;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_woocommerce_sale_font_size = get_theme_mod('vw_kindergarten_woocommerce_sale_font_size');
	if($vw_kindergarten_woocommerce_sale_font_size != false){
		$vw_kindergarten_custom_css .='.woocommerce span.onsale{';
			$vw_kindergarten_custom_css .='font-size: '.esc_attr($vw_kindergarten_woocommerce_sale_font_size).';';
		$vw_kindergarten_custom_css .='}';
	}

	/*------------------ Logo  -------------------*/

	$vw_kindergarten_logo_padding = get_theme_mod('vw_kindergarten_logo_padding');
	if($vw_kindergarten_logo_padding != false){
		$vw_kindergarten_custom_css .='.main-header .logo{';
			$vw_kindergarten_custom_css .='padding: '.esc_attr($vw_kindergarten_logo_padding).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_logo_margin = get_theme_mod('vw_kindergarten_logo_margin');
	if($vw_kindergarten_logo_margin != false){
		$vw_kindergarten_custom_css .='.main-header .logo{';
			$vw_kindergarten_custom_css .='margin: '.esc_attr($vw_kindergarten_logo_margin).';';
		$vw_kindergarten_custom_css .='}';
	}

	// Site title Font Size
	$vw_kindergarten_site_title_font_size = get_theme_mod('vw_kindergarten_site_title_font_size');
	if($vw_kindergarten_site_title_font_size != false){
		$vw_kindergarten_custom_css .='.logo h1, .logo p.site-title{';
			$vw_kindergarten_custom_css .='font-size: '.esc_attr($vw_kindergarten_site_title_font_size).';';
		$vw_kindergarten_custom_css .='}';
	}

	// Site tagline Font Size
	$vw_kindergarten_site_tagline_font_size = get_theme_mod('vw_kindergarten_site_tagline_font_size');
	if($vw_kindergarten_site_tagline_font_size != false){
		$vw_kindergarten_custom_css .='.logo p.site-description{';
			$vw_kindergarten_custom_css .='font-size: '.esc_attr($vw_kindergarten_site_tagline_font_size).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_site_title_color = get_theme_mod('vw_kindergarten_site_title_color');
	if($vw_kindergarten_site_title_color != false){
		$vw_kindergarten_custom_css .='p.site-title a{';
			$vw_kindergarten_custom_css .='color: '.esc_attr($vw_kindergarten_site_title_color).'!important;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_site_tagline_color = get_theme_mod('vw_kindergarten_site_tagline_color');
	if($vw_kindergarten_site_tagline_color != false){
		$vw_kindergarten_custom_css .='.logo p.site-description{';
			$vw_kindergarten_custom_css .='color: '.esc_attr($vw_kindergarten_site_tagline_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_logo_width = get_theme_mod('vw_kindergarten_logo_width');
	if($vw_kindergarten_logo_width != false){
		$vw_kindergarten_custom_css .='.logo img{';
			$vw_kindergarten_custom_css .='width: '.esc_attr($vw_kindergarten_logo_width).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_logo_height = get_theme_mod('vw_kindergarten_logo_height');
	if($vw_kindergarten_logo_height != false){
		$vw_kindergarten_custom_css .='.logo img{';
			$vw_kindergarten_custom_css .='height: '.esc_attr($vw_kindergarten_logo_height).';';
		$vw_kindergarten_custom_css .='}';
	}

	// Woocommerce img

	$vw_kindergarten_shop_featured_image_border_radius = get_theme_mod('vw_kindergarten_shop_featured_image_border_radius', 0);
	if($vw_kindergarten_shop_featured_image_border_radius != false){
		$vw_kindergarten_custom_css .='.woocommerce ul.products li.product a img{';
			$vw_kindergarten_custom_css .='border-radius: '.esc_attr($vw_kindergarten_shop_featured_image_border_radius).'px;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_shop_featured_image_box_shadow = get_theme_mod('vw_kindergarten_shop_featured_image_box_shadow');
	if($vw_kindergarten_shop_featured_image_box_shadow != false){
		$vw_kindergarten_custom_css .='.woocommerce ul.products li.product a img{';
				$vw_kindergarten_custom_css .='box-shadow: '.esc_attr($vw_kindergarten_shop_featured_image_box_shadow).'px '.esc_attr($vw_kindergarten_shop_featured_image_box_shadow).'px '.esc_attr($vw_kindergarten_shop_featured_image_box_shadow).'px #ddd;';
		$vw_kindergarten_custom_css .='}';
	}

	// menus

	$vw_kindergarten_header_menus_color = get_theme_mod('vw_kindergarten_header_menus_color');
	if($vw_kindergarten_header_menus_color != false){
		$vw_kindergarten_custom_css .='.main-navigation a{';
			$vw_kindergarten_custom_css .='color: '.esc_attr($vw_kindergarten_header_menus_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_header_menus_hover_color = get_theme_mod('vw_kindergarten_header_menus_hover_color');
	if($vw_kindergarten_header_menus_hover_color != false){
		$vw_kindergarten_custom_css .='.main-navigation a:hover{';
			$vw_kindergarten_custom_css .='color: '.esc_attr($vw_kindergarten_header_menus_hover_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_header_submenus_color = get_theme_mod('vw_kindergarten_header_submenus_color');
	if($vw_kindergarten_header_submenus_color != false){
		$vw_kindergarten_custom_css .='.main-navigation ul ul a{';
			$vw_kindergarten_custom_css .='color: '.esc_attr($vw_kindergarten_header_submenus_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_header_submenus_hover_color = get_theme_mod('vw_kindergarten_header_submenus_hover_color');
	if($vw_kindergarten_header_submenus_hover_color != false){
		$vw_kindergarten_custom_css .='.main-navigation ul.sub-menu a:hover{';
			$vw_kindergarten_custom_css .='color: '.esc_attr($vw_kindergarten_header_submenus_hover_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_menus_item = get_theme_mod( 'vw_kindergarten_menus_item_style','None');
    if($vw_kindergarten_menus_item == 'None'){
		$vw_kindergarten_custom_css .='.main-navigation a{';
			$vw_kindergarten_custom_css .='';
		$vw_kindergarten_custom_css .='}';
	}else if($vw_kindergarten_menus_item == 'Zoom In'){
		$vw_kindergarten_custom_css .='.main-navigation a:hover{';
			$vw_kindergarten_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important; color: #fe598b;';
		$vw_kindergarten_custom_css .='}';
	}

	/*------------------ Preloader Background Color  -------------------*/

	$vw_kindergarten_preloader_bg_color = get_theme_mod('vw_kindergarten_preloader_bg_color');
	if($vw_kindergarten_preloader_bg_color != false){
		$vw_kindergarten_custom_css .='#preloader{';
			$vw_kindergarten_custom_css .='background-color: '.esc_attr($vw_kindergarten_preloader_bg_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_preloader_border_color = get_theme_mod('vw_kindergarten_preloader_border_color');
	if($vw_kindergarten_preloader_border_color != false){
		$vw_kindergarten_custom_css .='.loader-line{';
			$vw_kindergarten_custom_css .='border-color: '.esc_attr($vw_kindergarten_preloader_border_color).'!important;';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_preloader_bg_img = get_theme_mod('vw_kindergarten_preloader_bg_img');
	if($vw_kindergarten_preloader_bg_img != false){
		$vw_kindergarten_custom_css .='#preloader{';
			$vw_kindergarten_custom_css .='background: url('.esc_attr($vw_kindergarten_preloader_bg_img).');-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;';
		$vw_kindergarten_custom_css .='}';
	}

	// Header Background Color

	$vw_kindergarten_header_background_color = get_theme_mod('vw_kindergarten_header_background_color');
	if($vw_kindergarten_header_background_color != false){
		$vw_kindergarten_custom_css .='.main-header{';
			$vw_kindergarten_custom_css .='background-color: '.esc_attr($vw_kindergarten_header_background_color).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_single_blog_post_navigation_show_hide = get_theme_mod('vw_kindergarten_single_blog_post_navigation_show_hide',true);
	if($vw_kindergarten_single_blog_post_navigation_show_hide != true){
		$vw_kindergarten_custom_css .='.post-navigation{';
			$vw_kindergarten_custom_css .='display: none;';
		$vw_kindergarten_custom_css .='}';
	}

	/*----------------Sroll to top Settings ------------------*/

	$vw_kindergarten_scroll_to_top_font_size = get_theme_mod('vw_kindergarten_scroll_to_top_font_size');
	if($vw_kindergarten_scroll_to_top_font_size != false){
		$vw_kindergarten_custom_css .='.scrollup i{';
			$vw_kindergarten_custom_css .='font-size: '.esc_attr($vw_kindergarten_scroll_to_top_font_size).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_scroll_to_top_padding = get_theme_mod('vw_kindergarten_scroll_to_top_padding');
	$vw_kindergarten_scroll_to_top_padding = get_theme_mod('vw_kindergarten_scroll_to_top_padding');
	if($vw_kindergarten_scroll_to_top_padding != false){
		$vw_kindergarten_custom_css .='.scrollup i{';
			$vw_kindergarten_custom_css .='padding-top: '.esc_attr($vw_kindergarten_scroll_to_top_padding).';padding-bottom: '.esc_attr($vw_kindergarten_scroll_to_top_padding).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_scroll_to_top_width = get_theme_mod('vw_kindergarten_scroll_to_top_width');
	if($vw_kindergarten_scroll_to_top_width != false){
		$vw_kindergarten_custom_css .='.scrollup i{';
			$vw_kindergarten_custom_css .='width: '.esc_attr($vw_kindergarten_scroll_to_top_width).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_scroll_to_top_height = get_theme_mod('vw_kindergarten_scroll_to_top_height');
	if($vw_kindergarten_scroll_to_top_height != false){
		$vw_kindergarten_custom_css .='.scrollup i{';
			$vw_kindergarten_custom_css .='height: '.esc_attr($vw_kindergarten_scroll_to_top_height).';';
		$vw_kindergarten_custom_css .='}';
	}

	$vw_kindergarten_scroll_to_top_border_radius = get_theme_mod('vw_kindergarten_scroll_to_top_border_radius');
	if($vw_kindergarten_scroll_to_top_border_radius != false){
		$vw_kindergarten_custom_css .='.scrollup i{';
			$vw_kindergarten_custom_css .='border-radius: '.esc_attr($vw_kindergarten_scroll_to_top_border_radius).'px;';
		$vw_kindergarten_custom_css .='}';
	}

