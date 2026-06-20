<?php
/**
 * Template Part: Kurikulum Section
 *
 * Reads from OnePress "Services / Icons" Customizer settings and renders
 * a responsive card grid of curriculum / program offerings.
 *
 * Customizer keys used (OnePress compatible):
 *   onepress_services_id          – section anchor ID
 *   onepress_services_title       – section heading
 *   onepress_services_subtitle    – section sub-heading
 *   onepress_services_numicons    – number of items (1–9)
 *   onepress_services_icon{n}     – Font Awesome class, e.g. "fa-book"
 *   onepress_services_title{n}    – card title
 *   onepress_services_content{n}  – card description
 *   onepress_services_link{n}     – optional card link URL
 *
 * @package sma_theresiana
 */

$section_id = get_theme_mod( 'onepress_services_id', 'services' );
$heading    = get_theme_mod( 'onepress_services_title', 'Kurikulum Kami' );
$subtitle   = get_theme_mod( 'onepress_services_subtitle', '' );
$num_items  = absint( get_theme_mod( 'onepress_services_numicons', 3 ) );
$num_items  = max( 1, min( $num_items, 9 ) );

// ── Build items from Customizer ────────────────────────────────────────────────
$items = [];
for ( $i = 1; $i <= $num_items; $i++ ) {
	$icon  = get_theme_mod( "onepress_services_icon{$i}", 'fa-book' );
	$title = get_theme_mod( "onepress_services_title{$i}", '' );
	$desc  = get_theme_mod( "onepress_services_content{$i}", '' );
	$link  = get_theme_mod( "onepress_services_link{$i}", '' );

	// Only include the item if at least a title or description exists.
	if ( $title || $desc ) {
		$items[] = [
			'icon'  => $icon  ?: 'fa-star',
			'title' => $title,
			'desc'  => $desc,
			'link'  => $link,
		];
	}
}

// ── Default placeholder items (used when Customizer has not been configured) ──
if ( empty( $items ) ) {
	$items = [
		[
			'icon'  => 'fa-book',
			'title' => 'Kurikulum Merdeka',
			'desc'  => 'Program kurikulum yang mengintegrasikan kebebasan belajar dengan standar akademis tinggi untuk menghasilkan siswa yang mandiri dan berdaya saing.',
			'link'  => '',
		],
		[
			'icon'  => 'fa-users',
			'title' => 'Staf Profesional',
			'desc'  => 'Tenaga pengajar bersertifikat dengan dedikasi penuh dan rekam jejak terbukti dalam mendampingi kemajuan akademik setiap siswa.',
			'link'  => '',
		],
		[
			'icon'  => 'fa-globe',
			'title' => 'Immersion Program',
			'desc'  => 'Program pembelajaran berbasis bahasa internasional untuk mempersiapkan siswa menghadapi era global dengan kepercayaan diri.',
			'link'  => '',
		],
		[
			'icon'  => 'fa-flask',
			'title' => 'Laboratorium Modern',
			'desc'  => 'Fasilitas laboratorium IPA, komputer, dan bahasa yang lengkap guna menunjang pembelajaran berbasis praktik dan eksperimen.',
			'link'  => '',
		],
		[
			'icon'  => 'fa-music',
			'title' => 'Seni & Budaya',
			'desc'  => 'Ekstrakurikuler seni musik, tari, dan drama yang menumbuhkan kreativitas serta apresiasi budaya lokal dan internasional.',
			'link'  => '',
		],
		[
			'icon'  => 'fa-trophy',
			'title' => 'Pembinaan Prestasi',
			'desc'  => 'Program olimpiade dan kompetisi akademik yang telah melahirkan banyak juara tingkat kota, provinsi, dan nasional.',
			'link'  => '',
		],
	];
}
?>

<section id="<?php echo esc_attr( $section_id ?: 'kurikulum' ); ?>"
	class="th-kurikulum th-section"
	aria-labelledby="th-kurikulum-heading">

	<div class="th-container">

		<!-- ── Section header ──────────────────────────────────────────────── -->
		<div class="th-section__header">
			<span class="th-eyebrow th-reveal">Program Kami</span>
			<h2 id="th-kurikulum-heading" class="th-heading-lg th-reveal th-reveal--delay-1">
				<?php echo wp_kses_post( $heading ); ?>
			</h2>
			<?php if ( $subtitle ) : ?>
			<p class="th-text-lead th-reveal th-reveal--delay-2">
				<?php echo wp_kses_post( $subtitle ); ?>
			</p>
			<?php endif; ?>
		</div><!-- .th-section__header -->

		<!-- ── Card grid ───────────────────────────────────────────────────── -->
		<div class="th-kurikulum__grid" role="list">
			<?php foreach ( $items as $i => $item ) :
				$delay = ( $i % 4 ) + 1; // Stagger: 1–4 repeat.
			?>
			<div class="th-kurikulum__card th-reveal th-reveal--delay-<?php echo absint( $delay ); ?>"
				role="listitem">

				<div class="th-kurikulum__card-icon" aria-hidden="true">
					<i class="fa <?php echo esc_attr( $item['icon'] ); ?>"></i>
				</div>

				<h3 class="th-kurikulum__card-title">
					<?php echo wp_kses_post( $item['title'] ); ?>
				</h3>

				<?php if ( $item['desc'] ) : ?>
				<p class="th-kurikulum__card-body">
					<?php echo wp_kses_post( $item['desc'] ); ?>
				</p>
				<?php endif; ?>

				<?php if ( $item['link'] ) : ?>
				<a href="<?php echo esc_url( $item['link'] ); ?>"
					class="th-kurikulum__card-link"
					aria-label="Selengkapnya tentang <?php echo esc_attr( wp_strip_all_tags( $item['title'] ) ); ?>">
					Selengkapnya <i class="fa fa-arrow-right" aria-hidden="true"></i>
				</a>
				<?php endif; ?>

			</div><!-- .th-kurikulum__card -->
			<?php endforeach; ?>
		</div><!-- .th-kurikulum__grid -->

	</div><!-- .th-container -->
</section><!-- .th-kurikulum -->
