<?php
/**
 * @package Classic Internet Services
 * Setup the WordPress core custom header feature.
 *
 * @uses classic_internet_services_header_style()
 */
function classic_internet_services_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'classic_internet_services_custom_header_args', array(		
		'default-text-color'     => 'fff',
		'width'                  => 1400,
		'height'                 => 280,
		'wp-head-callback'       => 'classic_internet_services_header_style',		
	) ) );
}
add_action( 'after_setup_theme', 'classic_internet_services_custom_header_setup' );

if ( ! function_exists( 'classic_internet_services_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see classic_internet_services_custom_header_setup().
 */
function classic_internet_services_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		.bg-inner {
			background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat;
			background-position: center top;background-size: 100% 100%;
		}
	<?php endif; ?>	



	h1.site-title a {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_sitetitle_color')); ?>;
	}

	.header-top p {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_sitetagline_color')); ?>;
	}




	.header-top {
		background: <?php echo esc_attr(get_theme_mod('classic_internet_services_topheaderbg_color')); ?>;
	    opacity: 0.7;
	}

	.header-top .fa-user {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_header_accounticon_col')); ?>;
	}

	.header-top .fa-shopping-basket {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_header_carticon_col')); ?>;
	}

	.bg-inner {
		background: <?php echo esc_attr(get_theme_mod('classic_internet_services_header_bottombg_col')); ?>;
	}

	.main-nav a {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_header_menus_col')); ?>;
	}

	.main-nav a:hover {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_header_menushov_col')); ?>;
	}

	.main-nav li:hover {
		background: <?php echo esc_attr(get_theme_mod('classic_internet_services_header_menushover1_col')); ?>;
	}

	.main-nav ul ul {
		background: <?php echo esc_attr(get_theme_mod('classic_internet_services_header_submenubg1_col')); ?>;
	}

	.main-nav ul ul a {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_header_submenu_col')); ?>;
	}

	.main-nav ul ul a:hover {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_header_submenuhover_col')); ?>;
	}

	.slider-box span {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_slider_shorttext_col')); ?>;
	}

	.slider-box h3 {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_slider_title_col')); ?>;
	}

	.slider-box p {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_slider_description_col')); ?>;
	}

	.slider-box .pagemore a {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_slider_buttontext_col')); ?>;
	}

	.slider-box .pagemore a {
		background: <?php echo esc_attr(get_theme_mod('classic_internet_services_slider_buttonbg_col')); ?>;
	}

	.slider-box .pagemore a:hover {
		background: <?php echo esc_attr(get_theme_mod('classic_internet_services_slider_buttonbghover_col')); ?>;
	}

	.slidesection {
		background: <?php echo esc_attr(get_theme_mod('classic_internet_services_slider_bg1_col')); ?>;
	}

	.owl-prev, .owl-next {
		border-color: <?php echo esc_attr(get_theme_mod('classic_internet_services_slider_arrow_col')); ?>;
	}

	button.owl-prev span, button.owl-next span {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_slider_arrow_col')); ?>;
	}

	.catwrapslider .owl-prev:hover, .catwrapslider .owl-next:hover {
		background: <?php echo esc_attr(get_theme_mod('classic_internet_services_slider_arrowhover_col')); ?>;

	}

	#services_section h3 {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_services_heading_col')); ?>;
	}

	#services_section .pagemore a {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_services_btntxt_col')); ?>;
		background: <?php echo esc_attr(get_theme_mod('classic_internet_services_services_btnbg_col')); ?>;
	}

	#services_section .pagemore a:hover {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_services_btntxthover_col')); ?>;
		background: <?php echo esc_attr(get_theme_mod('classic_internet_services_services_btnbghover_col')); ?>;
	}

	.pagecontent {
		background: <?php echo esc_attr(get_theme_mod('classic_internet_services_services_boxbg_col')); ?>;
	}

	.pagecontent h4 a {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_services_boxheading_col')); ?>;
	}

	.pagecontent h4 a:hover {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_services_boxheadinghover_col')); ?>;
	}

	.pagecontent p {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_services_boxtxt_col')); ?>;
	}

	#footer .copywrap a {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_footer_coypright_col')); ?>;
	}

	#footer .copywrap a:hover {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_footer_coyprighthover_col')); ?>;
	}

	#footer .copywrap {
		background-color: <?php echo esc_attr(get_theme_mod('classic_internet_services_footer_coyprightbg_col')); ?>;
	}

	#footer {
		background-color: <?php echo esc_attr(get_theme_mod('classic_internet_services_footer_topbg_col')); ?>;
	}

	#footer h1,#footer h2,#footer h3,#footer h4,#footer h5,#footer h6 {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_footer_heading_col')); ?>;
	}

	#footer p {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_footer_text_col')); ?>;
	}

	.ftr-4-box ul li a {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_footer_list_col')); ?>;
	}

	.ftr-4-box ul li a:hover {
		color: <?php echo esc_attr(get_theme_mod('classic_internet_services_footer_listhover_col')); ?>;
	}

	.ftr-4-box ul li {
		border-color: <?php echo esc_attr(get_theme_mod('classic_internet_services_footer_listborder_col')); ?>;
	}

	</style>
	<?php 
}
endif;