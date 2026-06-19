<?php
/**
 * Beta About Section Template (Visi-Misi Cards + Koran wrap)
 */
$id       = get_theme_mod( 'onepress_about_id', esc_html__( 'about', 'onepress' ) );
$title    = get_theme_mod( 'onepress_about_title', esc_html__( 'About Us', 'onepress' ) );
$subtitle = get_theme_mod( 'onepress_about_subtitle', esc_html__( 'Section subtitle', 'onepress' ) );
$desc     = wp_kses_post( get_theme_mod( 'onepress_about_desc' ) );
$page_ids = onepress_get_section_about_data();
$content_source = get_theme_mod( 'onepress_about_content_source' );

?>
<section id="<?php if ( $id != '' ) { echo esc_attr( $id ); } ?>" class="section-about section-padding onepage-section section-about-beta">
	
	<div class="container">
		<?php if ( $title || $subtitle || $desc ) : ?>
			<div class="section-title-area">
				<?php if ( $subtitle != '' ) echo '<h5 class="section-subtitle">' . esc_html( $subtitle ) . '</h5>'; ?>
				<?php if ( $title != '' ) echo '<h2 class="section-title">' . esc_html( $title ) . '</h2>'; ?>
				<?php if ( $desc != '' ) echo '<div class="section-desc">' . apply_filters( 'onepress_the_content', $desc ) . '</div>'; ?>
			</div>
		<?php endif; ?>

		<?php
		if ( is_array( $page_ids ) && ! empty( $page_ids ) ) :
			$about_main = null;
			$visi_misi_pages = array();

			// Split the main about page from Visi-Misi pages
			$counter = 0;
			foreach ( $page_ids as $post_id => $settings ) {
				$post_id = $settings['content_page'];
				$post_id = apply_filters( 'wpml_object_id', $post_id, 'page', true );
				$post = get_post( $post_id );
				if ( ! $post ) continue;

				if ( $counter === 0 ) {
					$about_main = array( 'post' => $post, 'settings' => $settings );
				} else {
					$visi_misi_pages[] = array( 'post' => $post, 'settings' => $settings );
				}
				$counter++;
			}
			
			// 1. Render Main About Us in Newspaper/Magazine Style
			if ( $about_main ) :
				$post = $about_main['post'];
				$settings = $about_main['settings'];
				?>
				<div class="about-main-newspaper clearfix wow slideInUp">
					<?php if ( has_post_thumbnail( $post ) ) : ?>
						<div class="about-newspaper-thumb">
							<?php echo get_the_post_thumbnail( $post, 'onepress-medium' ); ?>
						</div>
					<?php endif; ?>
					
					<div class="about-newspaper-content">
						<?php if ( ! $settings['hide_title'] ) : ?>
							<h3 class="about-newspaper-title"><?php echo get_the_title( $post ); ?></h3>
						<?php endif; ?>
						
						<div class="about-newspaper-text">
							<?php
							if ( $content_source == 'excerpt' ) {
								$excerpt = get_the_excerpt( $post );
								echo apply_filters( 'the_excerpt', $excerpt );
							} else {
								$content = apply_filters( 'the_content', $post->post_content );
								$content = str_replace( ']]>', ']]&gt;', $content );
								echo $content;
							}
							?>
						</div>
					</div>
				</div>
			<?php 
			endif;

			// 2. Render Visi & Misi as Side-by-Side Cards
			if ( ! empty( $visi_misi_pages ) ) : 
				?>
				<div class="visi-misi-cards-row row">
					<?php foreach ( $visi_misi_pages as $item ) : 
						$post = $item['post'];
						$settings = $item['settings'];
						?>
						<div class="col-md-6 col-sm-12 visi-misi-card-col wow slideInUp">
							<div class="visi-misi-card">
								<?php if ( has_post_thumbnail( $post ) ) : ?>
									<div class="visi-misi-card-thumb">
										<?php echo get_the_post_thumbnail( $post, 'onepress-small' ); ?>
									</div>
								<?php endif; ?>
								<div class="visi-misi-card-body">
									<?php if ( ! $settings['hide_title'] ) : ?>
										<h4 class="visi-misi-card-title"><?php echo get_the_title( $post ); ?></h4>
									<?php endif; ?>
									<div class="visi-misi-card-text">
										<?php
										if ( $content_source == 'excerpt' ) {
											$excerpt = get_the_excerpt( $post );
											echo apply_filters( 'the_excerpt', $excerpt );
										} else {
											$content = apply_filters( 'the_content', $post->post_content );
											$content = str_replace( ']]>', ']]&gt;', $content );
											echo $content;
										}
										?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php 
			endif;

		endif;
		?>
	</div>
	
</section>
