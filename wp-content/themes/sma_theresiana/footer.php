<?php
/**
 * The footer template for the SMA Theresiana theme.
 *
 * @package sma_theresiana
 */

// ── Customizer values ──────────────────────────────────────────────────────────
$contact_address = get_theme_mod('th_footer_address', 'Jl. Mayjend. Sutoyo No.69 Semarang, Jawa Tengah, Indonesia 50244');
$contact_phone   = get_theme_mod('th_footer_phone',   '(024) 8313374');
$contact_email   = get_theme_mod('th_footer_email',   'admin@smatheresiana1.sch.id');
$phone_clean     = preg_replace('/[^0-9+]/', '', $contact_phone);

$akreditasi_logo = get_theme_mod('th_footer_akreditasi_logo', home_url('/wp-content/uploads/2022/04/Akreditasi_Full.png'));
$unika_logo      = get_theme_mod('th_footer_unika_logo', home_url('/wp-content/uploads/2023/12/Logo-Soegijapranata-Catholic-University-SCU-1024x276-300x81.png'));

// ── QR codes ──────────────────────────────────────────────
$qr_ig        = get_theme_mod('th_footer_qr_instagram', home_url('/wp-content/uploads/2026/06/smatheresiana1_qr_Pass.png'));
$qr_ppdb      = get_theme_mod('th_footer_qr_ppdb', 'https://api.qrserver.com/v1/create-qr-code/?size=140x140&color=ddead1&bgcolor=4b6043&margin=8&data=' . urlencode(home_url('/ppdb/')));
$qr_pengaduan = get_theme_mod('th_footer_qr_pengaduan', 'https://api.qrserver.com/v1/create-qr-code/?size=140x140&color=ddead1&bgcolor=4b6043&margin=8&data=' . urlencode(home_url('/pengaduan/')));

// ── Footer navigation links ───────────────────────────────────────────────────
$footer_links = [
    ['label' => 'About Us',                         'url' => home_url('/#about')],
    ['label' => 'Guru dan Karyawan',                'url' => home_url('/guru-dan-karyawan/')],
    ['label' => 'Immersion is Smarter',             'url' => home_url('/immersion-is-smarter/')],
    ['label' => 'Open House 2026',                  'url' => home_url('/open-house-2026/')],
    ['label' => 'Reguler Plus: Young and Creative', 'url' => home_url('/reguler-plus-young-and-creative/')],
];
?>



<!-- ============================================================
     SITE FOOTER
     ============================================================ -->
<footer id="colophon" class="th-footer" role="contentinfo">

    <!-- ── MAIN FOOTER GRID ──────────────────────────────────── -->
    <div class="th-footer__main">
        <div class="th-container">
            <div class="th-footer__grid">

                <!-- COL 1 · Logo + Tagline + Unika Badges ───── -->
                <div class="th-footer__col th-footer__col--brand">

                    <!-- Brand Top (Logo + Akreditasi) -->
                    <div class="th-footer__brand-top">
                        <!-- Logo -->
                        <div class="th-footer__logo-card th-footer__logo-card--half">
                            <?php if (has_custom_logo()) : ?>
                                <?php echo get_custom_logo(); ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="th-footer__logo-text" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <!-- Akreditasi -->
                        <div class="th-footer__logo-card th-footer__logo-card--half">
                            <img src="<?php echo esc_url($akreditasi_logo); ?>" alt="Akreditasi Theresiana" class="th-footer__akreditasi-img">
                        </div>
                    </div>

                    <!-- Tagline -->
                    <?php $tagline = get_bloginfo('description'); if ($tagline) : ?>
                    <p class="th-footer__tagline"><?php echo esc_html($tagline); ?></p>
                    <?php endif; ?>

                    <!-- Unika Badges -->
                    <div class="th-footer__custom-badges">
                        <div class="th-footer__logo-card th-footer__logo-card--full">
                            <a href="<?php echo esc_url(home_url('/?beta=0')); ?>" class="th-footer__badge-link" title="Kembali ke versi 2018 (Ashe Theme)" style="width: 100%;">
                                <img src="<?php echo esc_url($unika_logo); ?>" alt="Logo Soegijapranata Catholic University" class="th-footer__badge-img">
                            </a>
                        </div>
                    </div><!-- .th-footer__custom-badges -->

                </div><!-- COL 1 -->


                <!-- COL 2 · Navigasi ─────────────────────────── -->
                <div class="th-footer__col th-footer__col--nav">
                    <h3 class="th-footer__heading">Navigasi</h3>
                    <ul class="th-footer__nav-list">
                        <?php foreach ($footer_links as $link) : ?>
                        <li class="th-footer__nav-item">
                            <a href="<?php echo esc_url($link['url']); ?>" class="th-footer__nav-link">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                <?php echo esc_html($link['label']); ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div><!-- COL 2 -->


                <!-- COL 3 · Lokasi & Kontak ─────────────────── -->
                <div class="th-footer__col th-footer__col--contact">
                    <h3 class="th-footer__heading">Lokasi &amp; Kontak</h3>

                    <!-- Google Maps Embed -->
                    <div class="th-footer__map-wrap">
                        <iframe
                            src="https://maps.google.com/maps?q=SMA+Theresiana+1+Semarang&t=&z=15&ie=UTF8&iwloc=&output=embed"
                            title="Peta Lokasi SMA Theresiana 1 Semarang"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen
                            aria-label="Google Maps – SMA Theresiana 1 Semarang"
                        ></iframe>
                    </div>

                    <!-- Contact List -->
                    <ul class="th-footer__contact-list">
                        <?php if ($contact_address) : ?>
                        <li class="th-footer__contact-item">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span><?php echo esc_html($contact_address); ?></span>
                        </li>
                        <?php endif; ?>

                        <?php if ($contact_phone) : ?>
                        <li class="th-footer__contact-item">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <a href="tel:<?php echo esc_attr($phone_clean); ?>">
                                <?php echo esc_html($contact_phone); ?>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if ($contact_email) : ?>
                        <li class="th-footer__contact-item">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            <a href="mailto:<?php echo esc_attr($contact_email); ?>">
                                <?php echo esc_html($contact_email); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul><!-- .th-footer__contact-list -->

                </div><!-- COL 3 -->


                <!-- COL 4 · QR Codes ────────────────────────── -->
                <div class="th-footer__col th-footer__col--qr">
                    <h3 class="th-footer__heading">QR Code</h3>
                    <div class="th-footer__qr-grid">

                        <!-- IG QR -->
                        <div class="th-footer__qr-item th-footer__qr-item--full">
                            <a href="https://instagram.com/smatheresiana1" target="_blank" rel="noopener">
                                <img src="<?php echo esc_url($qr_ig); ?>"
                                 alt="QR Code Instagram"
                                 width="140"
                                 height="140"
                                 loading="lazy">
                            </a>
                            <span class="th-footer__qr-label">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                                Instagram
                            </span>
                        </div>

                        <div class="th-footer__qr-row">
                            <!-- PPDB QR -->
                            <div class="th-footer__qr-item">
                                <a href="https://smatheresiana1.sch.id/smathere/ppdb/" target="_blank" rel="noopener">
                                    <img src="<?php echo esc_url($qr_ppdb); ?>"
                                        alt="QR Code PPDB"
                                        width="140"
                                        height="140"
                                        loading="lazy">
                                </a>
                                <span class="th-footer__qr-label">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    PPDB
                                </span>
                            </div>

                            <!-- Pengaduan QR -->
                            <div class="th-footer__qr-item">
                                <a href="https://smatheresiana1.sch.id/smathere/pengaduan/" target="_blank" rel="noopener">
                                    <img src="<?php echo esc_url($qr_pengaduan); ?>"
                                        alt="QR Code Pengaduan"
                                        width="140"
                                        height="140"
                                        loading="lazy">
                                </a>
                                <span class="th-footer__qr-label">
                                    <i class="fa fa-commenting-o" aria-hidden="true"></i>
                                    Pengaduan
                                </span>
                            </div>
                        </div>

                    </div><!-- .th-footer__qr-grid -->
                </div><!-- COL 4 -->

            </div><!-- .th-footer__grid -->
        </div><!-- .th-container -->
    </div><!-- .th-footer__main -->


    <!-- ── FOOTER BOTTOM BAR ─────────────────────────────────── -->
    <div class="th-footer__bottom">
        <div class="th-container">
            <div class="th-footer__bottom-inner">
                <p class="th-footer__copy">
                    &copy; <?php echo esc_html(date('Y')); ?>
                    <?php bloginfo('name'); ?>.
                    <?php esc_html_e('All rights reserved.', 'sma-theresiana'); ?>
                </p>
                <p class="th-footer__copy">
                    <?php esc_html_e('Powered by', 'sma-theresiana'); ?>
                    <a href="https://wordpress.org" target="_blank" rel="noopener noreferrer">WordPress</a>
                </p>
            </div><!-- .th-footer__bottom-inner -->
        </div><!-- .th-container -->
    </div><!-- .th-footer__bottom -->

</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>
