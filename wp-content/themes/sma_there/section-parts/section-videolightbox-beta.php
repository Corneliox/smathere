<?php
/**
 * Beta Video Section Template — Inline YouTube Embed with Curved Frame
 * Palet Hijau Theresiana — revisi 2026-06-20
 */
$id      = get_theme_mod( 'onepress_videolightbox_id', 'videolightbox' );
$heading = get_theme_mod( 'onepress_videolightbox_title' );
$video   = get_theme_mod( 'onepress_videolightbox_url' );

$embed_url = '';
if ( $video ) {
	if ( preg_match( '/[\?\&]v=([^\?\&]+)/', $video, $matches ) ) {
		$embed_url = 'https://www.youtube.com/embed/' . $matches[1] . '?rel=0';
	} elseif ( preg_match( '/embed\/([^\?\&]+)/', $video, $matches ) ) {
		$embed_url = 'https://www.youtube.com/embed/' . $matches[1] . '?rel=0';
	} elseif ( preg_match( '/youtu\.be\/([^\?\&]+)/', $video, $matches ) ) {
		$embed_url = 'https://www.youtube.com/embed/' . $matches[1] . '?rel=0';
	} else {
		$embed_url = $video;
	}
}
?>

<section id="<?php if ( $id != '' ) echo esc_attr( $id ); ?>"
	class="section-videolightbox section-padding section-inverse onepage-section section-videolightbox-beta">

	<div class="container">

		<?php if ( $heading ) : ?>
			<h2 class="videolightbox__heading wow slideInUp" data-wow-delay="0.1s">
				<?php echo do_shortcode( wp_kses_post( $heading ) ); ?>
			</h2>
		<?php endif; ?>

		<?php if ( $embed_url ) : ?>
			<div class="video-beta-container wow slideInUp" data-wow-delay="0.2s">
				<div class="video-beta-frame">
					<iframe
						src="<?php echo esc_url( $embed_url ); ?>"
						title="<?php echo esc_attr( $heading ? strip_tags( $heading ) : 'Profil SMA Theresiana 1' ); ?>"
						frameborder="0"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
						allowfullscreen
						loading="lazy">
					</iframe>
				</div>
			</div>
		<?php else : ?>
			<p style="color:rgba(255,255,255,0.6); text-align:center; margin-top:20px;">
				Video profil belum dikonfigurasi. Silakan tambahkan URL YouTube di Customizer &rarr; Section Video.
			</p>
		<?php endif; ?>

	</div><!-- .container -->

</section>
