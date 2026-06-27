<?php
/**
 * Template Name: Tentang Kami (About)
 *
 * A dedicated page for "About Us" content.
 *
 * @package SMA_Theresiana
 */

get_header();

// Fetch content from the page editor
$page_content = '';
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        $page_content = get_the_content();
    }
}
?>

<main class="th-main th-main--inner">
    <div class="th-container">
        
        <header class="th-section__header" style="text-align: center; margin-bottom: 40px;">
            <span class="th-eyebrow th-reveal">Profil Sekolah</span>
            <h1 class="th-heading-lg th-reveal th-reveal--delay-1"><?php the_title(); ?></h1>
        </header>

        <div class="th-reveal th-reveal--delay-2">
            <?php if ( ! empty( $page_content ) ) : ?>
                <div class="th-content-prose" style="max-width: 800px; margin: 0 auto; font-size: 16px; line-height: 1.8; color: var(--th-gray-700);">
                    <?php echo apply_filters( 'the_content', $page_content ); ?>
                </div>
            <?php else : ?>
                <!-- Fallback to showing the literal HTML content if the WP editor is empty -->
                <?php get_template_part( 'template-parts/content', 'about-fallback' ); ?>
            <?php endif; ?>
        </div>

    </div>
</main>

<?php get_footer(); ?>
