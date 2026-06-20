<?php
/**
 * Template Part: Video Section
 *
 * Reads from OnePress Customizer settings and renders a responsive YouTube
 * embed with a decorative dark overlay background.
 * The section is entirely suppressed when no video URL is configured.
 *
 * Customizer keys used:
 *   onepress_videolightbox_id    – section anchor ID (default: 'video')
 *   onepress_videolightbox_title – section heading
 *   onepress_videolightbox_url   – YouTube page URL or embed URL
 *
 * Supported YouTube URL formats:
 *   https://www.youtube.com/watch?v=VIDEO_ID
 *   https://youtu.be/VIDEO_ID
 *   https://www.youtube.com/embed/VIDEO_ID
 *
 * @package sma_theresiana
 */

$section_id = get_theme_mod( 'onepress_videolightbox_id', 'video' );
$heading    = get_theme_mod( 'onepress_videolightbox_title', 'Profil Sekolah' );
$video_url  = get_theme_mod( 'onepress_videolightbox_url', '' );

// ── Normalise the raw URL into a clean embed URL ───────────────────────────────
$embed_url = '';
if ( $video_url ) {
	$video_url = trim( $video_url );

	if ( preg_match( '/[?&]v=([A-Za-z0-9_\-]{6,20})/', $video_url, $m ) ) {
		// Standard watch URL: ?v=VIDEO_ID
		$embed_url = 'https://www.youtube.com/embed/' . $m[1] . '?rel=0';
	} elseif ( preg_match( '/youtu\.be\/([A-Za-z0-9_\-]{6,20})/', $video_url, $m ) ) {
		// Short URL: youtu.be/VIDEO_ID
		$embed_url = 'https://www.youtube.com/embed/' . $m[1] . '?rel=0';
	} elseif ( preg_match( '#youtube\.com/embed/([A-Za-z0-9_\-]{6,20})#', $video_url, $m ) ) {
		// Already an embed URL (possibly with extra params — preserve as-is).
		$embed_url = 'https://www.youtube.com/embed/' . $m[1] . '?rel=0';
	} elseif ( filter_var( $video_url, FILTER_VALIDATE_URL ) ) {
		// Non-YouTube URL — pass through verbatim.
		$embed_url = $video_url;
	}
}

// ── Bail early if no valid video URL is available ─────────────────────────────
if ( ! $embed_url ) {
	return;
}

$iframe_title = $heading
	? wp_strip_all_tags( $heading )
	: __( 'Profil SMA Theresiana 1 Semarang', 'sma_theresiana' );
?>

<section id="<?php echo esc_attr( $section_id ?: 'video' ); ?>"
	class="th-video th-section"
	aria-labelledby="th-video-heading">

	<div class="th-container">

		<!-- ── Section header ──────────────────────────────────────────────── -->
		<div class="th-section__header th-section__header--light">
			<span class="th-eyebrow th-reveal" style="color: rgba(255,255,255,.70)">
				Video
			</span>
			<h2 id="th-video-heading"
				class="th-heading-lg th-reveal th-reveal--delay-1"
				style="color: #fff">
				<?php echo wp_kses_post( $heading ); ?>
			</h2>
		</div><!-- .th-section__header -->

		<!-- ── Responsive 16:9 iframe wrapper ─────────────────────────────── -->
		<div class="th-video__embed th-reveal th-reveal--scale th-reveal--delay-2">
			<div class="th-video__frame">
				<iframe
					src="<?php echo esc_url( $embed_url ); ?>"
					title="<?php echo esc_attr( $iframe_title ); ?>"
					frameborder="0"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
					referrerpolicy="strict-origin-when-cross-origin"
					allowfullscreen
					loading="lazy"
				></iframe>
			</div><!-- .th-video__frame -->
		</div><!-- .th-video__embed -->

	</div><!-- .th-container -->
</section><!-- .th-video -->
