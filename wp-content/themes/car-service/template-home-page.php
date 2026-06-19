<?php
/**
 * The Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Car Service
 */

get_header(); ?>

<div id="content">
  <?php
    $hidcatslide = get_theme_mod('car_service_hide_categorysec', false);
    if( $hidcatslide != ''){
  ?>
  <div id="head-banner">
    <?php $car_service_querymed = new WP_query('page_id='.esc_attr(get_theme_mod('car_service_pageboxes',true)) ); ?>
    <?php while( $car_service_querymed->have_posts() ) : $car_service_querymed->the_post(); ?>
      <div class="row mr-0">
        <div class="col-lg-5 col-md-5">
          <div class="image-box">
            <?php if (has_post_thumbnail() ){ ?>
              <div class="circle-three"></div>
                <?php the_post_thumbnail();?>
              <div class="circle-one"></div>
              <div class="circle-two"></div>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-7 col-md-7">
          <div class="content-inner-box text-center text-md-right">
            <?php if ( get_theme_mod('car_service_pgboxes_title') != "") { ?>
              <span><?php echo esc_html(get_theme_mod('car_service_pgboxes_title','')); ?></span>
            <?php } ?>
            <h1><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h1>
            <div class="banner-btn">
              <a href="<?php the_permalink(); ?>">
                <?php esc_html_e('Learn More','car-service'); ?>
              </a>
            </div>
            <p><?php echo wp_trim_words( get_the_content(), get_theme_mod('car_service_banner_excerpt_number',15) ); ?></p>
          </div>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
    <div class="clear"></div>
  </div>
  <?php }?>

  <?php
    $car_service_hidepageboxes = get_theme_mod('car_service_disabled_pgboxes',true);
    if( $car_service_hidepageboxes != ''){
  ?>
  <div id="about_section">
    <div class="container">
      <div class="row">
        <?php if( get_theme_mod('car_about_pageboxes',false)) { ?>
        <?php $car_service_querymed = new WP_query('page_id='.esc_attr(get_theme_mod('car_about_pageboxes',true)) ); ?>
          <?php while( $car_service_querymed->have_posts() ) : $car_service_querymed->the_post(); ?>
          <div class="col-lg-6 col-md-6">
            <?php if (has_post_thumbnail() ){ ?>
              <div class="thumbbx"><?php the_post_thumbnail();?></div>
            <?php } ?>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="text-inner-box">
              <h2><?php the_title(); ?></h2>
              <p><?php echo esc_html( wp_trim_words( get_the_content(), 60, '...' ) );  ?></p>
              <div class="serv-btn">
                <a href="<?php the_permalink(); ?>"><?php esc_html_e('Learn More','car-service'); ?></a>
              </div>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
        <?php }?>
        <div class="clear"></div>
      </div>
    </div>
  </div>
  <?php }?>
</div>

<?php get_footer(); ?>