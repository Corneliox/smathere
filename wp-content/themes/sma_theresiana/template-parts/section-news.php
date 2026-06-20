<?php
/**
 * Template Part: News & Activities Section
 *
 * Reads from OnePress Customizer settings and recent WordPress posts.
 * Renders a horizontally-draggable / arrow-navigated card slider.
 *
 * Customizer keys used:
 *   onepress_news_id       – section anchor ID (default: 'news')
 *   onepress_news_title    – section heading
 *   onepress_news_subtitle – section sub-heading
 *   onepress_news_num      – number of posts to display (3–12)
 *
 * JavaScript for the slider lives in assets/js/th-news-slider.js (or the
 * bundled theme script) and targets .th-news__slider, .th-news__track,
 * .th-news__prev, and .th-news__next.
 *
 * @package sma_theresiana
 */

$section_id = get_theme_mod( 'onepress_news_id', 'news' );
$heading    = get_theme_mod( 'onepress_news_title', 'Berita &amp; Kegiatan' );
$subtitle   = get_theme_mod( 'onepress_news_subtitle', '' );
$num_posts  = absint( get_theme_mod( 'onepress_news_num', 6 ) );
$num_posts  = max( 3, min( $num_posts, 12 ) );

// ── Query posts ───────────────────────────────────────────────────────────────
$news_query = new WP_Query( [
	'post_type'           => 'post',
	'posts_per_page'      => $num_posts,
	'post_status'         => 'publish',
	'orderby'             => 'date',
	'order'               => 'DESC',
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true, // Performance: skip SQL_CALC_FOUND_ROWS.
] );

// ── Archive URL ───────────────────────────────────────────────────────────────
$page_for_posts = get_option( 'page_for_posts' );
$archive_url    = $page_for_posts
	? get_permalink( $page_for_posts )
	: home_url( '/blog/' );
?>

<section id="<?php echo esc_attr( $section_id ?: 'news' ); ?>"
	class="th-news th-section"
	aria-labelledby="th-news-heading">

	<div class="th-container">

		<!-- ── Section header + navigation arrows ─────────────────────────── -->
		<div class="th-news__header">

			<div class="th-news__header-text">
				<span class="th-eyebrow th-reveal">Terbaru</span>
				<h2 id="th-news-heading" class="th-heading-lg th-reveal th-reveal--delay-1">
					<?php echo wp_kses_post( $heading ); ?>
				</h2>
				<?php if ( $subtitle ) : ?>
				<p class="th-text-lead th-reveal th-reveal--delay-2">
					<?php echo wp_kses_post( $subtitle ); ?>
				</p>
				<?php endif; ?>
			</div><!-- .th-news__header-text -->

			<div class="th-news__nav th-reveal" role="group" aria-label="Kontrol slider berita">
				<button class="th-news__arrow th-news__prev"
					aria-label="Berita sebelumnya"
					aria-controls="th-news-track">
					<i class="fa fa-chevron-left" aria-hidden="true"></i>
				</button>
				<button class="th-news__arrow th-news__next"
					aria-label="Berita berikutnya"
					aria-controls="th-news-track">
					<i class="fa fa-chevron-right" aria-hidden="true"></i>
				</button>
			</div><!-- .th-news__nav -->

		</div><!-- .th-news__header -->

		<!-- ── Card slider ────────────────────────────────────────────────── -->
		<?php if ( $news_query->have_posts() ) : ?>
		<div class="th-news__slider"
			role="region"
			aria-label="Slider berita terbaru"
			aria-live="polite">

			<div class="th-news__track" id="th-news-track" role="list">

				<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>

				<article class="th-news__card"
					role="listitem"
					itemscope
					itemtype="https://schema.org/NewsArticle">

					<!-- Thumbnail -->
					<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>"
						class="th-news__card-thumb"
						tabindex="-1"
						aria-hidden="true">
						<?php
						the_post_thumbnail(
							'th-card',
							[
								'itemprop' => 'image',
								'loading'  => 'lazy',
								'decoding' => 'async',
							]
						);
						?>
					</a>
					<?php endif; ?>

					<!-- Body -->
					<div class="th-news__card-body">

						<div class="th-news__card-meta">
							<?php
							$cats = get_the_category();
							if ( $cats ) :
							?>
							<a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>"
								class="th-news__card-cat"
								itemprop="articleSection">
								<?php echo esc_html( $cats[0]->name ); ?>
							</a>
							<?php endif; ?>
							<time class="th-news__card-date"
								datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
								itemprop="datePublished">
								<?php echo esc_html( get_the_date( 'd M Y' ) ); ?>
							</time>
						</div><!-- .th-news__card-meta -->

						<h3 class="th-news__card-title" itemprop="headline">
							<a href="<?php the_permalink(); ?>" itemprop="url">
								<?php the_title(); ?>
							</a>
						</h3>

						<p class="th-news__card-excerpt" itemprop="description">
							<?php echo esc_html( wp_trim_words( get_the_excerpt(), 18, '...' ) ); ?>
						</p>

						<a href="<?php the_permalink(); ?>"
							class="th-btn th-btn--text"
							aria-label="Baca selengkapnya: <?php echo esc_attr( get_the_title() ); ?>">
							Baca <i class="fa fa-arrow-right" aria-hidden="true"></i>
						</a>

					</div><!-- .th-news__card-body -->

				</article><!-- .th-news__card -->

				<?php endwhile; wp_reset_postdata(); ?>

			</div><!-- .th-news__track -->

		</div><!-- .th-news__slider -->
		<?php else : ?>
		<!-- Empty state -->
		<p class="th-news__empty">
			<?php esc_html_e( 'Belum ada berita yang dipublikasikan.', 'sma_theresiana' ); ?>
		</p>
		<?php endif; ?>

		<!-- ── Archive CTA ────────────────────────────────────────────────── -->
		<div class="th-news__cta th-reveal">
			<a href="<?php echo esc_url( $archive_url ); ?>"
				class="th-btn th-btn--outline-green">
				<i class="fa fa-newspaper-o" aria-hidden="true"></i>
				<?php esc_html_e( 'Semua Berita', 'sma_theresiana' ); ?>
			</a>
		</div><!-- .th-news__cta -->

	</div><!-- .th-container -->
</section><!-- .th-news -->
