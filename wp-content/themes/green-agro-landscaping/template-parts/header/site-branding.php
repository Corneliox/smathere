<?php
/*
* Display Logo and contact details
*/
?>

<?php
$green_agro_landscaping_sticky = get_theme_mod('green_agro_landscaping_sticky');
    $green_agro_landscaping_data_sticky = "false";
    if ($green_agro_landscaping_sticky) {
    $green_agro_landscaping_data_sticky = "true";
    }
    global $wp_customize;
?>

<div class="headerbox <?php if( is_user_logged_in() && !isset( $wp_customize ) ){ echo "login-user";} ?>" data-sticky="<?php echo esc_attr($green_agro_landscaping_data_sticky); ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-8 col-12 align-self-center text-lg-left">
        <?php $green_agro_landscaping_logo_settings = get_theme_mod( 'green_agro_landscaping_logo_settings','Different Line');
        if($green_agro_landscaping_logo_settings == 'Different Line'){ ?>
          <div class="logo">
            <?php if( has_custom_logo() ) green_agro_landscaping_the_custom_logo(); ?>
            <?php if( get_theme_mod('green_agro_landscaping_site_title_text',true) == 1){ ?>
              <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php }?>
            <?php $green_agro_landscaping_description = get_bloginfo( 'description', 'display' );
            if ( $green_agro_landscaping_description || is_customize_preview() ) : ?>
              <?php if( get_theme_mod('green_agro_landscaping_site_tagline_text',false)){ ?>
                <p class="site-description"><?php echo esc_html($green_agro_landscaping_description); ?></p>
              <?php }?>
            <?php endif; ?>
          </div>
        <?php }else if($green_agro_landscaping_logo_settings == 'Same Line'){ ?>
          <div class="logo logo-same-line">
            <div class="row">
              <div class="col-lg-5 col-md-5 align-self-center">
                <?php if( has_custom_logo() ) green_agro_landscaping_the_custom_logo(); ?>
              </div>
              <div class="col-lg-7 col-md-7 align-self-center">
                <?php if(get_theme_mod('green_agro_landscaping_site_title_text',true) != ''){ ?>
                  <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php }?>
                <?php $green_agro_landscaping_description = get_bloginfo( 'description', 'display' );
                if ( $green_agro_landscaping_description || is_customize_preview() ) : ?>
                  <?php if(get_theme_mod('green_agro_landscaping_site_tagline_text',false) != ''){ ?>
                    <p class="site-description"><?php echo esc_html($green_agro_landscaping_description); ?></p>
                  <?php }?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php }?>
      </div>
      <div class="col-lg-9 col-md-4 col-6 align-self-center">
        <?php get_template_part( 'template-parts/navigation/site', 'nav' ); ?>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
