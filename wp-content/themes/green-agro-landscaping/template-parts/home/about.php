<?php
/**
 * Template part for displaying about section
 *
 * @package Green Agro Landscaping
 * @subpackage green_agro_landscaping
 */

?>

<section id="static-blog">
    <div class="container">
      <?php if( get_theme_mod('green_agro_landscaping_blog_tittle') != ''){ ?>
        <h3 class="mt-5"><?php echo esc_html(get_theme_mod('green_agro_landscaping_blog_tittle','')); ?></h3>
      <?php }?>
      <?php if( get_theme_mod('green_agro_landscaping_blog_sub_tittle') != ''){ ?>
        <p><?php echo esc_html(get_theme_mod('green_agro_landscaping_blog_sub_tittle','')); ?></p>
      <?php }?>
        <div class="row mt-5">
          <?php
            $post_category = get_theme_mod('green_agro_landscaping_our_fund_section_category');
            if($post_category){
              $page_query = new WP_Query(array( 'category_name' => esc_html( $post_category ,'green-agro-landscaping')));?>
              <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                  <div class="fund-box">
                    <?php if( get_post_meta($post->ID, 'green_agro_landscaping_font_icon', true) ) {?>
                      <i class="<?php echo esc_attr(get_post_meta($post->ID,'green_agro_landscaping_font_icon',true)); ?>"></i>
                    <?php }?>
                    <h5 class="mb-0 mt-4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                  </div>
                </div>
              <?php endwhile;
              wp_reset_postdata();
            }
          ?>
      </div>
    </div>
</section>
