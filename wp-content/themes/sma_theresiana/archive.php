<?php get_header(); ?>

<div class="th-page-hero">
    <div class="th-container">
        <h1 class="th-heading-lg th-page-hero__title">
            <?php the_archive_title(); ?>
        </h1>
        <?php if (get_the_archive_description()) : ?>
        <p class="th-page-hero__desc"><?php the_archive_description(); ?></p>
        <?php endif; ?>
    </div>
</div>

<main class="th-main th-main--inner" id="main-content">
    <div class="th-container">
        <?php if (have_posts()) : ?>
        <div class="th-posts-grid">
            <?php while (have_posts()) : the_post(); ?>
            <article class="th-card th-card--post">
                <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" class="th-card__thumb">
                    <?php the_post_thumbnail('th-card'); ?>
                </a>
                <?php endif; ?>
                <div class="th-card__body">
                    <div class="th-card__meta"><?php echo get_the_date('d M Y'); ?></div>
                    <h2 class="th-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p class="th-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p>
                    <a href="<?php the_permalink(); ?>" class="th-btn th-btn--text">
                        Baca <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
        <div class="th-pagination">
            <?php the_posts_pagination(['mid_size' => 2, 'prev_text' => '<i class="fa fa-chevron-left"></i>', 'next_text' => '<i class="fa fa-chevron-right"></i>']); ?>
        </div>
        <?php else : ?>
        <p class="th-text-lead" style="text-align:center;padding:60px 0;">Tidak ada artikel dalam kategori ini.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
