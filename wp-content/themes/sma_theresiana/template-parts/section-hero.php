<?php
/**
 * Template Part: Hero Section
 *
 * Renders a hero section with custom background image, overlay, 
 * and a featured slider for recent news.
 *
 * @package sma_theresiana
 */

$hero_bg       = get_theme_mod( 'Hero_Background_Image', home_url('/wp-content/uploads/2025/07/24132023_1229465257154162_6232500862772732835_o-960x540.jpg') );
$default_title = get_bloginfo( 'name' );
$default_desc  = get_bloginfo( 'description' );
$title         = get_theme_mod( 'onepress_hero_title', $default_title );
$description   = get_theme_mod( 'onepress_hero_description', $default_desc );
?>

<section class="th-hero th-hero--static" id="hero" aria-label="Hero Banner">
    <?php if ( $hero_bg ) : ?>
        <img
            src="<?php echo esc_url( $hero_bg ); ?>"
            alt=""
            class="th-hero__bg"
            fetchpriority="high"
            loading="eager"
            decoding="sync"
        >
    <?php endif; ?>

    <!-- White Transparency 20% Overlay -->
    <div class="th-hero__overlay th-hero__overlay--light" aria-hidden="true"></div>

    <div class="th-hero__content th-container">
        
        <div class="th-hero__text-content th-reveal">
            <span class="th-hero__eyebrow th-eyebrow">SMA Theresiana 1 Semarang</span>
            
            <?php if ( ! empty( $title ) ) : ?>
                <h1 class="th-hero__title">
                    <?php echo wp_kses_post( $title ); ?>
                </h1>
            <?php endif; ?>
            
            <?php if ( ! empty( $description ) ) : ?>
                <p class="th-hero__subtitle">
                    <?php echo wp_kses_post( $description ); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Featured Slider -->
        <div id="featured-slider" class="th-featured-slider th-reveal th-reveal--delay-2">
            <div class="th-featured-slider__track" id="th-fs-track">
                <?php
                $featured_args = [
                    'post_type'      => 'post',
                    'posts_per_page' => 5,
                    'post_status'    => 'publish',
                    'ignore_sticky_posts' => false,
                ];
                $featured_query = new WP_Query( $featured_args );

                if ( $featured_query->have_posts() ) :
                    while ( $featured_query->have_posts() ) : $featured_query->the_post();
                        // Get thumbnail or fallback to first image in content
                        $img_url = '';
                        if ( has_post_thumbnail() ) {
                            $img_url = get_the_post_thumbnail_url( null, 'th-thumb' );
                        } else {
                            $content = get_the_content();
                            preg_match( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches );
                            $img_url = ! empty( $matches[1] ) ? $matches[1] : $hero_bg;
                        }
                        ?>
                        <div class="th-featured-slider__slide">
                            <div class="th-fs-card">
                                <?php if ( $img_url ) : ?>
                                    <div class="th-fs-card__thumb">
                                        <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="th-fs-card__body">
                                    <div class="th-fs-card__meta"><?php echo get_the_date('d M Y'); ?></div>
                                    <h3 class="th-fs-card__title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <p class="th-fs-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="th-btn th-btn--text">
                                        Baca Artikel <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>Tidak ada berita unggulan saat ini.</p>';
                endif;
                ?>
            </div>

            <!-- Slider Controls -->
            <div class="th-featured-slider__controls">
                <button class="th-fs-arrow th-fs-arrow--prev" id="th-fs-prev" aria-label="Previous Slide">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </button>
                <div class="th-fs-dots" id="th-fs-dots"></div>
                <button class="th-fs-arrow th-fs-arrow--next" id="th-fs-next" aria-label="Next Slide">
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
        </div><!-- #featured-slider -->

    </div><!-- .th-hero__content -->

    <a href="#about" class="th-hero__scroll" aria-label="Scroll kebawah">
        <span class="th-hero__scroll-mouse">
            <span class="th-hero__scroll-wheel"></span>
        </span>
    </a>
</section><!-- .th-hero -->
