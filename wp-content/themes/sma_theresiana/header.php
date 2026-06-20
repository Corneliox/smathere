<?php
/**
 * The header template for the SMA Theresiana theme.
 *
 * @package sma_theresiana
 */

// Attach th-menu__link class to every anchor inside wp_nav_menu
add_filter('nav_menu_link_attributes', function ($atts, $item, $args, $depth) {
    if (isset($args->menu_class) && false !== strpos($args->menu_class, 'th-menu')) {
        $atts['class'] = isset($atts['class'])
            ? trim($atts['class'] . ' th-menu__link')
            : 'th-menu__link';
    }
    if (isset($args->menu_class) && false !== strpos($args->menu_class, 'th-mobile-menu')) {
        $atts['class'] = isset($atts['class'])
            ? trim($atts['class'] . ' th-mobile-menu__link')
            : 'th-mobile-menu__link';
    }
    return $atts;
}, 10, 4);
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) wp_body_open(); ?>

<!-- Skip to content -->
<a class="screen-reader-text" href="#main-content"><?php esc_html_e('Lewati ke konten', 'sma-theresiana'); ?></a>

<!-- ============================================================
     SITE HEADER
     ============================================================ -->
<header id="site-header" class="th-header" role="banner">
    <div class="th-container">
        <nav class="th-nav"
             role="navigation"
             aria-label="<?php esc_attr_e('Navigasi Utama', 'sma-theresiana'); ?>">

            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="th-logo" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<span class="th-logo__text">' . esc_html(get_bloginfo('name')) . '</span>';
                }
                ?>
            </a>

            <!-- Desktop Primary Menu -->
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => 'th-menu',
                'container'      => false,
                'link_before'    => '',
                'link_after'     => '',
                'items_wrap'     => '<ul id="primary-menu" class="th-menu" role="menubar">%3$s</ul>',
                'walker'         => false,
                'fallback_cb'    => function () {
                    echo '<ul class="th-menu" role="menubar">';
                    echo '<li class="th-menu__item"><a href="' . esc_url(admin_url('nav-menus.php')) . '" class="th-menu__link">Setup Menu</a></li>';
                    echo '</ul>';
                },
            ]);
            ?>

            <!-- Header Actions (search + optional phone) -->
            <div class="th-nav__actions">
                <a href="<?php echo esc_url(get_search_link()); ?>"
                   class="th-nav__icon"
                   aria-label="<?php esc_attr_e('Cari', 'sma-theresiana'); ?>">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </a>
                <?php
                $phone = get_theme_mod('onepress_contact_phone', '');
                if ($phone) :
                    $phone_clean = preg_replace('/[^0-9+]/', '', $phone);
                ?>
                <a href="tel:<?php echo esc_attr($phone_clean); ?>"
                   class="th-nav__icon th-nav__phone"
                   aria-label="<?php esc_attr_e('Telepon', 'sma-theresiana'); ?>">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                </a>
                <?php endif; ?>
            </div>

            <!-- Hamburger Button (mobile) -->
            <button class="th-hamburger"
                    id="th-hamburger"
                    type="button"
                    aria-expanded="false"
                    aria-controls="th-mobile-nav"
                    aria-label="<?php esc_attr_e('Toggle menu', 'sma-theresiana'); ?>">
                <span class="th-hamburger__bar"></span>
                <span class="th-hamburger__bar"></span>
                <span class="th-hamburger__bar"></span>
            </button>

        </nav><!-- .th-nav -->
    </div><!-- .th-container -->
</header><!-- #site-header -->


<!-- ============================================================
     MOBILE NAV DRAWER
     ============================================================ -->
<div class="th-mobile-nav"
     id="th-mobile-nav"
     role="dialog"
     aria-modal="true"
     aria-label="<?php esc_attr_e('Menu Mobile', 'sma-theresiana'); ?>"
     aria-hidden="true">

    <div class="th-mobile-nav__inner">

        <!-- Drawer header: logo + close button -->
        <div class="th-mobile-nav__header">
            <a href="<?php echo esc_url(home_url('/')); ?>"
               class="th-logo"
               rel="home"
               aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<span class="th-logo__text">' . esc_html(get_bloginfo('name')) . '</span>';
                }
                ?>
            </a>
            <button class="th-mobile-nav__close"
                    id="th-mobile-close"
                    type="button"
                    aria-label="<?php esc_attr_e('Tutup menu', 'sma-theresiana'); ?>">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
        </div><!-- .th-mobile-nav__header -->

        <!-- Mobile menu items -->
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'menu_class'     => 'th-mobile-menu',
            'container'      => false,
            'fallback_cb'    => false,
        ]);
        ?>

        <!-- Mobile contact info (optional) -->
        <?php
        $phone   = get_theme_mod('onepress_contact_phone', '');
        $address = get_theme_mod('onepress_contact_address', '');
        if ($phone || $address) :
        ?>
        <div class="th-mobile-nav__contact">
            <?php if ($address) : ?>
            <p class="th-mobile-nav__contact-item">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <?php echo esc_html($address); ?>
            </p>
            <?php endif; ?>
            <?php if ($phone) :
                $phone_clean = preg_replace('/[^0-9+]/', '', $phone);
            ?>
            <p class="th-mobile-nav__contact-item">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <a href="tel:<?php echo esc_attr($phone_clean); ?>"><?php echo esc_html($phone); ?></a>
            </p>
            <?php endif; ?>
        </div><!-- .th-mobile-nav__contact -->
        <?php endif; ?>

    </div><!-- .th-mobile-nav__inner -->
</div><!-- #th-mobile-nav -->

<!-- Mobile Overlay -->
<div class="th-mobile-overlay"
     id="th-mobile-overlay"
     aria-hidden="true"></div>


<!-- main content starts in each template (front-page.php, page.php, etc.) -->
