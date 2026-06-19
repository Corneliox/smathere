<?php
/**
 * The front page template file
 *
 * @package Green Agro Landscaping
 * @subpackage green_agro_landscaping
 */

get_header(); ?>

<main id="tp_content" role="main">
	<?php do_action( 'green_agro_landscaping_before_slider' ); ?>

	<?php get_template_part( 'template-parts/home/slider' ); ?>
	<?php do_action( 'green_agro_landscaping_after_slider' ); ?>

	<?php get_template_part( 'template-parts/home/about' ); ?>
	<?php do_action( 'green_agro_landscaping_after_about' ); ?>

	<?php get_template_part( 'template-parts/home/home-content' ); ?>
	<?php do_action( 'green_agro_landscaping_after_home_content' ); ?>
</main>

<?php get_footer();
