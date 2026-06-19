<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content">
  <section id="top-slider">
    <?php $traveller_agency_slide_pages = array();
      for ( $traveller_agency_count = 1; $traveller_agency_count <= 3; $traveller_agency_count++ ) {
        $traveller_agency_mod = intval( get_theme_mod( 'traveller_agency_top_slider_page' . $traveller_agency_count ));
        if ( 'page-none-selected' != $traveller_agency_mod ) {
          $traveller_agency_slide_pages[] = $traveller_agency_mod;
        }
      }
      if( !empty($traveller_agency_slide_pages) ) :
        $traveller_agency_args = array(
          'post_type' => 'page',
          'post__in' => $traveller_agency_slide_pages,
          'orderby' => 'post__in'
        );
        $traveller_agency_query = new WP_Query( $traveller_agency_args );
        if ( $traveller_agency_query->have_posts() ) :
          $traveller_agency_i = 1;
    ?>
    <div class="owl-carousel" role="listbox">
      <?php  while ( $traveller_agency_query->have_posts() ) : $traveller_agency_query->the_post(); ?>
        <div class="slider-box">
          <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
          <div class="slider-inner-box">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
          </div>
          <div class="email-box">
            <?php if(get_theme_mod('traveller_agency_email_text') != '' || get_theme_mod('traveller_agency_email') != ''){ ?>
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-3 align-self-center">
                  <i class="fas fa-envelope-open-text"></i>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-9 align-self-center">
                  <h6 class="mb-0"><?php echo esc_html(get_theme_mod('traveller_agency_email_text','')); ?></h6>
                  <a href="mailto:<?php echo esc_html(get_theme_mod('traveller_agency_email','')); ?>"><p class="mb-0"><?php echo esc_html(get_theme_mod('traveller_agency_email','')); ?></p></a>
                </div>
              </div>
            <?php }?>
          </div>
        </div>
      <?php $traveller_agency_i++; endwhile;
      wp_reset_postdata();?>
    </div>
    <?php else : ?>
      <div class="no-postfound"></div>
    <?php endif;
    endif;?>
  </section>

  <section class="latest-destination py-5">
    <div class="container">      
      <?php if(get_theme_mod('traveller_agency_best_destination_title') != ''){ ?>
        <h3 class="text-center"><?php echo esc_html(get_theme_mod('traveller_agency_best_destination_title','')); ?></h3>
      <?php }?>
      <?php if(get_theme_mod('traveller_agency_best_destination_short_title') != ''){ ?>
        <p class="text-center mb-4"><?php echo esc_html(get_theme_mod('traveller_agency_best_destination_short_title','')); ?></p>
      <?php }?>
      <div class="row">
        <?php
          $traveller_agency_best_destination_cat = get_theme_mod('traveller_agency_best_destination_category','');
          if($traveller_agency_best_destination_cat){
            $traveller_agency_page_query5 = new WP_Query(array( 'category_name' => esc_html($traveller_agency_best_destination_cat,'traveller-agency')));
            $traveller_agency_i=1;
            while( $traveller_agency_page_query5->have_posts() ) : $traveller_agency_page_query5->the_post(); ?>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="box mb-5">
                  <?php if ( has_post_thumbnail() ) { ?>
                    <div class="box-image">
                      <?php the_post_thumbnail(); ?>
                    </div>
                  <?php }?>
                  <div class="box-content">
                    <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <?php 
                      if (function_exists('kksr_freemius')) { 
                        echo kk_star_ratings(); 
                      }
                    ?>
                    <p class="mb-0"><?php echo wp_trim_words( get_the_content(), 10 ); ?></p>
                  </div>
                </div>
              </div>
            <?php $traveller_agency_i++; endwhile;
          wp_reset_postdata();
        } ?>
      </div>
    </div>
  </section>

  <section id="page-content">
    <div class="container">
      <div class="py-5">
        <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              the_content();
            endwhile;
          endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>