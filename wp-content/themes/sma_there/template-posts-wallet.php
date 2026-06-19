<?php
/**
 * Template Name: Wallet Archive Template
 *
 * Menampilkan semua postingan artikel dalam visualisasi "Dompet" (Wallet layout)
 * dikelompokkan berdasarkan Tahun.
 */

get_header();

// Fetch all posts to group by year
$args = array(
	'post_type'      => 'post',
	'posts_per_page' => -1, // Fetch all posts
	'post_status'    => 'publish',
	'orderby'        => 'date',
	'order'          => 'DESC'
);
$query = new WP_Query( $args );

$posts_by_year = array();

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$year = get_the_date('Y');
		$posts_by_year[$year][] = array(
			'title'     => get_the_title(),
			'link'      => get_permalink(),
			'date'      => get_the_date(),
			'thumb'     => has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'onepress-small' ) : '',
			'excerpt'   => wp_trim_words( get_the_excerpt(), 15, '...' ),
			'category'  => get_the_category_list( ', ' )
		);
	}
	wp_reset_postdata();
}

// Get the sorted years list
$years = array_keys( $posts_by_year );
sort( $years );
$years = array_reverse( $years ); // Latest year first
?>

<div id="content" class="site-content wallet-posts-archive-page">
	<div class="page-header">
		<div class="container">
			<h1 class="page-title">Arsip Berita & Artikel</h1>
			<p class="page-subtitle">Disusun berdasarkan folder tahun (Wallet Archive)</p>
		</div>
	</div>

	<?php if ( function_exists('onepress_breadcrumb') ) onepress_breadcrumb(); ?>

	<div class="container">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php if ( ! empty( $posts_by_year ) ) : ?>
					
					<!-- Wallet Container -->
					<div class="wallet-container">
						
						<!-- Wallet Card Slots (Tabs) -->
						<div class="wallet-tabs-slots">
							<?php 
							$is_first = true;
							foreach ( $years as $year ) : 
								$active_class = $is_first ? 'active-slot' : '';
								$post_count = count( $posts_by_year[$year] );
								?>
								<button class="wallet-slot-tab <?php echo $active_class; ?>" data-year="<?php echo esc_attr( $year ); ?>">
									<span class="slot-tab-header">
										<i class="fa fa-folder-open-o"></i> <?php echo esc_html( $year ); ?>
									</span>
									<span class="slot-tab-badge"><?php echo $post_count; ?> posts</span>
								</button>
								<?php 
								$is_first = false;
							endforeach; 
							?>
						</div>

						<!-- Wallet Content Sleeve (Pocket Contents) -->
						<div class="wallet-pocket-contents">
							<?php 
							$is_first = true;
							foreach ( $years as $year ) : 
								$active_style = $is_first ? 'display: block; opacity: 1;' : 'display: none; opacity: 0;';
								?>
								<div id="pocket-<?php echo esc_attr( $year ); ?>" class="wallet-year-pocket" style="<?php echo $active_style; ?>">
									<h2 class="pocket-year-title"><i class="fa fa-archive"></i> Tahun <?php echo esc_html( $year ); ?></h2>
									
									<div class="row pocket-grid-row">
										<?php foreach ( $posts_by_year[$year] as $item ) : ?>
											<div class="col-lg-4 col-md-6 col-sm-12 pocket-item-col">
												<div class="pocket-article-card">
													<?php if ( $item['thumb'] ) : ?>
														<div class="pocket-card-thumb">
															<a href="<?php echo esc_url($item['link']); ?>">
																<?php echo $item['thumb']; ?>
															</a>
														</div>
													<?php endif; ?>
													
													<div class="pocket-card-body">
														<div class="pocket-card-meta">
															<span class="pocket-card-cat"><?php echo $item['category']; ?></span>
															<span class="pocket-card-date"><?php echo esc_html($item['date']); ?></span>
														</div>
														<h3 class="pocket-card-title">
															<a href="<?php echo esc_url($item['link']); ?>"><?php echo esc_html($item['title']); ?></a>
														</h3>
														<p class="pocket-card-excerpt"><?php echo esc_html($item['excerpt']); ?></p>
														<a class="pocket-card-more" href="<?php echo esc_url($item['link']); ?>">Selengkapnya <i class="fa fa-angle-right"></i></a>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
								<?php 
								$is_first = false;
							endforeach; 
							?>
						</div>

					</div><!-- .wallet-container -->

				<?php else : ?>
					<p class="no-posts-found">Belum ada postingan artikel diterbitkan.</p>
				<?php endif; ?>

			</main>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
	// Toggle year pockets (slots)
	$('.wallet-slot-tab').on('click', function() {
		var targetYear = $(this).data('year');
		
		// Set active tab class
		$('.wallet-slot-tab').removeClass('active-slot');
		$(this).addClass('active-slot');
		
		// Hide all pockets and animate the target one in
		$('.wallet-year-pocket').stop().hide().css('opacity', 0);
		$('#pocket-' + targetYear).show().animate({
			opacity: 1
		}, 400);
	});
});
</script>

<?php 
get_footer();
