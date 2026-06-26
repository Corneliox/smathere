<?php
/**
 * Template Name: PPDB (Penerimaan Peserta Didik Baru)
 *
 * Displays an archive of news containing the keyword "PPDB".
 *
 * @package SMA_Theresiana
 */

get_header();
?>

<main class="th-main th-main--inner">
    <div class="th-container">
        
        <header class="th-section__header" style="text-align: center; margin-bottom: 40px;">
            <span class="th-eyebrow th-reveal">Penerimaan Peserta Didik Baru</span>
            <h1 class="th-heading-lg th-reveal th-reveal--delay-1">Informasi PPDB</h1>
        </header>

        <div class="th-reveal th-reveal--delay-2">
            <?php 
            // Pass search query 's' => 'ppdb' to the archive template
            get_template_part( 'template-parts/archive', 'berita', [
                's' => 'ppdb'
            ] ); 
            ?>
        </div>

    </div>
</main>

<?php get_footer(); ?>
