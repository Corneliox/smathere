<?php
if (!function_exists('retina_blog_banner_slider')) :
    /**
     * Banner Slider
     *
     * @since retina-blog 1.0.0
     *
     */
    function retina_blog_banner_slider()
    {
        if (1 != retina_blog_get_option('show_slider_section')) {
            return null;
        }
        $retina_blog_slider_category = esc_attr(retina_blog_get_option('select_category_for_slider'));
        $retina_blog_slider_number = 4;
        ?>
        <?php
        if (1 != retina_blog_get_option('show_fullwidth_slider_section')) {
            $fullwidth_slider = '';
        } else {
            $fullwidth_slider = 'main-banner-fullwidth';
        }?>
        <div class="feature-block main-banner <?php echo esc_attr($fullwidth_slider); ?>">
            <div class="wrapper">
                <?php
                $retina_blog_banner_slider_args = array(
                    'post_type' => 'post',
                    'cat' => absint($retina_blog_slider_category),
                    'ignore_sticky_posts' => true,
                    'posts_per_page' => absint( $retina_blog_slider_number ),
                ); ?>
                <?php $rtl_class = 'false';
                if(is_rtl()){ 
                    $rtl_class = 'true';
                }?>
                <div class="main-slider" data-slick='{"rtl": <?php echo($rtl_class); ?>}'>
                    <?php
                    $retina_blog_banner_slider_post_query = new WP_Query($retina_blog_banner_slider_args);
                    if ($retina_blog_banner_slider_post_query->have_posts()) :
                        while ($retina_blog_banner_slider_post_query->have_posts()) : $retina_blog_banner_slider_post_query->the_post();
                            if(has_post_thumbnail()){
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                                $url = $thumb['0'];
                            }
                            global $post;
                            $author_id = $post->post_author;
                            ?>
                            <figure class="slick-item">
                                <a href="<?php the_permalink(); ?>" class="data-bg data-bg-slide" data-background="<?php echo esc_url($url); ?>">
                                </a>
                                <figcaption class="slider-figcaption slider-figcaption-main">
                                    <div class="slider-wrapper">
                                        <h2 class="slide-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <div class="entry-meta">
                                            <?php retina_blog_posted_on(); ?>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>

        <?php
    }
endif;
add_action('retina_blog_action_banner_slider', 'retina_blog_banner_slider', 40);
