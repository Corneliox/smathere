<?php
/**
 * Beta News Section Template (Horizontal Sliding Cards + Skeleton Loading)
 */
$id        = get_theme_mod( 'onepress_news_id', esc_html__( 'news', 'onepress' ) );
$title     = get_theme_mod( 'onepress_news_title', esc_html__( 'Latest News', 'onepress' ) );
$subtitle  = get_theme_mod( 'onepress_news_subtitle', esc_html__( 'Section subtitle', 'onepress' ) );
$number    = 6; // Set to 6 for a good horizontal sliding experience
$desc      = get_theme_mod( 'onepress_news_desc' );

$cat = absint( get_theme_mod( 'onepress_news_cat' ) );
$args = array(
	'posts_per_page'   => $number,
	'suppress_filters' => 0,
);
if ( $cat > 0 ) {
	$args['category__in'] = array( $cat );
}
$query = new WP_Query( $args );
?>

<section id="<?php if ( $id != '' ) { echo esc_attr( $id ); } ?>" class="section-news section-padding onepage-section section-news-beta">
	<div class="container">
		
		<?php if ( $title || $subtitle || $desc ) : ?>
			<div class="section-title-area">
				<?php if ( $subtitle != '' ) echo '<h5 class="section-subtitle">' . esc_html( $subtitle ) . '</h5>'; ?>
				<?php if ( $title != '' ) echo '<h2 class="section-title">' . esc_html( $title ) . '</h2>'; ?>
				<?php if ( $desc ) echo '<div class="section-desc">' . apply_filters( 'onepress_the_content', wp_kses_post( $desc ) ) . '</div>'; ?>
			</div>
		<?php endif; ?>

		<!-- News Skeleton Loader -->
		<div id="news-skeleton" class="news-skeleton-scroll">
			<?php for ( $i = 0; $i < 3; $i++ ) : ?>
				<div class="news-card-skeleton">
					<div class="skeleton-shimmer"></div>
					<div class="skeleton-thumb"></div>
					<div class="skeleton-meta"></div>
					<div class="skeleton-title-line"></div>
					<div class="skeleton-desc-line-1"></div>
					<div class="skeleton-desc-line-2"></div>
				</div>
			<?php endfor; ?>
		</div>

		<!-- Actual Sliding News content -->
		<div id="news-slider-content" class="news-slider-viewport" style="display: none; opacity: 0; transition: opacity 0.5s ease;">
			<div class="news-slider-track">
				<?php if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); 
						$show_thumbnail = has_post_thumbnail();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'news-card-slide', 'clearfix' ) ); ?>>
							<div class="news-card-inner">
								<div class="news-card-thumb">
									<a href="<?php the_permalink(); ?>">
										<?php if ( $show_thumbnail ) : ?>
											<?php the_post_thumbnail( 'onepress-blog-small' ); ?>
										<?php else : ?>
											<img alt="" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder2.png">
										<?php endif; ?>
									</a>
								</div>
								
								<div class="news-card-content">
									<div class="news-card-meta">
										<span class="news-card-cat"><?php the_category( ' / ' ); ?></span>
										<span class="news-card-date"><i class="fa fa-calendar-o"></i> <?php echo get_the_date(); ?></span>
									</div>
									<h3 class="news-card-title">
										<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h3>
									<div class="news-card-excerpt">
										<?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
									</div>
									<a class="news-card-readmore" href="<?php the_permalink(); ?>">Baca Selengkapnya <i class="fa fa-angle-right"></i></a>
								</div>
							</div>
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<p class="no-news-found">Tidak ada artikel berita ditemukan.</p>
				<?php endif; wp_reset_postdata(); ?>
			</div>
			
			<!-- Indicator Arrows (Optional UI Enhancement) -->
			<div class="news-scroll-arrows">
				<button class="news-scroll-prev" onclick="scrollNewsSlider(-1)"><i class="fa fa-angle-left"></i></button>
				<button class="news-scroll-next" onclick="scrollNewsSlider(1)"><i class="fa fa-angle-right"></i></button>
			</div>
		</div>

		<!-- View All Posts Button -->
		<div class="all-news wow slideInUp" style="margin-top: 40px; text-align: center;">
			<a class="btn btn-theme-primary" href="<?php echo esc_url( add_query_arg('view', 'wallet', home_url('/')) ); ?>">
				View All Posts (Arsip Dompet)
			</a>
		</div>

	</div>
</section>

<script type="text/javascript">
jQuery(document).ready(function($) {
	// Simulate loading
	setTimeout(function() {
		$('#news-skeleton').fadeOut(300, function() {
			$('#news-slider-content').show().css('opacity', 1);
		});
	}, 1500);
});

// Horizontal scroll handler
function scrollNewsSlider(direction) {
	var $ = jQuery;
	var $slider = $('.news-slider-track');
	var cardWidth = $('.news-card-slide').outerWidth(true);
	var scrollAmount = $slider.scrollLeft() + (direction * cardWidth * 1.5);
	$slider.animate({
		scrollLeft: scrollAmount
	}, 400);
}
</script>
