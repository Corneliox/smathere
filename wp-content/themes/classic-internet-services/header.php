<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Classic Internet Services
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
  wp_body_open();
} else {
  do_action( 'wp_body_open' );
} ?>

<?php if ( get_theme_mod('classic_internet_services_preloader', true) != "") { ?>
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
<?php }?>

<a class="screen-reader-text skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'classic-internet-services' ); ?></a>

<div id="pageholder" <?php if( get_theme_mod( 'classic_internet_services_box_layout' ) ) { echo 'class="boxlayout"'; } ?>>

<div class="header">
  <?php if ( get_theme_mod('classic_internet_services_topbar', true) != "") { ?>
    <div class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 col-md-10">
            <?php $blog_info = get_bloginfo( 'name' ); ?>
              <?php if ( ! empty( $blog_info ) ) : ?>
                <?php $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                  <?php if ( get_theme_mod('classic_internet_services_tagline_enable',true) != "") { ?>
                  <p class="site-description"><?php echo esc_html( $description ); ?></p>
                  <?php } ?>
              <?php endif; ?>
            <?php endif; ?>
          </div>
          <div class="col-lg-2 col-md-2">
            <?php if(class_exists('woocommerce')){ ?>
              <?php if ( is_user_logged_in() ) { ?>
                <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('My Account','classic-internet-services'); ?>"><i class="fa fa-user" aria-hidden="true"></i></a>
              <?php } 
              else { ?>
                <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login / Register','classic-internet-services'); ?>"><i class="fas fa-user"></i></a>
              <?php } ?>
              <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'shopping cart','classic-internet-services' ); ?>"><i class="fas fa-shopping-basket"></i></a>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  <?php }?>
  <div class="bg-inner">
    <div class="container">    
      <div class="row">
        <div class="col-lg-3 col-md-6 col-8 align-self-center">
          <div class="logo">
            <?php classic_internet_services_the_custom_logo(); ?>
            <?php $blog_info = get_bloginfo( 'name' ); ?>
            <?php if ( ! empty( $blog_info ) ) : ?>
              <?php if ( get_theme_mod('classic_internet_services_title_enable',true) != "") { ?>
              <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1> 
              <?php } ?>             
            <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-9 col-md-6 col-4 align-self-center">
          <div class="toggle-nav text-md-right">
            <?php if(has_nav_menu('primary')){ ?>
              <button role="tab"><?php esc_html_e('MENU','classic-internet-services'); ?></button>
            <?php }?>
          </div>
          <div id="mySidenav" class="nav sidenav text-left text-lg-right">
            <nav id="site-navigation" class="main-nav" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu','classic-internet-services' ); ?>">
              <?php if(has_nav_menu('primary')){
                wp_nav_menu( array( 
                  'theme_location' => 'primary',
                  'container_class' => 'main-menu clearfix' ,
                  'menu_class' => 'clearfix',
                  'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                  'fallback_cb' => 'wp_page_menu',
                ) );
              } ?>
              <a href="javascript:void(0)" class="close-button"><?php esc_html_e('CLOSE','classic-internet-services'); ?></a>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>