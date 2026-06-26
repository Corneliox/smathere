<?php
/**
 * Template Name: Layanan Pengaduan
 *
 * Provides an anonymous complaint/whistleblowing form.
 *
 * @package SMA_Theresiana
 */

$form_success = false;
$form_error = '';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['th_submit_pengaduan'] ) ) {
    
    // Verify nonce for security
    if ( ! isset( $_POST['th_pengaduan_nonce'] ) || ! wp_verify_nonce( $_POST['th_pengaduan_nonce'], 'th_submit_pengaduan_action' ) ) {
        $form_error = 'Sesi telah habis. Harap muat ulang halaman.';
    } else {
        $subject = sanitize_text_field( wp_unslash( $_POST['pengaduan_subject'] ?? '' ) );
        $detail  = sanitize_textarea_field( wp_unslash( $_POST['pengaduan_detail'] ?? '' ) );

        if ( empty( $subject ) || empty( $detail ) ) {
            $form_error = 'Harap lengkapi Subjek dan Detail pengaduan Anda.';
        } else {
            // Save to database
            $post_id = wp_insert_post( [
                'post_title'   => 'Laporan: ' . $subject,
                'post_content' => $detail,
                'post_status'  => 'private', // Keep it private in DB
                'post_type'    => 'pengaduan',
            ] );

            if ( ! is_wp_error( $post_id ) ) {
                $form_success = true;
            } else {
                $form_error = 'Terjadi kesalahan sistem. Harap coba lagi nanti.';
            }
        }
    }
}

get_header();
?>

<main class="th-main th-main--inner">
    <div class="th-container" style="max-width: 800px;">
        
        <header class="th-section__header" style="text-align: center; margin-bottom: 40px;">
            <span class="th-eyebrow th-reveal">Layanan Anonim</span>
            <h1 class="th-heading-lg th-reveal th-reveal--delay-1">Kotak Pengaduan</h1>
            <p class="th-text-lead th-reveal th-reveal--delay-2" style="margin-top: 16px;">
                Identitas Anda **100% dirahasiakan**. Sampaikan kritik, saran, atau laporan Anda dengan aman.
            </p>
        </header>

        <div class="th-reveal th-reveal--delay-3">
            <div class="th-form-wrapper">
                
                <?php if ( $form_success ) : ?>
                    <div class="th-alert th-alert--success" style="padding: 24px; background: var(--th-green-50); border: 1px solid var(--th-green-500); border-radius: var(--th-radius-md); text-align: center; margin-bottom: 32px;">
                        <i class="fa fa-check-circle" style="font-size: 48px; color: var(--th-green-600); margin-bottom: 16px; display: block;"></i>
                        <h3 style="color: var(--th-green-800); margin-bottom: 8px;">Pengaduan Berhasil Terkirim!</h3>
                        <p style="color: var(--th-green-700); margin: 0;">Terima kasih atas laporan Anda. Pihak sekolah akan segera menindaklanjutinya.</p>
                        <a href="<?php echo esc_url( home_url('/') ); ?>" class="th-btn th-btn--primary" style="margin-top: 24px;">Kembali ke Beranda</a>
                    </div>
                <?php else : ?>
                    
                    <?php if ( $form_error ) : ?>
                        <div class="th-alert th-alert--error" style="padding: 16px; background: #fff1f0; border: 1px solid #ffa39e; border-radius: var(--th-radius-md); color: #cf1322; margin-bottom: 24px;">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true" style="margin-right: 8px;"></i>
                            <?php echo esc_html( $form_error ); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo esc_url( get_permalink() ); ?>" method="post" class="th-form">
                        <?php wp_nonce_field( 'th_submit_pengaduan_action', 'th_pengaduan_nonce' ); ?>
                        
                        <div class="th-form__group">
                            <label for="pengaduan_subject" class="th-form__label">Subjek Laporan <span style="color: #cf1322;">*</span></label>
                            <input type="text" id="pengaduan_subject" name="pengaduan_subject" class="th-form__input" placeholder="Misal: Fasilitas Kelas, Pelayanan Staf, dll" required>
                        </div>

                        <div class="th-form__group">
                            <label for="pengaduan_detail" class="th-form__label">Detail Laporan <span style="color: #cf1322;">*</span></label>
                            <textarea id="pengaduan_detail" name="pengaduan_detail" class="th-form__textarea" rows="6" placeholder="Ceritakan secara detail mengenai pengaduan Anda..." required></textarea>
                            <span class="th-form__help" style="font-size: 13px; color: var(--th-gray-500); margin-top: 8px; display: block;">
                                <i class="fa fa-lock" aria-hidden="true"></i> Laporan ini dienkripsi dan dikirim tanpa mencantumkan identitas Anda.
                            </span>
                        </div>

                        <div class="th-form__actions" style="margin-top: 32px; text-align: right;">
                            <button type="submit" name="th_submit_pengaduan" class="th-btn th-btn--primary">
                                Kirim Pengaduan <i class="fa fa-paper-plane" aria-hidden="true" style="margin-left: 8px;"></i>
                            </button>
                        </div>
                    </form>

                <?php endif; ?>

            </div>
        </div>

    </div>
</main>

<?php get_footer(); ?>
