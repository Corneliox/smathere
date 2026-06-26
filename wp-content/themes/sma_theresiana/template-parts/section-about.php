<?php
/**
 * Template Part: About Section
 *
 * Reads from OnePress Customizer settings.
 * Renders a magazine-style two-column layout with an image, stat counters,
 * and Visi / Misi feature cards below.
 *
 * @package sma_theresiana
 */

$section_id = get_theme_mod( 'onepress_about_id', 'about' );
$heading    = get_theme_mod( 'onepress_about_title', 'Tentang Kami' );
$subheading = get_theme_mod( 'onepress_about_subtitle', '' );
$about_img  = get_theme_mod( 'onepress_about_image', '' );
$btn_text   = get_theme_mod( 'onepress_about_btn_text', 'Selengkapnya' );
$btn_link   = get_theme_mod( 'onepress_about_btn_link', home_url( '/about/' ) );

/*
 * Optionally pull long-form content from a dedicated About page.
 * onepress_about_page stores the page ID as an integer; if it is not set,
 * fall back gracefully with an empty string.
 */
$about_page_id  = absint( get_theme_mod( 'onepress_about_page', 0 ) );
$about_content  = '';
if ( $about_page_id ) {
	$about_page = get_post( $about_page_id );
	if ( $about_page && 'publish' === $about_page->post_status ) {
		$about_content = apply_filters( 'the_content', $about_page->post_content );
		// Use the page title as the section heading if none was set in Customizer.
		if ( empty( $heading ) ) {
			$heading = $about_page->post_title;
		}
	}
}

// ── Stats ─────────────────────────────────────────────────────────────────────
$stats = [
	[
		'num'   => get_theme_mod( 'onepress_about_stat1_num',   '40+' ),
		'label' => get_theme_mod( 'onepress_about_stat1_label', 'Tahun Berdiri' ),
	],
	[
		'num'   => get_theme_mod( 'onepress_about_stat2_num',   '±20' ),
		'label' => get_theme_mod( 'onepress_about_stat2_label', 'Tenaga Pengajar' ),
	],
	[
		'num'   => get_theme_mod( 'onepress_about_stat3_num',   '2000+' ),
		'label' => get_theme_mod( 'onepress_about_stat3_label', 'Alumni' ),
	],
];

// ── Visi / Misi cards ─────────────────────────────────────────────────────────
$visimisi = [
	[
		'icon'  => 'fa-eye',
		'title' => 'Visi',
		'body'  => get_theme_mod(
			'onepress_about_vision',
			'Mewujudkan generasi penerus bangsa yang cerdas dan berkarakter sesuai dengan nilai-nilai Santa Theresia.'
		),
	],
	[
		'icon'  => 'fa-rocket',
		'title' => 'Misi',
		'body'  => get_theme_mod(
			'onepress_about_mission',
			'Menyelenggarakan pelayanan pendidikan melalui pembelajaran yang inovatif, bernalar kritis, kreatif, bermakna, dan kompetitif.<br>
			Menanamkan nilai-nilai Santa Theresia yaitu sukacita, disiplin, jujur, dan peduli dalam pembelajaran.<br>
			Meningkatkan kualitas SDM agar mampu memberikan pembelajaran yang berbasis teknologi dan berkebhinekaan global.<br>
			Mendampingi peserta didik dalam mengembangkan potensi sehingga mampu berprestasi.<br>
			Menyediakan sarana dan prasarana yang memadai dan modern.'
		),
	],
];
?>

<section id="<?php echo esc_attr( $section_id ?: 'about' ); ?>"
	class="th-about th-section"
	aria-labelledby="th-about-heading">

	<div class="th-container">

		<!-- ── Two-column split ─────────────────────────────────────────────── -->
		<div class="th-about__inner">

			<!-- Content column -->
			<div class="th-about__content">

				<span class="th-eyebrow th-reveal">Mengenal Kami</span>

				<h2 id="th-about-heading" class="th-heading-lg th-reveal th-reveal--delay-1">
					<?php echo wp_kses_post( $heading ); ?>
				</h2>

				<?php if ( $subheading ) : ?>
				<p class="th-text-lead th-reveal th-reveal--delay-2">
					<?php echo wp_kses_post( $subheading ); ?>
				</p>
				<?php endif; ?>

				<?php if ( $about_content ) : ?>
				<div class="th-about__body th-reveal th-reveal--delay-2">
					<?php echo $about_content; // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
				<?php endif; ?>

				<?php if ( $btn_text ) : ?>
				<div class="th-about__actions th-reveal th-reveal--delay-3">
					<a href="<?php echo esc_url( $btn_link ); ?>" class="th-btn th-btn--primary">
						<?php echo esc_html( $btn_text ); ?>
						<i class="fa fa-arrow-right" aria-hidden="true"></i>
					</a>
				</div>
				<?php endif; ?>

				<!-- ── Stats ─────────────────────────────────────────────── -->
				<div class="th-about__stats th-reveal th-reveal--delay-3" aria-label="Statistik sekolah">
					<?php foreach ( $stats as $stat ) :
						if ( empty( $stat['num'] ) && empty( $stat['label'] ) ) continue;
					?>
					<div class="th-about__stat">
						<span class="th-about__stat-num" aria-hidden="true">
							<?php echo esc_html( $stat['num'] ); ?>
						</span>
						<span class="th-about__stat-label">
							<?php echo esc_html( $stat['label'] ); ?>
						</span>
					</div>
					<?php endforeach; ?>
				</div><!-- .th-about__stats -->

			</div><!-- .th-about__content -->

			<!-- Image column -->
			<div class="th-about__image-col th-reveal th-reveal--right">
				<?php if ( $about_img ) : ?>
				<img
					src="<?php echo esc_url( $about_img ); ?>"
					alt="<?php echo esc_attr( wp_strip_all_tags( $heading ) ); ?>"
					class="th-about__image"
					loading="lazy"
					decoding="async"
				>
				<?php else : ?>
				<figure class="wp-block-embed-youtube wp-block-embed is-type-video is-provider-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio" style="margin: 0; width: 100%; overflow: hidden; border-radius: var(--th-radius-xl); box-shadow: var(--th-shadow-xl);">
					<div class="wp-block-embed__wrapper" style="position: relative; padding-bottom: 56.25%; height: 0;">
						<iframe title="Profil SMA Theresiana 1 Semarang 2026" width="960" height="540" src="https://www.youtube.com/embed/rEfp5Cywj9k?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
					</div>
				</figure>
				<?php endif; ?>

				<!-- Decorative accent blobs (CSS-only, aria-hidden) -->
				<span class="th-about__image-accent th-about__image-accent--tl" aria-hidden="true"></span>
				<span class="th-about__image-accent th-about__image-accent--br" aria-hidden="true"></span>
			</div><!-- .th-about__image-col -->

		</div><!-- .th-about__inner -->

		<!-- ── Visi / Misi feature cards ────────────────────────────────────── -->
		<div class="th-visimisi" aria-label="Visi dan Misi">
			<div class="th-visimisi__cards">
				<?php foreach ( $visimisi as $i => $item ) : ?>
				<div class="th-visimisi__card th-reveal th-reveal--delay-<?php echo absint( $i + 1 ); ?>">
					<div class="th-visimisi__icon" aria-hidden="true">
						<i class="fa <?php echo esc_attr( $item['icon'] ); ?>"></i>
					</div>
					<h3 class="th-visimisi__heading">
						<?php echo esc_html( $item['title'] ); ?>
					</h3>
					<p class="th-visimisi__body">
						<?php echo wp_kses_post( $item['body'] ); ?>
					</p>
				</div><!-- .th-visimisi__card -->
				<?php endforeach; ?>
			</div><!-- .th-visimisi__cards -->
		</div><!-- .th-visimisi -->

	</div><!-- .th-container -->
</section><!-- .th-about -->
