<?php
/**
 * Beta Curriculum Section Template (Separate Card Layout + Skeleton Loader)
 */
$id       = 'kurikulum';
$title    = 'Kurikulum Sekolah';
$subtitle = 'Program & Kurikulum Akademik';
$desc     = 'SMA Theresiana menerapkan kurikulum inovatif untuk menunjang tumbuh kembang kompetensi akademis dan karakter siswa.';

// Try to fetch children of the "Kurikulum" page
$args = array(
	'post_type'      => 'page',
	'posts_per_page' => 4,
	'post_parent'    => get_page_by_path('kurikulum') ? get_page_by_path('kurikulum')->ID : 0,
	'orderby'        => 'menu_order',
	'order'          => 'ASC'
);
$query = new WP_Query( $args );
$cards = array();

if ( $query->have_posts() && $args['post_parent'] !== 0 ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$cards[] = array(
			'title' => get_the_title(),
			'desc'  => get_the_excerpt(),
			'link'  => get_permalink(),
			'icon'  => 'fa-graduation-cap' // Default icon
		);
	}
	wp_reset_postdata();
} else {
	// Fallback/Mock data to ensure a WOW design at first glance
	$cards = array(
		array(
			'title' => 'Kurikulum Merdeka',
			'desc'  => 'Pembelajaran berbasis proyek (P5) yang berfokus pada pengembangan soft skills, karakter profil Pelajar Pancasila, dan fleksibilitas minat siswa.',
			'link'  => '#',
			'icon'  => 'fa-book'
		),
		array(
			'title' => 'Program Akademik Unggulan',
			'desc'  => 'Pemilihan fokus jurusan MIPA & IPS dengan metode pembelajaran praktikum, studi lapangan, dan pembinaan olimpiade sains terintegrasi.',
			'link'  => '#',
			'icon'  => 'fa-flask'
		),
		array(
			'title' => 'Theresiana Character Building',
			'desc'  => 'Pendidikan karakter berdasarkan nilai-nilai Theresiana (kasih, disiplin, jujur, pelayanan) untuk mencetak generasi yang cerdas dan berbudi luhur.',
			'link'  => '#',
			'icon'  => 'fa-users'
		)
	);
}
?>

<section id="<?php echo esc_attr( $id ); ?>" class="section-kurikulum section-padding onepage-section section-kurikulum-beta">
	<div class="container">
		
		<div class="section-title-area">
			<h5 class="section-subtitle"><?php echo esc_html( $subtitle ); ?></h5>
			<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
			<div class="section-desc"><?php echo esc_html( $desc ); ?></div>
		</div>

		<!-- Skeleton Loader for Curriculum Cards -->
		<div id="kurikulum-skeleton" class="row kurikulum-skeleton-row">
			<?php for ( $i = 0; $i < count($cards); $i++ ) : ?>
				<div class="col-lg-4 col-md-6 col-sm-12">
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

		<!-- Actual Curriculum Cards -->
		<div id="kurikulum-cards-content" class="row kurikulum-cards-row" style="display: none; opacity: 0; transition: opacity 0.5s ease;">
			<?php foreach ( $cards as $card ) : ?>
				<div class="col-lg-4 col-md-6 col-sm-12 kurikulum-col wow slideInUp">
					<div class="kurikulum-card-item">
						<div class="kurikulum-card-icon">
							<i class="fa <?php echo esc_attr($card['icon']); ?>"></i>
						</div>
						<h3 class="kurikulum-card-title"><?php echo esc_html($card['title']); ?></h3>
						<p class="kurikulum-card-desc"><?php echo esc_html($card['desc']); ?></p>
						<a class="kurikulum-card-link" href="<?php echo esc_url($card['link']); ?>">
							Selengkapnya <i class="fa fa-arrow-right"></i>
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>

<script type="text/javascript">
jQuery(document).ready(function($) {
	// Simulate loading or wait for resources
	setTimeout(function() {
		$('#kurikulum-skeleton').fadeOut(300, function() {
			$('#kurikulum-cards-content').show().css('opacity', 1);
		});
	}, 1200);
});
</script>
