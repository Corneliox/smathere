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
<!-- Anti-Flicker Dark Mode Script -->
<script>
    (function() {
        if (localStorage.getItem('th-theme') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    })();
</script>
<?php if ( function_exists( 'wp_body_open' ) ) wp_body_open(); ?>

<!-- Skip to content -->
<a class="screen-reader-text" href="#main-content"><?php esc_html_e('Lewati ke konten', 'sma-theresiana'); ?></a>

<!-- ============================================================
     SITE HEADER
     ============================================================ -->
<header id="site-header" class="th-header" role="banner">
    <div class="th-container">
        <nav class="th-nav"
             style="padding: 10px 20px 10px 20px;"
             role="navigation"
             aria-label="<?php esc_attr_e('Navigasi Utama', 'sma-theresiana'); ?>">

            <!-- KIRI (Left): Logo & Search -->
            <div class="th-nav__left">
                <!-- Logo -->
                <?php
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo_url = '';
                if ( $custom_logo_id ) {
                    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    $logo_url = $image ? $image[0] : '';
                }
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="th-logo" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    <?php if ( $logo_url ) : ?>
                        <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    <?php else : ?>
                        <span class="th-logo__text"><?php echo esc_html(get_bloginfo('name')); ?></span>
                    <?php endif; ?>
                </a>

                <!-- Search Form -->
                <form role="search" method="get" class="th-header-search" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="search" class="th-header-search__field" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" aria-label="Search">
                    <button type="submit" class="th-header-search__submit" aria-label="Submit Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>

            <!-- TENGAH (Center): Main Menu -->
            <div class="th-nav__center">
                <?php
                wp_nav_menu([
                    'theme_location' => 'main',
                    'menu'           => 'Main Menu', // Try to find by name "Main Menu" if location is unset
                    'menu_class'     => 'th-menu',
                    'container'      => 'nav',
                    'container_class'=> 'main-menu-container',
                    'link_before'    => '',
                    'link_after'     => '',
                    'items_wrap'     => '<ul id="main-menu" class="th-menu" role="menubar">%3$s</ul>',
                    'walker'         => false,
                    'fallback_cb'    => function () {
                        // Fallback ke daftar halaman (sama seperti Ashe)
                        wp_page_menu([
                            'show_home'  => true,
                            'menu_class' => 'main-menu-container'
                        ]);
                    },
                ]);
                ?>
            </div>

            <!-- KANAN (Right): Dark Mode Toggle & Hamburger -->
            <div class="th-nav__right">
                
                <!-- Hidden Admin Link (3 clicks) -->
                <a href="<?php echo esc_url(admin_url()); ?>" class="th-admin-hidden-link" aria-label="Admin Panel" title="Setup Menu"></a>

                <!-- Dark Mode Toggle -->
                <button id="th-theme-toggle" class="th-theme-toggle" aria-label="Toggle Dark Mode" title="Light / Dark Mode">
                    <i class="fa fa-sun-o" aria-hidden="true"></i>
                </button>

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
            </div>

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
            <?php
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $logo_url = '';
            if ( $custom_logo_id ) {
                $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                $logo_url = $image ? $image[0] : '';
            }
            ?>
            <a href="<?php echo esc_url(home_url('/')); ?>"
               class="th-logo"
               rel="home"
               aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                <?php if ( $logo_url ) : ?>
                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                <?php else : ?>
                    <span class="th-logo__text"><?php echo esc_html(get_bloginfo('name')); ?></span>
                <?php endif; ?>
            </a>
            <button class="th-mobile-nav__close"
                    id="th-mobile-close"
                    type="button"
                    aria-label="<?php esc_attr_e('Tutup menu', 'sma-theresiana'); ?>">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
        </div><!-- .th-mobile-nav__header -->

        <!-- Mobile Search Form -->
        <form role="search" method="get" class="th-mobile-search" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="search" class="th-mobile-search__field" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" aria-label="Search">
            <button type="submit" class="th-mobile-search__submit" aria-label="Submit Search"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>

        <!-- Mobile menu items -->
        <?php
        wp_nav_menu([
            'theme_location' => 'main',
            'menu'           => 'Main Menu', // Tambahkan parameter pencarian presisi
            'menu_class'     => 'th-mobile-menu',
            'container'      => false,
            'fallback_cb'    => function() {
                wp_page_menu([
                    'show_home'  => true,
                    'menu_class' => 'th-mobile-menu'
                ]);
            },
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
