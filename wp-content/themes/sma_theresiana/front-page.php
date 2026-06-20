<?php
/**
 * Front Page Template
 *
 * WordPress loads this file automatically when "Front page displays" is set
 * to "A static page" in Settings → Reading and this theme is active.
 * It can also be assigned manually via the "Template" dropdown on any page.
 *
 * Section order:
 *   1. Hero       – full-screen slider / single hero with CTA
 *   2. About      – split layout with school overview, stats, Visi & Misi
 *   3. Kurikulum  – program / curriculum card grid
 *   4. News       – horizontal news & activities card slider
 *   5. Video      – embedded YouTube school profile (hidden if not configured)
 *
 * Template Name: Front Page
 * Template Post Type: page
 *
 * @package sma_theresiana
 */

get_header();
?>

<main id="th-main" class="th-main" role="main">

	<?php
	/*
	 * ── 1. Hero ──────────────────────────────────────────────────────────────
	 * Full-screen slider reading from OnePress hero Customizer settings.
	 */
	get_template_part( 'template-parts/section', 'hero' );

	/*
	 * ── 2. About ─────────────────────────────────────────────────────────────
	 * Magazine-style two-column layout with image, stats, and Visi / Misi cards.
	 */
	get_template_part( 'template-parts/section', 'about' );

	/*
	 * ── 3. Kurikulum ─────────────────────────────────────────────────────────
	 * Responsive card grid of curriculum programs / OnePress services items.
	 */
	get_template_part( 'template-parts/section', 'kurikulum' );

	/*
	 * ── 4. News & Activities ─────────────────────────────────────────────────
	 * Horizontal swipeable news card slider from recent WordPress posts.
	 */
	get_template_part( 'template-parts/section', 'news' );

	/*
	 * ── 5. Video ─────────────────────────────────────────────────────────────
	 * Responsive YouTube embed (entire section hidden if no URL is configured).
	 */
	get_template_part( 'template-parts/section', 'video' );
	?>

</main><!-- #th-main -->

<?php
get_footer();
