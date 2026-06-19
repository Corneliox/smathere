<?php
/**
 * Beta Video Section Template (Inline YouTube Embed with Curved Frame)
 */
$id       = get_theme_mod( 'onepress_videolightbox_id', 'videolightbox' );
$heading  = get_theme_mod( 'onepress_videolightbox_title' );
$video    = get_theme_mod( 'onepress_videolightbox_url' );

$embed_url = '';
if ( $video ) {
	// Convert standard YouTube URLs to embed URLs
	if ( preg_match( '/[\\?\\&]v=([^\\?\\&]+)/', $video, $matches ) ) {
		$video_id = $matches[1];
		$embed_url = 'https://www.youtube.com/embed/' . $video_id;
	} elseif ( preg_match( '/embed\\/([^\\?\\&]+)/', $video, $matches ) ) {
		$video_id = $matches[1];
		$embed_url = 'https://www.youtube.com/embed/' . $video_id;
	} elseif ( preg_match( '/youtu\\.be\\/([^\\?\\&]+)/', $video, $matches ) ) {
		$video_id = $matches[1];
		$embed_url = 'https://www.youtube.com/embed/' . $video_id;
	} else {
		$embed_url = $video; // Fallback directly
	}
}
?>
<section id="<?php if ($id != '') echo esc_attr($id); ?>" class="section-videolightbox section-padding section-inverse onepage-section section-videolightbox-beta">
	
	<div class="container">
		<?php if ($heading) : ?>
			<h2 class="videolightbox__heading"><?php echo do_shortcode(wp_kses_post($heading)); ?></h2>
		<?php endif; ?>
		
		<?php if ( $embed_url ) : ?>
			<div class="video-beta-container wow slideInUp">
				<div class="video-beta-frame">
					<iframe src="<?php echo esc_url( $embed_url ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
		<?php endif; ?>
	</div>

</section>
