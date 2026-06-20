<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

<div class="th-page-hero">
    <div class="th-container">
        <h1 class="th-heading-lg th-page-hero__title"><?php the_title(); ?></h1>
        <nav class="th-page-hero__breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Beranda', 'sma-theresiana'); ?></a>
            <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
            <span aria-current="page"><?php the_title(); ?></span>
        </nav>
    </div>
</div>

<main class="th-main th-main--inner" id="main-content">
    <div class="th-container">
        <div class="th-page-content">
            <?php if (has_post_thumbnail()) : ?>
            <div class="th-page-thumb">
                <?php the_post_thumbnail('full'); ?>
            </div>
            <?php endif; ?>
            <div class="th-page-body">
                <?php the_content(); ?>
            </div>
            <?php
            wp_link_pages(['before' => '<div class="th-page-links">', 'after' => '</div>']);
            ?>
        </div>
    </div>
</main>

<?php endwhile; ?>

<?php get_footer(); ?>
