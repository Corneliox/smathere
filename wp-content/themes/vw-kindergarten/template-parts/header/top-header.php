<?php
/**
 * The template part for Top Header
 *
 * @package VW Kindergarten
 * @subpackage vw-kindergarten
 * @since vw-kindergarten 1.0
 */
?>

<div class="container">
    <div class="top-header">
        <div class="row">
            <div class="col-lg-3 col-md-3 text-md-start text-center align-self-center">
                <?php if(get_theme_mod('vw_kindergarten_phone_number') != ''){ ?>
                    <a href="tel:<?php echo esc_attr(get_theme_mod('vw_kindergarten_phone_number')); ?>" class="phone"><?php echo esc_html(get_theme_mod('vw_kindergarten_phone_number')); ?><i class="fas fa-phone-square ms-2"></i><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_kindergarten_phone_number')); ?></span></a>
                <?php }?>
            </div>
            <div class="col-lg-6 col-md-4 text-center align-self-center">
                <?php get_template_part('template-parts/header/navigation'); ?>
            </div>
            <div class="col-lg-3 col-md-5 text-md-end text-center align-self-center">
                <?php if(get_theme_mod('vw_kindergarten_email_address') != ''){ ?>
                    <a href="mailto:<?php echo esc_attr(get_theme_mod('vw_kindergarten_email_address')); ?>" class="phone"><i class="fas fa-envelope me-2"></i><?php echo esc_html(get_theme_mod('vw_kindergarten_email_address')); ?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_kindergarten_email_address')); ?></span></a>
                <?php }?>
            </div>
        </div>
    </div>
</div>