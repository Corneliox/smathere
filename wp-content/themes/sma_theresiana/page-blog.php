<?php
/**
 * Template Name: Blog / Semua Berita
 *
 * This template ensures the blog archive works even if the user hasn't
 * formally set a "Posts Page" in WP Settings > Reading.
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
