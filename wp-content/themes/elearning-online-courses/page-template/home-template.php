<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content">
  <section id="top-slider">
    <?php if(get_theme_mod('online_tutor_top_slider_setting') != ''){ ?>
    <?php $online_tutor_slide_pages = array();
      for ( $count = 1; $count <= 3; $count++ ) {
        $mod = intval( get_theme_mod( 'online_tutor_top_slider_page' . $count ));
        if ( 'page-none-selected' != $mod ) {
          $online_tutor_slide_pages[] = $mod;
        }
      }
      if( !empty($online_tutor_slide_pages) ) :
        $args = array(
          'post_type' => 'page',
          'post__in' => $online_tutor_slide_pages,
          'orderby' => 'post__in'
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          $i = 1;
    ?>
    <div class="owl-carousel" role="listbox">
      <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="slider-box">
          <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
          <div class="slider-inner-box">
            <h1 class="pb-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <p class="post"><?php echo wp_trim_words( get_the_content(), 30 ); ?></p>
            <div class="slider-box-btn mt-4">
              <a href="<?php the_permalink(); ?>"><?php esc_html_e('Learn More','elearning-online-courses'); ?></a>
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
    <?php }?>
  </section>

  <?php if(get_theme_mod('online_tutor_search_on_off') != ''){ ?>

  <div class="container">
    <div class="searchbox">
      <h3><?php esc_html_e('Find A Tutor','elearning-online-courses'); ?></h3>
      <?php get_search_form(); ?>
    </div>
  </div>

<?php }?>

<?php if(get_theme_mod('online_tutor_other_project_setting') != ''){ ?>
  <section id="projects" class="py-5">
    <div class="container">
      <?php if(get_theme_mod('online_tutor_projects_title') != ''){ ?>
        <h2 class="text-center"><?php echo esc_html(get_theme_mod('online_tutor_projects_title')); ?></h2>
      <?php }?>
      <div class="row mt-5">
        <?php $online_tutor_other_project_section = array();
          $project_loop = get_theme_mod('online_tutor_project_loop');
          for ($i=1; $i <= $project_loop; $i++) { 
            $mod = intval( get_theme_mod( 'online_tutor_other_project_section' .$i));
            if ( 'page-none-selected' != $mod ) {
              $online_tutor_other_project_section[] = $mod;
            }
          }
          if( !empty($online_tutor_other_project_section) ) :
          $args = array(
            'post_type' => 'post',
            'post__in' => $online_tutor_other_project_section,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="col-lg-4 col-md-6">
            <div class="project-box mb-4">
              <?php if ( has_post_thumbnail() ) { ?>
                <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>" class="w-100"/>
                <div class="price-box text-right">
                  <?php if(get_theme_mod('online_tutor_projects_price'.$i) != ''){ ?>
                    <h5><?php echo esc_html(get_theme_mod('online_tutor_projects_price'.$i)); ?></h5>
                  <?php }?>
                </div>
              <?php }?>
              <div class="content text-center">
                <?php if(get_theme_mod('elearning_online_courses_projects_courses_text'.$i) != ''){ ?>
                  <p class="course-text"><?php echo esc_html(get_theme_mod('elearning_online_courses_projects_courses_text'.$i)); ?></p>
                <?php }?>
                <a href="<?php the_permalink(); ?>"><h3 class="title mb-2"><?php the_title(); ?></h3></a>
                <p class="post m-0"><?php echo wp_trim_words( get_the_content(), 25 ); ?></p>
              </div>
            </div>
          </div>
        <?php $i++; endwhile;
        wp_reset_postdata();?>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php endif;
        endif;?>
      </div>
    </div>
  </section>
  <?php }?>

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