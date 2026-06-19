<?php
/**
 * Template part for displaying slider section
 *
 * @package Green Agro Landscaping
 * @subpackage green_agro_landscaping
 */

?>

<?php if( get_theme_mod( 'green_agro_landscaping_slider_arrows') != '') { ?>

<section id="slider">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <?php $green_agro_landscaping_slide_pages = array();
      for ( $green_agro_landscaping_count = 1; $green_agro_landscaping_count <= 4; $green_agro_landscaping_count++ ) {
        $green_agro_landscaping_mod = intval( get_theme_mod( 'green_agro_landscaping_slider_page' . $green_agro_landscaping_count ));
        if ( 'page-none-selected' != $green_agro_landscaping_mod ) {
          $green_agro_landscaping_slide_pages[] = $green_agro_landscaping_mod;
        }
      }
      if( !empty($green_agro_landscaping_slide_pages) ) :
        $green_agro_landscaping_args = array(
          'post_type' => 'page',
          'post__in' => $green_agro_landscaping_slide_pages,
          'orderby' => 'post__in'
        );
        $green_agro_landscaping_query = new WP_Query( $green_agro_landscaping_args );
        if ( $green_agro_landscaping_query->have_posts() ) :
          $i = 1;
    ?>
    <div class="carousel-inner" role="listbox">
      <?php  while ( $green_agro_landscaping_query->have_posts() ) : $green_agro_landscaping_query->the_post(); ?>
        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
          <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
          <div class="carousel-caption">
            <div class="inner_carousel">
              <h2><?php the_title(); ?></h2>
              <p><?php $green_agro_landscaping_excerpt = get_the_excerpt();echo esc_html( green_agro_landscaping_string_limit_words( $green_agro_landscaping_excerpt,15 ) ); ?></p>
              <?php if( get_theme_mod( 'green_agro_landscaping_slider_button',true) != '') { ?>
                <div class="more-btn">
                  <a href="<?php the_permalink(); ?>"><?php esc_html_e('Discover More','green-agro-landscaping'); ?></a>
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
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
    </a>
  </div>
  <div class="clearfix"></div>
</section>

<?php } ?>
