<?php
/**
 * The Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Car Services Center
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
                <?php the_post_thumbnail();?>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-7 col-md-7">
          <div class="content-inner-box text-center text-md-right">
            <h1><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h1>
            <p><?php echo wp_trim_words( get_the_content(), get_theme_mod('car_service_banner_excerpt_number',15) ); ?></p>
            <div class="banner-btn">
              <a href="<?php the_permalink(); ?>">
                <?php esc_html_e('Read More','car-services-center'); ?>
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
    <div class="clear"></div>
  </div>
  <?php }?>

<?php
    $car_services_center_disabled_pgboxes = get_theme_mod('car_services_center_disabled_pgboxes',true);
    if( $car_services_center_disabled_pgboxes != ''){
  ?>
  <section id="serives_box" >
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4"></div>
        <div class="col-lg-8 col-md-8">
        <div class="ser-heading">
          <h3><span><?php echo esc_html(get_theme_mod('car_services_center_service_spanheading',__('Our Services','car-services-center'))); ?></span></h3>
          <p><span><?php echo esc_html(get_theme_mod('car_services_center_headingtext_para',__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard','car-services-center'))); ?></span></p>
        </div>
      </div>
      </div>

      <div class="row">
        <?php if( get_theme_mod('car_services_center_services_cat',false) ) { ?>
          <?php $car_service_queryvar = new WP_Query('cat='.esc_attr(get_theme_mod('car_services_center_services_cat',true)));
            while( $car_service_queryvar->have_posts() ) : $car_service_queryvar->the_post(); ?>
              <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="services_boxinn ">
                    <div class="ser-img">
                      <?php the_post_thumbnail( 'full' ); ?>
                    </div>
                    <div class="ser-containbx">
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                          <?php
                            $car_services_center_trimexcerpt = get_the_excerpt();
                            $car_services_center_shortexcerpt = wp_trim_words( $car_services_center_trimexcerpt, $car_services_center_num_words = 30 );
                          ?>
                    </div>
                </div>
              </div>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php } ?>
        <?php }?>
      </div>
    </div>
  </section>
</div>

<?php get_footer(); ?>