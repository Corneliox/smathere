<?php
/**
 * Implement theme metabox.
 *
 * @package retina-blog
 */

if ( ! function_exists( 'retina_blog_add_theme_meta_box' ) ) :

    /**
     * Add the Meta Box
     *
     * @since 1.0.0
     */
    function retina_blog_add_theme_meta_box() {

        $apply_metabox_post_types = array( 'post', 'page' );

        foreach ( $apply_metabox_post_types as $key => $type ) {
            add_meta_box(
                'retina-blog-theme-settings',
                esc_html__( 'Single Page/Post Settings', 'retina-blog' ),
                'retina_blog_render_theme_settings_metabox',
                $type
            );
        }

    }

endif;

add_action( 'add_meta_boxes', 'retina_blog_add_theme_meta_box' );

if ( ! function_exists( 'retina_blog_render_theme_settings_metabox' ) ) :

    /**
     * Render theme settings meta box.
     *
     * @since 1.0.0
     */
    function retina_blog_render_theme_settings_metabox( $post, $metabox ) {

        $post_id = $post->ID;
        $retina_blog_post_meta_value = get_post_meta($post_id);

        // Meta box nonce for verification.
        wp_nonce_field( basename( __FILE__ ), 'retina_blog_meta_box_nonce' );
        // Fetch Options list.
        $page_layout = get_post_meta($post_id,'retina-blog-meta-select-layout',true);

        ?>
        <div id="retina-blog-settings-metabox-container" class="retina-blog-settings-metabox-container">
            <div id="retina-blog-settings-metabox-tab-layout">
                <h4><?php echo __( 'Layout Settings', 'retina-blog' ); ?></h4>
                <div class="retina-blog-row-content">
                    <!-- Select Field-->
                                        <p>
                    <div class="retina-blog-row-content">
                        <label for="retina-blog-meta-checkbox">
                            <input type="checkbox" name="retina-blog-meta-checkbox" id="retina-blog-meta-checkbox"
                                   value="yes" <?php if (isset ($retina_blog_post_meta_value['retina-blog-meta-checkbox'])) checked($retina_blog_post_meta_value['retina-blog-meta-checkbox'][0], 'yes'); ?> />
                            <?php _e('Check To Dissable Featured Image on Single Page/Post', 'retina-blog') ?>
                        </label>
                    </div>
                    </p>
                    <p>
                        <label for="retina-blog-meta-select-layout" class="retina-blog-row-title">
                            <?php _e( 'Single Page/Post Layout', 'retina-blog' )?>
                        </label>
                        <select name="retina-blog-meta-select-layout" id="retina-blog-meta-select-layout">
                            <option value="left-sidebar" <?php selected('left-sidebar',$page_layout);?>>
                                <?php _e( 'Primary Sidebar - Content', 'retina-blog' )?>
                            </option>
                            <option value="right-sidebar" <?php selected('right-sidebar',$page_layout);?>>
                                <?php _e( 'Content - Primary Sidebar', 'retina-blog' )?>
                            </option>
                            <option value="no-sidebar" <?php selected('no-sidebar',$page_layout);?>>
                                <?php _e( 'No Sidebar', 'retina-blog' )?>
                            </option>
                        </select>
                    </p>
                </div><!-- .retina-blog-row-content -->
            </div><!-- #retina-blog-settings-metabox-tab-layout -->
        </div><!-- #retina-blog-settings-metabox-container -->

        <?php
    }

endif;



if ( ! function_exists( 'retina_blog_save_theme_settings_meta' ) ) :

    /**
     * Save theme settings meta box value.
     *
     * @since 1.0.0
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post Post object.
     */
    function retina_blog_save_theme_settings_meta( $post_id, $post ) {

        // Verify nonce.
        if ( ! isset( $_POST['retina_blog_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['retina_blog_meta_box_nonce'], basename( __FILE__ ) ) ) {
            return; }

        // Bail if auto save or revision.
        if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
            return;
        }

        // Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
        if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
            return;
        }

        // Check permission.
        if ( 'page' === $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return; }
        } else if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        $retina_blog_meta_checkbox = isset($_POST['retina-blog-meta-checkbox']) ? esc_attr($_POST['retina-blog-meta-checkbox']) : '';
        update_post_meta($post_id, 'retina-blog-meta-checkbox', sanitize_text_field($retina_blog_meta_checkbox));


        $retina_blog_meta_select_layout =  isset( $_POST[ 'retina-blog-meta-select-layout' ] ) ? esc_attr($_POST[ 'retina-blog-meta-select-layout' ]) : '';
        if(!empty($retina_blog_meta_select_layout)){
            update_post_meta($post_id, 'retina-blog-meta-select-layout', sanitize_text_field($retina_blog_meta_select_layout));
        }
    }

endif;

add_action( 'save_post', 'retina_blog_save_theme_settings_meta', 10, 2 );