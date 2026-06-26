<?php
/**
 * Template Part: Archive Berita (Year > Month > Cards)
 */

$args = [
    'post_type'      => 'post',
    'posts_per_page' => -1, // Get all to group them
    'post_status'    => 'publish',
];
$query = new WP_Query($args);

$grouped = [];
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $y = get_the_date('Y');
        $m = get_the_date('n'); // 1-12
        $grouped[$y][$m][] = get_post();
    }
    wp_reset_postdata();
}

$six_months_ago = strtotime(date('Y-m-01') . " -6 months");

?>

<div class="th-news-archive">
    <?php if ( empty($grouped) ) : ?>
        <p class="th-text-lead"><?php esc_html_e( 'Belum ada berita diterbitkan.', 'sma-theresiana' ); ?></p>
    <?php else : ?>
        
        <?php foreach ( $grouped as $year => $months ) : 
            // Check if this year should be open (if any month in it is within last 6 months)
            $year_open = false;
            foreach ( $months as $m_num => $posts ) {
                if ( mktime(0, 0, 0, $m_num, 1, (int)$year) >= $six_months_ago ) {
                    $year_open = true;
                    break;
                }
            }
            if ( $year == date('Y') ) $year_open = true;
        ?>
            
            <details class="th-archive-year" <?php echo $year_open ? 'open' : ''; ?>>
                <summary class="th-archive-year__title">
                    <span class="th-archive-year__text"><?php echo esc_html($year); ?></span>
                    <i class="fa fa-chevron-down th-archive__icon" aria-hidden="true"></i>
                </summary>
                
                <div class="th-archive-year__content">
                    <?php foreach ( $months as $month_num => $posts ) : 
                        $month_time = mktime(0, 0, 0, $month_num, 1, (int)$year);
                        $month_open = ( $month_time >= $six_months_ago );
                        $month_name = date_i18n('F', $month_time);
                    ?>
                        <details class="th-archive-month" <?php echo $month_open ? 'open' : ''; ?>>
                            <summary class="th-archive-month__title">
                                <span class="th-archive-month__text"><?php echo esc_html($month_name); ?> <span style="opacity:0.5; font-size:14px; margin-left:8px;">(<?php echo count($posts); ?> berita)</span></span>
                                <i class="fa fa-chevron-down th-archive__icon" aria-hidden="true"></i>
                            </summary>
                            
                            <div class="th-archive-month__content">
                                <div class="th-archive-grid">
                                    <?php foreach ( $posts as $p ) : 
                                        global $post;
                                        $post = $p;
                                        setup_postdata($post);
                                        
                                        // Re-use card HTML from news slider but as a grid item
                                        $categories = get_the_category();
                                        $cat_name = ! empty($categories) ? $categories[0]->name : 'Berita';
                                    ?>
                                        <article class="th-news__card th-archive-card">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="th-news__card-thumb">
                                                <?php the_post_thumbnail( 'medium_large' ); ?>
                                            </a>
                                            <?php endif; ?>
                                            
                                            <div class="th-news__card-body">
                                                <div class="th-news__card-meta">
                                                    <span class="th-news__card-cat"><?php echo esc_html( $cat_name ); ?></span>
                                                    <span class="th-news__card-date"><?php echo esc_html( get_the_date('d M Y') ); ?></span>
                                                </div>
                                                <h3 class="th-news__card-title">
                                                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                            </div>
                                        </article>
                                    <?php endforeach; wp_reset_postdata(); ?>
                                </div>
                            </div>
                        </details>
                    <?php endforeach; ?>
                </div>
            </details>
            
        <?php endforeach; ?>
        
    <?php endif; ?>
</div>
