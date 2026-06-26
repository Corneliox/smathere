<?php
/**
 * The template for displaying the blog posts index (Semua Berita).
 *
 * @package SMA_Theresiana
 */

get_header();
?>

<main class="th-main th-main--inner">
    <div class="th-container">
        
        <header class="th-section__header" style="text-align: center; margin-bottom: 40px;">
            <span class="th-eyebrow th-reveal">Kabar Terbaru</span>
            <h1 class="th-heading-lg th-reveal th-reveal--delay-1">Semua Berita</h1>
        </header>

        <div class="th-reveal th-reveal--delay-2">
            <?php get_template_part( 'template-parts/archive', 'berita' ); ?>
        </div>

    </div>
</main>

<?php get_footer(); ?>
