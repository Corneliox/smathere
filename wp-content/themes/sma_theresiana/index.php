<?php
/**
 * Index — Fallback / Archive Template
 *
 * Used when no more specific template exists.
 *
 * @package SMA_Theresiana
 */

get_header();
?>

<main class="th-main th-main--inner">
    <div class="th-container">

        <h1 class="th-heading-lg" style="margin-bottom:40px;">
            <?php esc_html_e( 'Artikel Terbaru', 'sma-theresiana' ); ?>
        </h1>

        <?php if ( have_posts() ) : ?>

            <div class="th-posts-grid">

                <?php while ( have_posts() ) : the_post(); ?>

                    <article class="th-card th-card--post">

                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>" class="th-card__thumb">
                                <?php the_post_thumbnail( 'th-card' ); ?>
                            </a>
                        <?php endif; ?>

                        <div class="th-card__body">

                            <div class="th-card__meta">
                                <?php echo esc_html( get_the_date( 'd M Y' ) ); ?>
                            </div>

                            <h2 class="th-card__title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <p class="th-card__excerpt">
                                <?php the_excerpt(); ?>
                            </p>

                            <a href="<?php the_permalink(); ?>" class="th-btn th-btn--text">
                                <?php esc_html_e( 'Baca Selengkapnya', 'sma-theresiana' ); ?>
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>

                        </div><!-- .th-card__body -->

                    </article><!-- .th-card -->

                <?php endwhile; ?>

            </div><!-- .th-posts-grid -->

            <div class="th-pagination">
                <?php
                the_posts_pagination( [
                    'mid_size'  => 2,
                    'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i> <span class="screen-reader-text">' . __( 'Sebelumnya', 'sma-theresiana' ) . '</span>',
                    'next_text' => '<span class="screen-reader-text">' . __( 'Berikutnya', 'sma-theresiana' ) . '</span> <i class="fa fa-chevron-right" aria-hidden="true"></i>',
                ] );
                ?>
            </div><!-- .th-pagination -->

        <?php else : ?>

            <p class="th-text-lead">
                <?php esc_html_e( 'Tidak ada konten ditemukan.', 'sma-theresiana' ); ?>
            </p>

        <?php endif; ?>

    </div><!-- .th-container -->
</main><!-- .th-main -->

<?php get_footer(); ?>
