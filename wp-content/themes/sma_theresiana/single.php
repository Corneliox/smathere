<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

<div class="th-page-hero">
    <div class="th-container">
        <div class="th-post-hero">
            <?php
            $cats = get_the_category();
            if ($cats) :
            ?>
            <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>" class="th-eyebrow" style="color:rgba(255,255,255,0.8);">
                <?php echo esc_html($cats[0]->name); ?>
            </a>
            <?php endif; ?>
            <h1 class="th-heading-lg th-page-hero__title"><?php the_title(); ?></h1>
            <div class="th-post__meta">
                <span><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_the_date('d F Y'); ?></span>
                <span><i class="fa fa-user" aria-hidden="true"></i> <?php the_author(); ?></span>
                <span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo ceil(str_word_count(get_the_content()) / 200); ?> menit baca</span>
            </div>
        </div>
    </div>
</div>

<main class="th-main th-main--inner" id="main-content">
    <div class="th-container">
        <article class="th-post">
            <?php if (has_post_thumbnail()) : ?>
            <div class="th-post__thumb">
                <?php the_post_thumbnail('full'); ?>
            </div>
            <?php endif; ?>

            <div class="th-post__content">
                <?php the_content(); ?>
            </div>

            <?php
            $tags = get_the_tags();
            if ($tags) :
            ?>
            <div class="th-post__tags">
                <?php foreach ($tags as $tag) : ?>
                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="th-post__tag">
                    #<?php echo esc_html($tag->name); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <nav class="th-post__nav" aria-label="Artikel lainnya">
                <?php
                $prev = get_previous_post();
                $next = get_next_post();
                if ($prev) : ?>
                <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="th-post__nav-item th-post__nav-prev">
                    <span class="th-post__nav-label"><i class="fa fa-arrow-left"></i> Sebelumnya</span>
                    <span class="th-post__nav-title"><?php echo esc_html(get_the_title($prev)); ?></span>
                </a>
                <?php endif; ?>
                <?php if ($next) : ?>
                <a href="<?php echo esc_url(get_permalink($next)); ?>" class="th-post__nav-item th-post__nav-next">
                    <span class="th-post__nav-label">Berikutnya <i class="fa fa-arrow-right"></i></span>
                    <span class="th-post__nav-title"><?php echo esc_html(get_the_title($next)); ?></span>
                </a>
                <?php endif; ?>
            </nav>

            <?php if (comments_open() || get_comments_number()) comments_template(); ?>
        </article>
    </div>
</main>

<?php endwhile; ?>
<?php get_footer(); ?>
