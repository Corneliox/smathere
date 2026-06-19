<?php
$background_image = get_theme_support( 'custom-header', 'default-image' );

if ( has_header_image() ) {
  $background_image = get_header_image();
}
$breadcrumb_img_type_display = get_theme_mod('breadcrumb_img_type_display','scroll');
$header_img_bg_color = get_theme_mod('header_img_bg_color',' #051b44 ');
?>
<div class="consultup-breadcrumb-section" style='background: url("<?php echo esc_url( $background_image ); ?>" );  background-attachment: <?php echo esc_attr($breadcrumb_img_type_display); ?>  
;'>
  <div class="overlay" style="background:linear-gradient(to bottom, <?php echo $header_img_bg_color ; ?> 0%, rgba(5, 27, 68, 0.5) 50%, <?php echo $header_img_bg_color ; ?>" );>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12">
			<div class="consultup-breadcrumb-title">
            <?php if( class_exists( 'WooCommerce' ) && is_shop() ) { ?>
            <h1>
            <?php woocommerce_page_title(); ?>
            </h1>
            <?php    
          	} else { ?>
            <h1><?php the_title(); ?></h1>
           <?php } ?>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>