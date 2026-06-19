<?php
/**
 * Beta News Section Template (Horizontal Sliding Cards + Skeleton Loading)
 * Palet Hijau Theresiana — revisi 2026-06-20
 */
$id       = get_theme_mod( 'onepress_news_id', esc_html__( 'news', 'onepress' ) );
$title    = get_theme_mod( 'onepress_news_title', esc_html__( 'Latest News', 'onepress' ) );
$subtitle = get_theme_mod( 'onepress_news_subtitle', esc_html__( 'Section subtitle', 'onepress' ) );
$number   = 6;
$desc     = get_theme_mod( 'onepress_news_desc' );

$cat  = absint( get_theme_mod( 'onepress_news_cat' ) );
$args = array(
	'posts_per_page'   => $number,
	'suppress_filters' => 0,
);
if ( $cat > 0 ) {
	$args['category__in'] = array( $cat );
}
$query = new WP_Query( $args );
?>

<section id="<?php if ( $id != '' ) { echo esc_attr( $id ); } ?>"
	class="section-news section-padding onepage-section section-news-beta">

	<div class="container">

		<?php if ( $title || $subtitle || $desc ) : ?>
			<div class="section-title-area">
				<?php if ( $subtitle != '' ) echo '<h5 class="section-subtitle">' . esc_html( $subtitle ) . '</h5>'; ?>
				<?php if ( $title    != '' ) echo '<h2 class="section-title">'    . esc_html( $title )    . '</h2>'; ?>
				<?php if ( $desc ) echo '<div class="section-desc">' . apply_filters( 'onepress_the_content', wp_kses_post( $desc ) ) . '</div>'; ?>
			</div>
		<?php endif; ?>

		<!-- ── News Skeleton Loader ── -->
		<div id="news-skeleton" class="news-skeleton-scroll" aria-hidden="true">
			<?php for ( $i = 0; $i < 3; $i++ ) : ?>
				<div class="news-card-skeleton">
					<div class="skeleton-shimmer"></div>
					<div class="skeleton-thumb"></div>
					<div class="skeleton-line skeleton-meta"    style="margin:18px 22px 14px;width:58%;height:11px;"></div>
					<div class="skeleton-line skeleton-title-line" style="margin:0 22px 14px;width:80%;height:17px;"></div>
					<div class="skeleton-line skeleton-desc-line-1" style="margin:0 22px 8px;width:84%;height:12px;"></div>
					<div class="skeleton-line skeleton-desc-line-2" style="margin:0 22px;width:68%;height:12px;"></div>
				</div>
			<?php endfor; ?>
		</div>

		<!-- ── Actual Sliding News ── -->
		<div id="news-slider-content"
			class="news-slider-viewport"
			style="display:none; opacity:0; transition: opacity 0.5s ease;">

			<div class="news-slider-track" id="news-slider-track">
				<?php if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post();
						$show_thumbnail = has_post_thumbnail();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'news-card-slide', 'clearfix' ) ); ?>>
							<div class="news-card-inner">

								<div class="news-card-thumb">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php if ( $show_thumbnail ) : ?>
											<?php the_post_thumbnail( 'onepress-blog-small' ); ?>
										<?php else : ?>
											<img alt="<?php the_title_attribute(); ?>"
												src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder2.png">
										<?php endif; ?>
									</a>
								</div>

								<div class="news-card-content">
									<div class="news-card-meta">
										<span class="news-card-cat"><?php the_category( ' / ' ); ?></span>
										<span class="news-card-date">
											<i class="fa fa-calendar-o" aria-hidden="true"></i>
											<?php echo get_the_date(); ?>
										</span>
									</div>

									<h3 class="news-card-title">
										<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h3>

									<div class="news-card-excerpt">
										<?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
									</div>

									<a class="news-card-readmore" href="<?php the_permalink(); ?>">
										Baca Selengkapnya <i class="fa fa-angle-right" aria-hidden="true"></i>
									</a>
								</div>

							</div><!-- .news-card-inner -->
						</article>
					<?php endwhile; ?>
				<?php else : ?>
					<p class="no-news-found">Tidak ada artikel berita ditemukan.</p>
				<?php endif; wp_reset_postdata(); ?>
			</div><!-- .news-slider-track -->

			<!-- Scroll Arrow Controls -->
			<div class="news-scroll-arrows" role="navigation" aria-label="Navigasi Berita">
				<button id="news-prev-btn" class="news-scroll-prev" onclick="scrollNewsSlider(-1)" aria-label="Berita sebelumnya">
					<i class="fa fa-angle-left" aria-hidden="true"></i>
				</button>
				<button id="news-next-btn" class="news-scroll-next" onclick="scrollNewsSlider(1)" aria-label="Berita berikutnya">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</button>
			</div>

		</div><!-- #news-slider-content -->

		<!-- View All Posts CTA -->
		<div class="all-news wow slideInUp" data-wow-delay="0.2s"
			style="margin-top:40px; text-align:center;">
			<a id="view-all-news-btn"
				class="btn btn-theme-primary"
				href="<?php echo esc_url( add_query_arg( 'view', 'wallet', home_url( '/' ) ) ); ?>">
				<i class="fa fa-newspaper-o" aria-hidden="true"></i>
				&nbsp;Lihat Semua Berita &amp; Arsip
			</a>
		</div>

	</div><!-- .container -->
</section>

<script type="text/javascript">
jQuery(document).ready(function($) {
	/* Tampilkan news setelah loading */
	setTimeout(function() {
		$('#news-skeleton').fadeOut(350, function() {
			$('#news-slider-content').show().animate({ opacity: 1 }, 450);
		});
	}, 1400);
});

/* Horizontal scroll handler */
function scrollNewsSlider(direction) {
	var $ = jQuery;
	var $track     = $('#news-slider-track');
	var cardWidth  = $('.news-card-slide').outerWidth(true) || 336;
	var newScroll  = $track.scrollLeft() + ( direction * cardWidth * 1.6 );
	$track.animate({ scrollLeft: newScroll }, 420, 'swing');
}
</script>
