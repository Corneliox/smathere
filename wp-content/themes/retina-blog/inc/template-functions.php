<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Retina_Blog
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function retina_blog_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'retina_blog_body_classes' );


if (!function_exists('retina_blog_body_class')) :

    /**
     * body class.
     *
     * @since 1.0.0
     */
    function retina_blog_body_class($retina_blog_body_class)
    {
        global $post;
        $global_layout = retina_blog_get_option('global_layout');
        $input = '';
        $home_content_status = retina_blog_get_option('home_page_content_status');
        if (1 != $home_content_status) {
            $input = 'home-content-not-enabled';
        }
        // Check if single.
        if ($post && is_singular()) {
            $post_options = get_post_meta($post->ID, 'retina-blog-meta-select-layout', true);
            if (empty($post_options)) {
                $global_layout = esc_attr(retina_blog_get_option('global_layout'));
            } else {
                $global_layout = esc_attr($post_options);
            }
        }
        if ($global_layout == 'left-sidebar') {
            $retina_blog_body_class[] = 'left-sidebar ' . esc_attr($input);
        } elseif ($global_layout == 'no-sidebar') {
            $retina_blog_body_class[] = 'no-sidebar ' . esc_attr($input);
        } else {
            $retina_blog_body_class[] = 'right-sidebar ' . esc_attr($input);

        }
        return $retina_blog_body_class;
    }
endif;

add_action('body_class', 'retina_blog_body_class');


if (!function_exists('retina_blog_excerpt_length')) :

    /**
     * Excerpt length
     *
     * @since  retina_blog 1.0.0
     *
     * @param null
     * @return int
     */
    function retina_blog_excerpt_length($length)
    {
        if (is_admin() && !wp_doing_ajax()) {
            return $length;
        }
        $excerpt_length = retina_blog_get_option('excerpt_length_global');
        if (empty($excerpt_length)) {
            $excerpt_length = $length;
        }
        return absint($excerpt_length);

    }

endif;
add_filter('excerpt_length', 'retina_blog_excerpt_length', 999);

function retina_blog_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'retina_blog_excerpt_more');
/**
 * Returns word count of the sentences.
 *
 * @since retina_blog 1.0.0
 */
if (!function_exists('retina_blog_words_count')) :
    function retina_blog_words_count($length = 25, $retina_blog_content = null)
    {
        $length = absint($length);
        $source_content = preg_replace('`\[[^\]]*\]`', '', $retina_blog_content);
        $trimmed_content = wp_trim_words($source_content, $length, '');
        return $trimmed_content;
    }
endif;


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function retina_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'retina_blog_pingback_header' );



if ( ! function_exists( 'retina_blog_ajax_pagination' ) ) :
    /**
     * Outputs the required structure for ajax loading posts on scroll and click
     *
     * @since 1.0.0
     * @param $type string Ajax Load Type
     */
    function retina_blog_ajax_pagination($type) {
        ?>
        <div class="load-more-posts <?php echo esc_attr($type);?>" data-load-type="<?php echo esc_attr($type);?>">
            <a href="javascript:void(0)" class="btn-link btn-link-load">
                <span class="ajax-loader"></span>
                <?php _e('Load More Posts', 'retina-blog')?>
                <i class="ion-ios-arrow-right"></i>
            </a>
        </div>
        <?php
    }
endif;

if ( ! function_exists( 'retina_blog_load_more' ) ) :
    /**
     * Ajax Load posts Callback.
     *
     * @since 1.0.0
     *
     */
    function retina_blog_load_more() {

        check_ajax_referer( 'retina-blog-load-more-nonce', 'nonce' );

        $output['more_post'] = false;
        $output['content'] = array();

        $args['post_type'] = ( isset( $_GET['post_type']) && !empty($_GET['post_type'] ) ) ? esc_attr( $_GET['post_type'] ) : 'post';
        $args['post_status'] = 'publish';
        $args['paged'] = (int) esc_attr( $_GET['page'] );

        if( isset( $_GET['cat'] ) && isset( $_GET['taxonomy'] ) ){
            $args['tax_query'] = array(
                array(
                    'taxonomy' => esc_attr($_GET['taxonomy']),
                    'field'    => 'slug',
                    'terms'    => array(esc_attr($_GET['cat'])),
                ),
            );
        }

        if( isset($_GET['search']) ){
            $args['s'] = esc_attr( $_GET['search'] );
        }

        if( isset($_GET['author']) ){
            $args['author_name'] = esc_attr( $_GET['author'] );
        }

        if( isset($_GET['year']) || isset($_GET['month']) || isset($_GET['day']) ){

            $date_arr = array();

            if( !empty($_GET['year']) ){
                $date_arr['year'] = (int) esc_attr($_GET['year']);
            }
            if( !empty($_GET['month']) ){
                $date_arr['month'] = (int) esc_attr($_GET['month']);
            }
            if( !empty($_GET['day']) ){
                $date_arr['day'] = (int) esc_attr($_GET['day']);
            }

            if( !empty($date_arr) ){
                $args['date_query'] = array($date_arr);
            }
        }

        $loop = new WP_Query( $args );
        if($loop->max_num_pages > $args['paged']){
            $output['more_post'] = true;
        }
        if ( $loop->have_posts() ):
            while ( $loop->have_posts() ): $loop->the_post();
                ob_start();
                get_template_part('template-parts/content');
                $output['content'][] = ob_get_clean();
            endwhile;wp_reset_postdata();
            wp_send_json_success($output);
        else:
            $output['more_post'] = false;
            wp_send_json_error($output);
        endif;
        wp_die();
    }
endif;
add_action( 'wp_ajax_retina_blog_load_more', 'retina_blog_load_more' );
add_action( 'wp_ajax_nopriv_retina_blog_load_more', 'retina_blog_load_more' );


if (!function_exists('retina_blog_custom_posts_navigation')):
/**
 * Posts navigation.
 *
 * @since 1.0.0
 */
function retina_blog_custom_posts_navigation() {

    $pagination_type = retina_blog_get_option('pagination_type');

    switch ($pagination_type) {

        case 'default':
            the_posts_navigation();
            break;

        case 'numeric':
            the_posts_pagination();
            break;

        case 'infinite_scroll_load':
            retina_blog_ajax_pagination('scroll');
            break;

        default:
            break;
    }

}
endif;

add_action('retina_blog_action_posts_navigation', 'retina_blog_custom_posts_navigation');

if ( ! function_exists( 'retina_blog_simple_breadcrumb' ) ) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function retina_blog_simple_breadcrumb() {

        if ( ! function_exists( 'breadcrumb_trail' ) ) {

            require_once get_template_directory() . '/assets/breadcrumbs/breadcrumbs.php';
        }

        $breadcrumb_args = array(
            'container'   => 'div',
            'show_browse' => false,
        );
        breadcrumb_trail( $breadcrumb_args );

    }

endif;


if ( ! function_exists( 'retina_blog_add_breadcrumb' ) ) :

    /**
     * Add breadcrumb.
     *
     * @since 1.0.0
     */
    function retina_blog_add_breadcrumb() {

        // Bail if Breadcrumb disabled.
        $breadcrumb_type = retina_blog_get_option( 'breadcrumb_type' );
        if ( 'disabled' === $breadcrumb_type ) {
            return;
        }
        // Bail if Home Page.
        if ( is_front_page() || is_home() ) {
            return;
        }
        // Render breadcrumb.
        echo '<div class="col-md-12">';
        switch ( $breadcrumb_type ) {
            case 'simple':
                retina_blog_simple_breadcrumb();
            break;

            case 'advanced':
                if ( function_exists( 'bcn_display' ) ) {
                    bcn_display();
                }
            break;

            default:
            break;
        }
        echo '</div><!-- .container -->';
        return;

    }

endif;

add_action( 'retina_blog_action_breadcrumb', 'retina_blog_add_breadcrumb' , 10 );
