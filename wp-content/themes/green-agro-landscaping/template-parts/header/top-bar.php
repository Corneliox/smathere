<div class="top-bar">
  <div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-6 align-self-center">
          <?php if( get_theme_mod( 'green_agro_landscaping_call_text' ) != '' || get_theme_mod( 'green_agro_landscaping_call' ) != '') { ?>
            <div class="row">
              <div class="col-lg-3 col-md-3 mt-2"><i class="fas fa-phone"></i></div>
              <div class="col-lg-9 col-md-9">
                <p class="infotext"><?php echo esc_html( get_theme_mod('green_agro_landscaping_call_text','')); ?></p>
                <p class="simplep"><?php echo esc_html( get_theme_mod('green_agro_landscaping_call','') ); ?></p>
              </div>
          </div>
          <?php } ?>
        </div>
        <div class="col-lg-3 col-md-6 align-self-center">
          <?php if( get_theme_mod( 'green_agro_landscaping_mail_text' ) != '' || get_theme_mod( 'green_agro_landscaping_mail' ) != '') { ?>
            <div class="row">
            <div class="col-lg-2 col-md-2 mt-2"><i class="fas fa-envelope-open"></i></div>
            <div class="col-lg-10 col-md-10">
              <p class="infotext"><?php echo esc_html( get_theme_mod('green_agro_landscaping_mail_text','')); ?></p>
              <p class="simplep"><?php echo esc_html( get_theme_mod('green_agro_landscaping_mail','') ); ?></p>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="col-lg-4 col-md-6 align-self-center">
          <?php if(get_theme_mod( 'green_agro_landscaping_hour_text' ) != '' || get_theme_mod( 'green_agro_landscaping_hour' ) != '') { ?>
          <div class="row">
            <div class="col-lg-2 col-md-2 mt-2"><i class="fas fa-clock"></i></div>
            <div class="col-lg-10 col-md-10">
              <p class="infotext"><?php echo esc_html( get_theme_mod('green_agro_landscaping_hour_text','')); ?></p>
              <p class="simplep"><?php echo esc_html( get_theme_mod('green_agro_landscaping_hour','') ); ?></p>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="col-lg-3 col-md-6 align-self-center">
          <?php get_template_part( 'template-parts/header/social', 'icon' ); ?>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
