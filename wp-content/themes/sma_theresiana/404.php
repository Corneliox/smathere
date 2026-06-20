<?php get_header(); ?>

<main class="th-main" id="main-content">
    <div class="th-container">
        <div class="th-404">
            <div class="th-404__code" aria-hidden="true">404</div>
            <h1 class="th-heading-md th-404__title">
                <?php esc_html_e('Halaman Tidak Ditemukan', 'sma-theresiana'); ?>
            </h1>
            <p class="th-text-lead th-404__body">
                <?php esc_html_e('Maaf, halaman yang Anda cari tidak ada atau sudah dipindahkan.', 'sma-theresiana'); ?>
            </p>
            <div class="th-404__actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="th-btn th-btn--primary">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <?php esc_html_e('Kembali ke Beranda', 'sma-theresiana'); ?>
                </a>
            </div>
            <div class="th-search-form" style="margin-top:40px;">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
