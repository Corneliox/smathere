<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Retina_Blog
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if (function_exists('wp_body_open')) {
    wp_body_open();
}
?>

<?php if ((retina_blog_get_option('enable_preloader')) == 1) { ?>
    <div class="preloader">
        <div class="loader">
            <div class="pulse"></div>
            <div class="loading-text"> <?php esc_html_e('Loading', 'retina-blog'); ?></div>
        </div>
    </div>
<?php } ?>
<!-- full-screen-layout/boxed-layout -->
<?php if (retina_blog_get_option('homepage_layout_option') == 'full-width') {
    $retina_blog_homepage_layout = 'full-screen-layout';
} elseif (retina_blog_get_option('homepage_layout_option') == 'boxed') {
    $retina_blog_homepage_layout = 'boxed-layout';
}
?>
<div id="page" class="site <?php echo esc_attr($retina_blog_homepage_layout); ?>">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'retina-blog'); ?></a>
    <?php $retina_blog_header_image = get_header_image(); ?>
    <header id="masthead" class="site-header">
        <div class="top-area data-bg" data-background="<?php echo esc_url($retina_blog_header_image); ?>">
            <div class="wrapper">
                <div class="site-branding">
                    <?php
                    the_custom_logo();
                    if (is_front_page() && is_home()) :
                        ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                    <?php
                    else :
                        ?>
                        <p class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </p>
                    <?php
                    endif;
                    $retina_blog_description = get_bloginfo('description', 'display');
                    if ($retina_blog_description || is_customize_preview()) :
                        ?>
                        <p class="site-description"><?php echo esc_html($retina_blog_description); /* WPCS: xss ok. */ ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="banner-overlay"></div>
        </div>

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <div class="wrapper">
                <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false" tabindex="0">
                     <span class="screen-reader-text">
                        <?php esc_html_e('Primary Menu', 'retina-blog'); ?>
                    </span>
                    <i class="ham"></i>
                </span>
                <div class="primary-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-1',
                        'menu_id' => 'primary-menu',
                        'container' => 'div',
                        'container_class' => 'menu',
                    ));
                    ?>
                </div>

                <div class="icon-search">
                    <i class="icons icon-magnifier"></i>
                </div>
            </div>
        </nav>
    </header>

    <div class="popup-search">
        <div class="table-align">
            <div class="table-align-cell">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="close-popup"></div>
    </div>

    <?php
    if (is_front_page() || is_home()) {
        /**
         * retina_blog_action_front_page hook
         * @since perfect-magazine 0.0.2
         *
         * @hooked retina_blog_action_banner_slider -  10
         * @sub_hooked retina_blog_action_front_page -  10
         */
        do_action('retina_blog_action_banner_slider');
    } ?>
    <div id="content" class="site-content">
        <?php if ( !is_home() && !is_404() ) { ?>
            <div class="breadcrumb-wrapper">
                <div class="container">
                    <div class="row">
                        <?php
                        /**
                         * Hook - retina_blog_add_breadcrumb.
                         */
                        do_action('retina_blog_action_breadcrumb');
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="site-container-tm">
