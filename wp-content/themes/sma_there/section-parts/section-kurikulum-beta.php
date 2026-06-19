<?php
/**
 * Beta Curriculum Section Template (Separate Card Layout + Skeleton Loader)
 * Palet Hijau Theresiana — revisi 2026-06-20
 */
$id       = 'kurikulum';
$title    = 'Kurikulum Sekolah';
$subtitle = 'Program & Kurikulum Akademik';
$desc     = 'SMA Theresiana menerapkan kurikulum inovatif untuk menunjang tumbuh kembang kompetensi akademis dan karakter siswa.';

// Ambil halaman anak dari halaman "Kurikulum" jika ada
$kurikulum_page = get_page_by_path( 'kurikulum' );
$parent_id      = $kurikulum_page ? $kurikulum_page->ID : 0;

$args  = array(
	'post_type'      => 'page',
	'posts_per_page' => 4,
	'post_parent'    => $parent_id,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
);
$query = new WP_Query( $args );
$cards = array();

if ( $query->have_posts() && $parent_id !== 0 ) {
	$icons_map = array( 'fa-book', 'fa-flask', 'fa-users', 'fa-graduation-cap' );
	$ci        = 0;
	while ( $query->have_posts() ) {
		$query->the_post();
		$cards[] = array(
			'title' => get_the_title(),
			'desc'  => get_the_excerpt(),
			'link'  => get_permalink(),
			'icon'  => isset( $icons_map[ $ci ] ) ? $icons_map[ $ci ] : 'fa-graduation-cap',
		);
		$ci++;
	}
	wp_reset_postdata();
} else {
	/* Fallback / Mock data — hanya tampil jika belum ada konten halaman anak */
	$cards = array(
		array(
			'title' => 'Kurikulum Merdeka',
			'desc'  => 'Pembelajaran berbasis proyek (P5) yang berfokus pada pengembangan soft skills, karakter profil Pelajar Pancasila, dan fleksibilitas minat siswa.',
			'link'  => '#kurikulum',
			'icon'  => 'fa-book',
		),
		array(
			'title' => 'Program Akademik Unggulan',
			'desc'  => 'Pemilihan fokus jurusan MIPA & IPS dengan metode pembelajaran praktikum, studi lapangan, dan pembinaan olimpiade sains terintegrasi.',
			'link'  => '#kurikulum',
			'icon'  => 'fa-flask',
		),
		array(
			'title' => 'Theresiana Character Building',
			'desc'  => 'Pendidikan karakter berdasarkan nilai-nilai Theresiana (kasih, disiplin, jujur, pelayanan) untuk mencetak generasi yang cerdas dan berbudi luhur.',
			'link'  => '#kurikulum',
			'icon'  => 'fa-users',
		),
	);
}
?>

<section id="<?php echo esc_attr( $id ); ?>"
	class="section-kurikulum section-padding onepage-section section-kurikulum-beta">
	<div class="container">

		<!-- Section Title -->
		<div class="section-title-area">
			<h5 class="section-subtitle"><?php echo esc_html( $subtitle ); ?></h5>
			<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
			<div class="section-desc"><?php echo esc_html( $desc ); ?></div>
		</div>

		<!-- ── Skeleton Loader ── -->
		<div id="kurikulum-skeleton" class="row kurikulum-skeleton-row" aria-hidden="true">
			<?php for ( $i = 0; $i < count( $cards ); $i++ ) : ?>
				<div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:24px;">
					<div class="kurikulum-card-skeleton">
						<div class="skeleton-shimmer"></div>
						<div class="skeleton-circle"></div>
						<div class="skeleton-line skeleton-card-title"></div>
						<div class="skeleton-line skeleton-card-desc-1"></div>
						<div class="skeleton-line skeleton-card-desc-2"></div>
						<div class="skeleton-line skeleton-card-link"></div>
					</div>
				</div>
			<?php endfor; ?>
		</div>

		<!-- ── Actual Curriculum Cards ── -->
		<div id="kurikulum-cards-content"
			class="row kurikulum-cards-row"
			style="display:none; opacity:0; transition: opacity 0.5s ease;">

			<?php foreach ( $cards as $index => $card ) :
				$delay = round( $index * 0.12, 2 );
				?>
				<div class="col-lg-4 col-md-6 col-sm-12 kurikulum-col wow slideInUp" data-wow-delay="<?php echo $delay; ?>s" style="margin-bottom:30px;">
					<div class="kurikulum-card-item">

						<div class="kurikulum-card-icon" aria-hidden="true">
							<i class="fa <?php echo esc_attr( $card['icon'] ); ?>"></i>
						</div>

						<h3 class="kurikulum-card-title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p  class="kurikulum-card-desc"><?php echo esc_html( $card['desc'] ); ?></p>

						<a class="kurikulum-card-link" href="<?php echo esc_url( $card['link'] ); ?>">
							Selengkapnya <i class="fa fa-arrow-right" aria-hidden="true"></i>
						</a>

					</div><!-- .kurikulum-card-item -->
				</div>
			<?php endforeach; ?>

		</div><!-- #kurikulum-cards-content -->

	</div><!-- .container -->
</section>

<script type="text/javascript">
jQuery(document).ready(function($) {
	setTimeout(function() {
		$('#kurikulum-skeleton').fadeOut(350, function() {
			$('#kurikulum-cards-content').show().animate({ opacity: 1 }, 450);
		});
	}, 1000);
});
</script>
