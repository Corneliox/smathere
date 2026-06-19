<?php
/**
 * The template for displaying the social icon
 *
 * @package Green Agro Landscaping
 * @subpackage green_agro_landscaping
 */

?>

<div class="social-media">
<?php if( get_theme_mod( 'green_agro_landscaping_facebook_url' ) != '') { ?>
		<a href="<?php echo esc_url( get_theme_mod( 'green_agro_landscaping_facebook_url','' ) ); ?>"><i class="fab fa-facebook-f"></i></a>
	<?php } ?>
	<?php if( get_theme_mod( 'green_agro_landscaping_twitter_url' ) != '') { ?>
		<a href="<?php echo esc_url( get_theme_mod( 'green_agro_landscaping_twitter_url','' ) ); ?>"><i class="fab fa-twitter"></i></a>
	<?php } ?>
	<?php if( get_theme_mod( 'green_agro_landscaping_instagram_url' ) != '') { ?>
		<a href="<?php echo esc_url( get_theme_mod( 'green_agro_landscaping_instagram_url','' ) ); ?>"><i class="fab fa-instagram"></i></a>
	<?php } ?>
	<?php if( get_theme_mod( 'green_agro_landscaping_youtube_url' ) != '') { ?>
		<a href="<?php echo esc_url( get_theme_mod( 'green_agro_landscaping_youtube_url','' ) ); ?>"><i class="fab fa-youtube"></i></a>
	<?php } ?>
	<?php if( get_theme_mod( 'green_agro_landscaping_pint_url' ) != '') { ?>
		<a href="<?php echo esc_url( get_theme_mod( 'green_agro_landscaping_pint_url','' ) ); ?>"><i class="fab fa-pinterest"></i></a>
	<?php } ?>
</div>
