<?php
/**
 * Beta Hero Section Template (Slick Slider + Skeleton Loading)
 */
$id         = get_theme_mod( 'onepress_hero_id', esc_html__( 'hero', 'onepress' ) );
$fullscreen = sanitize_text_field( get_theme_mod( 'onepress_hero_fullscreen' ) );
$pdtop      = floatval( get_theme_mod( 'onepress_hero_pdtop', '10' ) );
$pdbottom   = floatval( get_theme_mod( 'onepress_hero_pdbotom', '10' ) );

$hero_content_style = '';
if ( $fullscreen != '1' ) {
	$hero_content_style = ' style="padding-top: ' . $pdtop . '%; padding-bottom: ' . $pdbottom . '%;"';
}

$_images = get_theme_mod( 'onepress_hero_images' );
if ( is_string( $_images ) ) {
	$_images = json_decode( $_images, true );
}

if ( empty( $_images ) || ! is_array( $_images ) ) {
	$_images = array();
}

$images = array();
foreach ( $_images as $m ) {
	$m  = wp_parse_args( $m, array( 'image' => '' ) );
	$_u = onepress_get_media_url( $m['image'] );
	if ( $_u ) {
		$images[] = $_u;
	}
}

if ( empty( $images ) ) {
	$images = array( get_template_directory_uri() . '/assets/images/hero5.jpg' );
}

// Get Hero Text settings
$hcl1_largetext  = get_theme_mod( 'onepress_hcl1_largetext', wp_kses_post( 'We are <span class="js-rotating">OnePress | One Page | Responsive | Perfection</span>', 'onepress' ) );
$hcl1_smalltext  = get_theme_mod( 'onepress_hcl1_smalltext', wp_kses_post( 'Morbi tempus porta nunc <strong>pharetra quisque</strong> ligula imperdiet posuere<br> vitae felis proin sagittis leo ac tellus blandit sollicitudin quisque vitae placerat.', 'onepress' ) );
$hcl1_btn1_text  = get_theme_mod( 'onepress_hcl1_btn1_text', esc_html__( 'Our Services', 'onepress' ) );
$hcl1_btn1_link  = get_theme_mod( 'onepress_hcl1_btn1_link', esc_url( home_url( '/' ) ) . esc_html__( '#services', 'onepress' ) );
$hcl1_btn2_text  = get_theme_mod( 'onepress_hcl1_btn2_text', esc_html__( 'Get Started', 'onepress' ) );
$hcl1_btn2_link  = get_theme_mod( 'onepress_hcl1_btn2_link', esc_url( home_url( '/' ) ) . esc_html__( '#contact', 'onepress' ) );

$btn_1_style = get_theme_mod( 'onepress_hcl1_btn1_style', 'btn-theme-primary' );
$btn_2_style = get_theme_mod( 'onepress_hcl1_btn2_style', 'btn-secondary-outline' );

$btn_1_target = get_theme_mod( 'onepress_hcl1_btn1_target' );
$btn_2_target = get_theme_mod( 'onepress_hcl1_btn2_target' );
$target_1 = ( $btn_1_target == 1 ) ? 'target="_blank"' : '';
$target_2 = ( $btn_2_target == 1 ) ? 'target="_blank"' : '';
?>

<!-- Skeleton Loader (Shimmer Placeholder) -->
<div id="hero-skeleton-loader" class="hero-skeleton-wrapper <?php echo ( $fullscreen == 1 ) ? 'hero-skeleton-fullscreen' : 'hero-skeleton-normal'; ?>">
	<div class="skeleton-shimmer"></div>
	<div class="container skeleton-content-box">
		<div class="skeleton-line skeleton-title"></div>
		<div class="skeleton-line skeleton-text-1"></div>
		<div class="skeleton-line skeleton-text-2"></div>
		<div class="skeleton-buttons">
			<div class="skeleton-btn"></div>
			<div class="skeleton-btn"></div>
		</div>
	</div>
</div>

<!-- Actual Slick Slider Carousel (Hidden initially, shown after load) -->
<section id="<?php echo esc_attr( $id ); ?>" class="hero-slideshow-wrapper hero-slick-slider-wrapper <?php echo ( $fullscreen == 1 ) ? 'hero-slideshow-fullscreen' : 'hero-slideshow-normal'; ?>" style="opacity: 0; transition: opacity 0.5s ease;">
	
	<div id="featured-slider" class="slick-slider-hero" data-slick='{"slidesToShow":1, "fade":true, "dots":true, "autoplay":true, "autoplaySpeed":5000, "arrows":true}'>
		<?php foreach ( $images as $image_url ) : ?>
			<div class="hero-slide-item" style="background-image: url('<?php echo esc_url( $image_url ); ?>');">
				<div class="hero-slide-overlay"></div>
				<div class="container hero-slide-container"<?php echo $hero_content_style; ?>>
					<div class="hero__content">
						<?php if ( $hcl1_largetext != '' ) : ?>
							<h2 class="hero-large-text"><?php echo wp_kses_post( $hcl1_largetext ); ?></h2>
						<?php endif; ?>
						<?php if ( $hcl1_smalltext != '' ) : ?>
							<p class="hero-small-text"><?php echo apply_filters( 'onepress_the_content', wp_kses_post( $hcl1_smalltext ) ); ?></p>
						<?php endif; ?>
						<div class="hero-buttons">
							<?php if ( $hcl1_btn1_text != '' && $hcl1_btn1_link != '' ) : ?>
								<a <?php echo $target_1; ?> href="<?php echo esc_url( $hcl1_btn1_link ); ?>" class="btn <?php echo esc_attr( $btn_1_style ); ?> btn-lg"><?php echo wp_kses_post( $hcl1_btn1_text ); ?></a>
							<?php endif; ?>
							<?php if ( $hcl1_btn2_text != '' && $hcl1_btn2_link != '' ) : ?>
								<a <?php echo $target_2; ?> href="<?php echo esc_url( $hcl1_btn2_link ); ?>" class="btn <?php echo esc_attr( $btn_2_style ); ?> btn-lg"><?php echo wp_kses_post( $hcl1_btn2_text ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	
</section>

<script type="text/javascript">
jQuery(document).ready(function($) {
	// Initialize Slick Slider
	var $slider = $('#featured-slider');
	
	$slider.on('init', function(event, slick){
		// Hide skeleton and fade in actual slider
		$('#hero-skeleton-loader').fadeOut(300, function() {
			$('.hero-slick-slider-wrapper').css('opacity', 1);
		});
	});
	
	// Fallback to show if slick doesn't load or takes too long
	setTimeout(function() {
		if ($('.hero-slick-slider-wrapper').css('opacity') == 0) {
			$('#hero-skeleton-loader').hide();
			$('.hero-slick-slider-wrapper').css('opacity', 1);
		}
	}, 2000);

	$slider.slick({
		slidesToShow: 1,
		fade: true,
		dots: true,
		autoplay: true,
		autoplaySpeed: 5000,
		arrows: true,
		prevArrow: '<span class="prev-arrow icon-left-open-big slick-arrow" style="display: inline-block;"></span>',
		nextArrow: '<span class="next-arrow icon-right-open-big slick-arrow" style="display: inline-block;"></span>'
	});
});
</script>
