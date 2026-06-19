<?php

// Latest Destination Meta
function tour_operator_agency_bn_custom_meta_tour() {
    add_meta_box( 'bn_meta', __( 'Tour Packages', 'tour-operator-agency' ), 'tour_operator_agency_meta_callback_tour', 'post', 'normal', 'high' );
}

if (is_admin()){
  add_action('admin_menu', 'tour_operator_agency_bn_custom_meta_tour');
}

function tour_operator_agency_meta_callback_tour( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'tour_operator_agency_tour_meta_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    $packges_amount = get_post_meta( $post->ID, 'tour_operator_agency_packges_amount', true );
    ?>
    <div id="tour_custom_stuff">
        <table id="list">
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-8">
                    <td class="left">
                        <?php esc_html_e( 'Packages Amount', 'tour-operator-agency' )?>
                    </td>
                    <td class="left">
                        <input type="text" name="tour_operator_agency_packges_amount" id="tour_operator_agency_packges_amount" value="<?php echo esc_attr($packges_amount); ?>" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

/* Saves the custom meta input */
function tour_operator_agency_bn_metadesig_save( $post_id ) {
    if (!isset($_POST['tour_operator_agency_tour_meta_nonce']) || !wp_verify_nonce( strip_tags( wp_unslash( $_POST['tour_operator_agency_tour_meta_nonce']) ), basename(__FILE__))) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save
    if( isset( $_POST[ 'tour_operator_agency_packges_amount' ] ) ) {
        update_post_meta( $post_id, 'tour_operator_agency_packges_amount', strip_tags( wp_unslash( $_POST[ 'tour_operator_agency_packges_amount' ]) ) );
    }

}
add_action( 'save_post', 'tour_operator_agency_bn_metadesig_save' );