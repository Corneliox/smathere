<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Car Services Center
 */
?>
<div id="footer">
	<div class="container">
    <?php if ( ! dynamic_sidebar( 'footer-1' ) ) : ?>
    <?php endif; // end footer widget area ?>
              
    <?php if ( ! dynamic_sidebar( 'footer-2' ) ) : ?>
    <?php endif; // end footer widget area ?>
  
    <?php if ( ! dynamic_sidebar( 'footer-3' ) ) : ?>
    <?php endif; // end footer widget area ?>
    
    <?php if ( ! dynamic_sidebar( 'footer-4' ) ) : ?>
    <?php endif; // end footer widget area ?>
    <div class="clear"></div>
  </div>
  <div class="copywrap text-center">
    <div class="container">
      <a href="<?php echo esc_html(get_theme_mod('car_service_copyright_link',__('https://www.theclassictemplates.com/themes/free-car-service-wordpress-theme/','car-services-center'))); ?>" target="_blank"><?php echo esc_html(get_theme_mod('car_service_copyright_line',__('Car Services Center WordPress Theme','car-services-center'))); ?></a>
    </div>
  </div>
</div>
  
<?php wp_footer(); ?>
</body>
</html>