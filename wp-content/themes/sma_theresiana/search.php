<?php get_header(); ?>

<div class="th-page-hero">
    <div class="th-container">
        <h1 class="th-heading-lg th-page-hero__title">
            <?php printf(esc_html__('Hasil Pencarian: "%s"', 'sma-theresiana'), get_search_query()); ?>
        </h1>
    </div>
</div>

<main class="th-main th-main--inner" id="main-content">
    <div class="th-container">
        <div class="th-search-form-wrap">
            <?php get_search_form(); ?>
        </div>
        <?php if (have_posts()) : ?>
        <p class="th-search-count">
            <?php printf(esc_html__('Ditemukan %s hasil', 'sma-theresiana'), $wp_query->found_posts); ?>
        </p>
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
                </div>
            </article>
            <?php endwhile; ?>
        </div>
        <div class="th-pagination">
            <?php the_posts_pagination(['mid_size' => 2]); ?>
        </div>
        <?php else : ?>
        <div class="th-no-results">
            <p class="th-text-lead"><?php esc_html_e('Tidak ada hasil yang ditemukan. Coba kata kunci lain.', 'sma-theresiana'); ?></p>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
