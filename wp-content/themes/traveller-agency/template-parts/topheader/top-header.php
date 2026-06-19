<?php
/**
 * Displays main header
 *
 * @package Traveller Agency
 */
?>

<div class="main-header text-center text-md-left">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-4 align-self-center">
                <div class="navbar-brand text-center text-md-left">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; ?>
                    <?php $traveller_agency_blog_info = get_bloginfo( 'name' ); ?>
                        <?php if ( ! empty( $traveller_agency_blog_info ) ) : ?>
                            <?php if ( is_front_page() && is_home() ) : ?>
                              <?php if( get_theme_mod('traveller_agency_logo_title_text',true) != ''){ ?>
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                              <?php } ?>
                            <?php else : ?>
                              <?php if( get_theme_mod('traveller_agency_logo_title_text',true) != ''){ ?>
                                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                              <?php } ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php
                            $traveller_agency_description = get_bloginfo( 'description', 'display' );
                            if ( $traveller_agency_description || is_customize_preview() ) :
                        ?>
                        <?php if( get_theme_mod('traveller_agency_theme_description',false) != ''){ ?>
                          <p class="site-description"><?php echo esc_html($traveller_agency_description); ?></p>
                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-3 col-sm-3 col-4 align-self-center">
                <?php get_template_part('template-parts/navigation/nav'); ?>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-5 col-8 align-self-center">
                <?php if(get_theme_mod('traveller_agency_phone') != '' ){ ?>
                    <p class="mb-0 phone-text "><i class="fas fa-phone mr-3"></i><a href="tel:<?php echo esc_html(get_theme_mod('traveller_agency_phone','')); ?>"><?php echo esc_html(get_theme_mod('traveller_agency_phone','')); ?></a></p>
                <?php }?>
            </div>
        </div>
    </div>
</div>
