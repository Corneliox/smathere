<?php
/**
 * Template Part: Hero Section
 *
 * Reads from OnePress Customizer settings.
 * Renders a full-screen slider (or single hero) with background image,
 * overlay, content, dot navigation, arrow navigation, and a scroll indicator.
 *
 * @package sma_theresiana
 */

$slides_raw    = get_theme_mod( 'onepress_hero_slides', '' );
$slides        = $slides_raw ? maybe_unserialize( $slides_raw ) : [];
$hero_bg       = get_theme_mod( 'onepress_hero_bg', '' );
$default_title = get_bloginfo( 'name' );
$default_desc  = get_bloginfo( 'description' );

// Build slides array — fall back to single slide from scalar customizer keys.
if ( empty( $slides ) || ! is_array( $slides ) ) {
	$slides = [
		[
			'title'       => get_theme_mod( 'onepress_hero_title', $default_title ),
			'description' => get_theme_mod( 'onepress_hero_description', $default_desc ),
			'btn_text'    => get_theme_mod( 'onepress_hero_btn_text', 'Selengkapnya' ),
			'btn_link'    => get_theme_mod( 'onepress_hero_btn_link', home_url( '/#about' ) ),
			'btn2_text'   => get_theme_mod( 'onepress_hero_btn2_text', '' ),
			'btn2_link'   => get_theme_mod( 'onepress_hero_btn2_link', '' ),
			'bg'          => $hero_bg,
		],
	];
}

$slide_count = count( $slides );
?>

<section class="th-hero" id="hero" aria-label="Hero Banner">
	<div class="th-hero__slider"
		data-autoplay="5500"
		role="region"
		aria-roledescription="carousel"
		aria-label="Hero Slideshow">

		<?php foreach ( $slides as $i => $slide ) :
			// Support both 'bg' and 'background' keys used by different OnePress versions.
			$bg     = ! empty( $slide['bg'] ) ? $slide['bg']
					: ( ! empty( $slide['background'] ) ? $slide['background'] : $hero_bg );
			$active = ( 0 === $i ) ? 'th-hero__slide--active' : '';
		?>
		<div class="th-hero__slide <?php echo esc_attr( $active ); ?>"
			role="group"
			aria-roledescription="slide"
			aria-label="Slide <?php echo absint( $i + 1 ); ?> dari <?php echo absint( $slide_count ); ?>"
			<?php echo ( 0 === $i ) ? '' : 'aria-hidden="true"'; ?>>

			<?php if ( $bg ) : ?>
			<img
				src="<?php echo esc_url( $bg ); ?>"
				alt=""
				class="th-hero__bg"
				fetchpriority="<?php echo 0 === $i ? 'high' : 'low'; ?>"
				loading="<?php echo 0 === $i ? 'eager' : 'lazy'; ?>"
				decoding="<?php echo 0 === $i ? 'sync' : 'async'; ?>"
			>
			<?php endif; ?>

			<div class="th-hero__overlay" aria-hidden="true"></div>

			<div class="th-hero__content th-container">

				<?php if ( ! empty( $slide['eyebrow'] ) ) : ?>
				<span class="th-hero__eyebrow th-eyebrow">
					<?php echo esc_html( $slide['eyebrow'] ); ?>
				</span>
				<?php else : ?>
				<span class="th-hero__eyebrow th-eyebrow">SMA Theresiana 1 Semarang</span>
				<?php endif; ?>

				<?php if ( ! empty( $slide['title'] ) ) : ?>
				<h1 class="th-hero__title">
					<?php echo wp_kses_post( $slide['title'] ); ?>
				</h1>
				<?php endif; ?>

				<?php if ( ! empty( $slide['description'] ) ) : ?>
				<p class="th-hero__subtitle">
					<?php echo wp_kses_post( $slide['description'] ); ?>
				</p>
				<?php endif; ?>

				<div class="th-hero__actions">
					<?php if ( ! empty( $slide['btn_text'] ) ) : ?>
					<a href="<?php echo esc_url( $slide['btn_link'] ?? home_url( '/' ) ); ?>"
						class="th-btn th-btn--primary">
						<?php echo esc_html( $slide['btn_text'] ); ?>
						<i class="fa fa-arrow-right" aria-hidden="true"></i>
					</a>
					<?php endif; ?>

					<?php if ( ! empty( $slide['btn2_text'] ) ) : ?>
					<a href="<?php echo esc_url( $slide['btn2_link'] ?? '#' ); ?>"
						class="th-btn th-btn--outline">
						<?php echo esc_html( $slide['btn2_text'] ); ?>
					</a>
					<?php endif; ?>
				</div><!-- .th-hero__actions -->

			</div><!-- .th-hero__content -->
		</div><!-- .th-hero__slide -->
		<?php endforeach; ?>

		<?php if ( $slide_count > 1 ) : ?>
		<!-- ── Dot navigation ── -->
		<div class="th-hero__dots" role="tablist" aria-label="Navigasi slide hero">
			<?php foreach ( $slides as $i => $slide ) : ?>
			<button
				class="th-hero__dot <?php echo 0 === $i ? 'th-hero__dot--active' : ''; ?>"
				role="tab"
				aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"
				aria-label="Pergi ke slide <?php echo absint( $i + 1 ); ?>"
				data-slide="<?php echo absint( $i ); ?>"
				tabindex="<?php echo 0 === $i ? '0' : '-1'; ?>">
			</button>
			<?php endforeach; ?>
		</div><!-- .th-hero__dots -->

		<!-- ── Arrow navigation ── -->
		<button class="th-hero__arrow th-hero__arrow--prev" aria-label="Slide sebelumnya">
			<i class="fa fa-chevron-left" aria-hidden="true"></i>
		</button>
		<button class="th-hero__arrow th-hero__arrow--next" aria-label="Slide berikutnya">
			<i class="fa fa-chevron-right" aria-hidden="true"></i>
		</button>
		<?php endif; ?>

		<!-- ── Scroll indicator ── -->
		<div class="th-hero__scroll" aria-hidden="true" title="Scroll ke bawah">
			<span class="th-hero__scroll-line"></span>
		</div>

	</div><!-- .th-hero__slider -->
</section><!-- .th-hero -->

<?php
/*
 * ─────────────────────────────────────────────────────────────────────────────
 * INLINE CSS  (hero-specific only; global design tokens live in style.css)
 * ─────────────────────────────────────────────────────────────────────────────
 *
 * .th-hero__scroll  — animated scroll indicator, pinned to the bottom-centre
 *                     of the hero, consists of a thin white line that pulses
 *                     downwards via a CSS keyframe animation.
 *
 * All other hero styles (layout, slide, overlay, buttons, dots, arrows)
 * are in assets/css/sections/_hero.scss / style.css.
 * ─────────────────────────────────────────────────────────────────────────────
 */
?>
<style id="th-hero-scroll-css">
/* ── Scroll indicator ── */
.th-hero__scroll {
	position: absolute;
	bottom: 2.25rem;
	left: 50%;
	transform: translateX(-50%);
	display: flex;
	flex-direction: column;
	align-items: center;
	z-index: 10;
	pointer-events: none;
}

.th-hero__scroll-line {
	display: block;
	width: 2px;
	height: 48px;
	background: linear-gradient(
		to bottom,
		rgba(255, 255, 255, 0) 0%,
		rgba(255, 255, 255, 0.85) 50%,
		rgba(255, 255, 255, 0) 100%
	);
	border-radius: 1px;
	animation: th-scroll-pulse 1.8s ease-in-out infinite;
	transform-origin: top center;
}

@keyframes th-scroll-pulse {
	0%   { transform: scaleY(0);   opacity: 0;   transform-origin: top center; }
	30%  { opacity: 1; }
	60%  { transform: scaleY(1);   opacity: 1;   transform-origin: top center; }
	100% { transform: scaleY(0);   opacity: 0;   transform-origin: bottom center; }
}

/* Reduce motion preference */
@media (prefers-reduced-motion: reduce) {
	.th-hero__scroll-line {
		animation: none;
		opacity: 0.55;
	}
}
</style>
