<?php
/**
 * @package Car Service
 * Setup the WordPress core custom header feature.
 *
 * @uses car_service_header_style()
 */
function car_service_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'car_service_custom_header_args', array(		
		'default-text-color'     => 'fff',
		'width'                  => 1400,
		'height'                 => 280,
		'wp-head-callback'       => 'car_service_header_style',		
	) ) );
}
add_action( 'after_setup_theme', 'car_service_custom_header_setup' );

if ( ! function_exists( 'car_service_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see car_service_custom_header_setup().
 */
function car_service_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		.header {
			background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat;
			background-position: center top;
		}
	<?php endif; ?>	



	h1.site-title a {
		color: <?php echo esc_attr(get_theme_mod('car_service_sitetitle_col')); ?>;
	}

	span.site-description {
		color: <?php echo esc_attr(get_theme_mod('car_service_sitetagline_col')); ?>;
	}



	#mySidenav nav#site-navigation {
		background: <?php echo esc_attr(get_theme_mod('car_service_headerbg_col')); ?>;
	}

	.main-nav a {
		color: <?php echo esc_attr(get_theme_mod('car_service_headermenus_col')); ?>;
	}

	.main-nav a:hover {
		color: <?php echo esc_attr(get_theme_mod('car_service_headermenushover_col')); ?>;
	}

	.main-nav ul ul a {
		color: <?php echo esc_attr(get_theme_mod('car_service_headersubmenus_col')); ?>;
	}

	.main-nav ul ul a:hover {
		color: <?php echo esc_attr(get_theme_mod('car_service_headersubmenushover_col')); ?>;
	}

	.main-nav ul ul {
		background: <?php echo esc_attr(get_theme_mod('car_service_headersubmenusbg_col')); ?>;
	}

	.main-nav ul ul li {
		border-color: <?php echo esc_attr(get_theme_mod('car_service_headersubmenusborder_col')); ?>;
	}

	.page-template-template-home-page .header.sticky-head, .admin-bar .sticky-head {
		background: <?php echo esc_attr(get_theme_mod('car_service_headerstickybg_col')); ?>;
	}







	#head-banner {
		background: <?php echo esc_attr(get_theme_mod('car_service_sliderbg_col')); ?>;
	}

	.content-inner-box span {
		color: <?php echo esc_attr(get_theme_mod('car_service_slidertitle_col')); ?>;
	}

	#head-banner .content-inner-box h1 a {
		color: <?php echo esc_attr(get_theme_mod('car_service_sliderheading_col')); ?>;
	}

	.content-inner-box p {
		color: <?php echo esc_attr(get_theme_mod('car_service_sliderdescription_col')); ?>;
	}

	.banner-btn a {
		background: <?php echo esc_attr(get_theme_mod('car_service_sliderbutton_col')); ?>;
	}

	.banner-btn a {
		color: <?php echo esc_attr(get_theme_mod('car_service_sliderbuttontext_col')); ?>;
	}

	.banner-btn a:hover {
		color: <?php echo esc_attr(get_theme_mod('car_service_sliderbuttontexthover_col')); ?>;
	}

	.banner-btn a:hover {
		background: <?php echo esc_attr(get_theme_mod('car_service_sliderbuttonhover_col')); ?>;
	}


	.circle-one {
		background: <?php echo esc_attr(get_theme_mod('car_service_slidercircleone_col')); ?>;
	}

	.circle-two {
		background: <?php echo esc_attr(get_theme_mod('car_service_slidercircletwo_col')); ?>;
	}

	.circle-three {
		background: <?php echo esc_attr(get_theme_mod('car_service_slidercirclethree_col')); ?>;
	}








	.text-inner-box h3 {
		color: <?php echo esc_attr(get_theme_mod('car_service_abouttitle_col')); ?>;
	}

	.text-inner-box p {
		color: <?php echo esc_attr(get_theme_mod('car_service_aboutdescription_col')); ?>;
	}

	.serv-btn a {
		background: <?php echo esc_attr(get_theme_mod('car_service_aboutbutton_col')); ?>;
	}

	.serv-btn a {
		color: <?php echo esc_attr(get_theme_mod('car_service_aboutbuttontext_col')); ?>;
	}

	.serv-btn a:hover {
		background: <?php echo esc_attr(get_theme_mod('car_service_aboutbuttonhover_col')); ?>;
	}



	#footer .copywrap{
		background-color: <?php echo esc_attr(get_theme_mod('car_service_footercoyprightbg_col')); ?>;
	}

	#footer .copywrap a {
		color: <?php echo esc_attr(get_theme_mod('car_service_footercoypright_col')); ?>;
	}

	#footer .copywrap a:hover {
		color: <?php echo esc_attr(get_theme_mod('car_service_footercopyrighthover_col')); ?>;
	}

	#footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6 {
		color: <?php echo esc_attr(get_theme_mod('car_service_footerheading_col')); ?>;
	}

	#footer p {
		color: <?php echo esc_attr(get_theme_mod('car_service_footerdescription_col')); ?>;
	}

	.ftr-4-box ul li a {
		color: <?php echo esc_attr(get_theme_mod('car_service_footerlist_col')); ?>;
	}

	.ftr-4-box ul li {
		border-color: <?php echo esc_attr(get_theme_mod('car_service_footerlistborder_col')); ?>;
	}

	.ftr-4-box ul li a:hover {
		color: <?php echo esc_attr(get_theme_mod('car_service_footerlisthover_col')); ?>;
	}

	#footer,.copywrap {
		background: <?php echo esc_attr(get_theme_mod('car_service_footerbg_col')); ?>;
	}

	




	</style>
	<?php 
}
endif;