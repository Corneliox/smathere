<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action( 'vw_kindergarten_before_slider' ); ?>

    <?php if( get_theme_mod( 'vw_kindergarten_slider_hide_show', false) == 1 || get_theme_mod( 'vw_kindergarten_resp_slider_hide_show', false) == 1) { ?>
      <section id="slider">  
      <?php if(get_theme_mod('vw_kindergarten_slider_type', 'Default slider') == 'Default slider' ){ ?>      
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="<?php echo esc_attr(get_theme_mod( 'vw_kindergarten_slider_speed',4000)) ?>">
          <?php $vw_kindergarten_pages = array();
            for ( $count = 1; $count <= 3; $count++ ) {
              $mod = intval( get_theme_mod( 'vw_kindergarten_slider_page' . $count ));
              if ( 'page-none-selected' != $mod ) {
                $vw_kindergarten_pages[] = $mod;
              }
            }
            if( !empty($vw_kindergarten_pages) ) :
              $args = array(
                'post_type' => 'page',
                'post__in' => $vw_kindergarten_pages,
                'orderby' => 'post__in'
              );
              $query = new WP_Query( $args );
              if ( $query->have_posts() ) :
                $i = 1;
          ?>
          <div class="carousel-inner" role="listbox">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
              <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
                <?php if(has_post_thumbnail()){
                  the_post_thumbnail();
                } else{?>
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/block-patterns/images/slider.png" alt="" />
                <?php } ?>
                <div class="carousel-caption">
                  <div class="inner_carousel">
                    <?php if( get_theme_mod('vw_kindergarten_slider_title_hide_show',true) == 1){ ?>
                      <h1 class="wow rollIn delay-1000" data-wow-duration="2s"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                    <?php }?>
                    <?php if( get_theme_mod('vw_kindergarten_slider_content_hide_show',true) == 1){ ?>
                      <p class="wow rollIn delay-1000" data-wow-duration="2s"><?php $vw_kindergarten_excerpt = get_the_excerpt(); echo esc_html( vw_kindergarten_string_limit_words( $vw_kindergarten_excerpt, esc_attr(get_theme_mod('vw_kindergarten_slider_excerpt_number','30')))); ?></p>
                    <?php } ?>
                    <?php if( get_theme_mod('vw_kindergarten_slider_button_text','Discover More') != ''){ ?>
                      <div class="slider-btn my-md-4 mt-2 wow rollIn delay-1000" data-wow-duration="2s">
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="px-4 py-3"><?php echo esc_html(get_theme_mod('vw_kindergarten_slider_button_text',__('Discover More','vw-kindergarten')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_kindergarten_slider_button_text',__('Discover More','vw-kindergarten')));?></span></a>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php $i++; endwhile; 
            wp_reset_postdata();?>
          </div>
          <?php else : ?>
            <div class="no-postfound"></div>
          <?php endif;
          endif;?>
          <a class="carousel-control-prev" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev" role="button">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
            <span class="screen-reader-text"><?php esc_html_e( 'Previous','vw-kindergarten' );?></span>
          </a>
          <a class="carousel-control-next" data-bs-target="#carouselExampleCaptions" data-bs-slide="next" role="button">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
            <span class="screen-reader-text"><?php esc_html_e( 'Next','vw-kindergarten' );?></span>
          </a>
        </div>  
      <?php } else if(get_theme_mod('vw_kindergarten_slider_type', 'Advance slider') == 'Advance slider'){?>
        <?php echo do_shortcode(get_theme_mod('vw_kindergarten_advance_slider_shortcode')); ?>
      <?php } ?>
      </section>
    <?php }?>

  <?php do_action( 'vw_kindergarten_after_slider' ); ?>

  <section id="about-sec" class="py-5 wow slideInRight delay-1000" data-wow-duration="2s">
    <div class="container">
      <?php $vw_kindergarten_about_page = array();
        $mod = absint( get_theme_mod( 'vw_kindergarten_about_page','vw-kindergarten'));
        if ( 'page-none-selected' != $mod ) {
          $vw_kindergarten_about_page[] = $mod;
        }
        if( !empty($vw_kindergarten_about_page) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $vw_kindergarten_about_page,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $count = 0;
            while ( $query->have_posts() ) : $query->the_post(); ?>
              <div class="row">
                <div class="col-lg-7 col-md-7">
                  <?php if(get_theme_mod('vw_kindergarten_section_title') != ''){ ?>
                    <strong><?php echo esc_html(get_theme_mod('vw_kindergarten_section_title')); ?>
                      <svg class="about-bg" width="100%" height="45" viewBox="0 0 200 45">
                        <image id="title_bg_2" width="100%" height="45" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIwAAAAgCAYAAADAHpCrAAADxElEQVR4nO2cW4hNURjHf47L4BjDzBjGxAsiJVIiipJLyhMKTfIiLyIiyeWJkgc1iSgvU1688OCBB1Kk5MG1JJRMjDtjxjBmMKNv+u+smc459lxOM3PO96uvtc4+92//z3/tfdb69qC2xy/JAqXAZGA6MBuYAlQAJcAYoEBv2Qr8BJqBRqABqAfqgC+Kz2o/At+A70H8UPzKxpfoA5IpYpRyNjpoRyqHQ9T/DTSpbVTOPgBvgU/Ae7U9Zkgv5sTEsQSYDywAZmYx33WKr0H7Rf16Ca9BAksXf7L4+UKGaycXAWODKNE2a4vVRv1iPW5oL7x/C/AceAg8AG4Dt7r7Yj11GHOODcBSCWRCT14sS7QGTtSk+BFEowRXzz/XalIfuZc5YJt+YCPUt505TFGo7YVyhFH8c4eRimRwf19ijn4fuAyclfvEpjuCGQ8sBrbITYr6oUiceNiwdQo4rSH/v3RFMDOAjUClnMXJHZ4Ce4FLvSEYE8d2DT3jXSQ5TRWwK9MXzHTQm5RQ9uhgzMl9dgLlwKZ0Z57pBGNnOceBhS6SvGO9Tt/X6YSgA4kU2dgG3HCx5DUrgepUCegsmKPASZ0qOvnNWuBwJsEcAfble5acDhwEloUbIsHYeHXAc+Wk4IyOadoxwZQBJzxTThqmyGnaSchdyj1bTga2AtOQYNZ4ppz/YHNgO5BgZnm2nBjYn3kViX4we+oMDGySeUUi7iyl4wDLTTB3+sEHcQYGc0wwF3xnOTEpN8FcAR55xpw4JLTedbdny4lBTTQ1cM3/7XVicD2cfNyrhcGOkwpbUFUdCqZZi2euerqcFByzY93O62FshdVq4KJnzAk4BxwizYq7Fi34rvKMOVpUtzlKRCrBoPFql+YP3nnW8pKbwCpgvwr32olTZjJJdlSpCr6+oE3OF9VhW+1wrcpjo9LYqEy2SY/7LeFbf5B+HFa2OlhtWMdcEpSnlup2MqhsLNDzch2r+ryr0eWKctmBrhSyzdUU9yJgahYS1xwU33/SHFeNolZVeu8UzRJENkiomqIgEFJZp5ggYUU106MVhQNQWJbvJ6q5Pg/cy/Tg7pTKlsmq5tncgmqqx8Z87rfgqgK2419JDHb7NfBG/e8xXqu/kOxUSG/tuKBfGkR0X7KPPru59AvgmUTyRHXWsf/p72kxvg1RE4PLeJTI7gs0HLQEw0VjcEmPr6nsLocx14oK8a21MEcyUZmALCx/5lYWdr+1lksLK/Q354ou8RFiQ240VNuQEl0yxXIcubL9GKMh3Jzbtncd4C9IH+mskC0h3gAAAABJRU5ErkJggg=="/>
                      </svg>
                    </strong>
                  <?php }?>
                  <h2><?php the_title(); ?></h2>
                  <p><?php the_excerpt(); ?></p>
                  <div class="about-btn my-4">
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="px-4 py-3"><?php echo esc_html('More About Us','vw-kindergarten');?><span class="screen-reader-text"><?php echo esc_html('More About Us','vw-kindergarten');?></span></a>
                  </div>
                </div>
                <?php if ( has_post_thumbnail() ){ ?>
                  <div class="col-lg-5 col-md-5 text-end">
                    <div class="about-img">
                      <?php the_post_thumbnail(); ?>
                      <?php if(get_theme_mod('vw_kindergarten_image_text') != ''){ ?>
                        <div class="image-outerbox">
                          <div class="image-text">
                            <span><?php echo esc_html(get_theme_mod('vw_kindergarten_image_text')); ?></span>
                          </div>
                        </div>
                      <?php }?>
                    </div>
                  </div>
                <?php }?>
              </div>
            <?php $count++; endwhile; ?>
          <?php else : ?>
            <div class="no-postfound"></div>
          <?php endif;
        endif;
        wp_reset_postdata()
      ?>
    </div>
  </section>

  <?php do_action( 'vw_kindergarten_after_service' ); ?>

  <div id="content-vw" class="py-3">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>