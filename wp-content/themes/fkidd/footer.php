			<a href="#" class="scrollup"></a>
			<footer id="footer-main">
				<div id="footer-content-wrapper">

					<?php get_sidebar('footer'); ?>

					<div class="clear">
						<div id="fsocial">
							<ul class="footer-social-widget">
								<?php fkidd_display_social_sites(); ?>
							</ul>
						</div>

					</div>

					<div class="clear">
					</div>

					<nav id="footer-menu">
						<?php wp_nav_menu( array( 'theme_location' => 'footer', ) ); ?>
					</nav>

					<div class="clear">
					</div>

				</div>
			</footer>
			<div id="footer-bottom-area">
				<div id="footer-bottom-content-wrapper">
					<div id="copyright">
						<p>
						 <?php fkidd_show_copyright_text(); ?> <a href="<?php echo esc_url( 'https://tishonator.com/product/fkidd' ); ?>" title="<?php esc_attr_e( 'fkidd Theme', 'fkidd' ); ?>">
							fKidd Theme</a> <?php esc_attr_e( 'powered by', 'fkidd' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" title="<?php esc_attr_e( 'WordPress', 'fkidd' ); ?>">
							WordPress</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>