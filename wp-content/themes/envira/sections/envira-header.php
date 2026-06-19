<!-- Start: Header
============================= -->
<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="custom-header" rel="home">
		<img src="<?php esc_url(header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
	</a>
<?php endif; 
$envira_cart_header_setting		= get_theme_mod('cart_header_setting','1'); 
$envira_booknow_setting			= get_theme_mod('booknow_setting','1'); 
$envira_header_btn_icon			= get_theme_mod('header_btn_icon','fa-book');
$envira_header_btn_lbl			= get_theme_mod('header_btn_lbl'); 
$envira_header_btn_link			= get_theme_mod('header_btn_link'); 
if ( is_active_sidebar( 'top-left-header' ) || is_active_sidebar( 'top-right-header' )) {
?>
<div id="header-top" class="startkit">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-md-12 text-lg-left text-center startkit-top-left">
			<?php if ( is_active_sidebar( 'top-left-header' ) ) { dynamic_sidebar( 'top-left-header' ); } ?>
         </div>
         <div class="col-lg-6 col-md-12 text-lg-right text-center startkit-top-right">
           <?php if ( is_active_sidebar( 'top-right-header' ) ) { dynamic_sidebar( 'top-right-header' ); } ?>
         </div>
      </div>
   </div>
</div>
<?php } ?>
<header id="header" role="banner">
	<div class="navigator">
		<!-- Navigation Starts -->
		<div class="navbar-area <?php echo esc_attr(startkit_sticky_menu()); ?> my-auto">
			<div class="container">			
				<div class="row">
					<!-- Nav -->
					<div class="col-lg-5 col-6 my-auto d-none d-lg-block">
						<nav class="text-left main-menu">
							<?php 
							wp_nav_menu( 
								array(  
									'theme_location' => 'primary_menu',
									'container'  => '',
									'menu_class' => '',
									'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
									'walker' => new WP_Bootstrap_Navwalker()
									) 
								);
							?>
						</nav>
					</div>
					<!-- Nav End -->
					<div class="col-lg-2 col-6 my-auto">
						<div class="main-logo">
							<div class="logo main">
									<?php
										if(has_custom_logo())
										{	
											the_custom_logo();
										}
										else { 
									?>
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
											<h2 class="site-title"><?php echo esc_html(get_bloginfo('name')); ?></h2>
										</a>	
									<?php 		
										}
									?>
									
									<?php
										$envira_description = get_bloginfo( 'description');
										if ($envira_description) : ?>
											<p class="site-description"><?php echo esc_html($envira_description); ?></p>
									<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-lg-5 col-6 my-auto">
						<div class="header-right-bar">                            
							<ul>
								<?php if($envira_cart_header_setting == '1') { ?>
									<li class="search-button search-cart-se">
										<button class="searchBtn search-toggle" type="button"><i class="fa fa-search"></i></button>
										<!-- Start: Search
										============================= -->
										<div id="search" class="search-area">
											<div class="search-overlay">
												<form method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
													<input id="searchbox" class="search-field sb-field" type="search" value="" name="s" id="s" placeholder="<?php esc_attr_e('type here','envira'); ?>" />
													<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
												</form>
												<button type="button" id="close-btn" class="searchBtn">
													<i class="fa fa-times"></i>
												</button>
											</div>
										</div>
										<!-- End: Search
										============================= -->
									</li>
								<?php } ?>
								<?php if($envira_booknow_setting == '1') { ?>
									<li class="book-now-btn">
										<?php if ( ! empty( $envira_header_btn_lbl ) ) : ?>
										<a class="book-now" href="<?php echo esc_url( $envira_header_btn_link ); ?>"><?php echo esc_html( $envira_header_btn_lbl ); ?><i class="fa <?php echo esc_attr( $envira_header_btn_icon ); ?>"></i></a>
										<?php endif; ?>
									</li>
								<?php } ?>	
							</ul>
						</div>
					</div>
					<!-- Start Mobile Menu -->
					<div class="mobile-menu-area d-lg-none">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="mobile-menu">
										<nav class="mobile-menu-active">
											<?php 
												wp_nav_menu( 
													array(  
														'theme_location' => 'primary_menu',
														'container'  => '',
														'menu_class' => '',
														'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
														'walker' => new WP_Bootstrap_Navwalker()
														) 
													);
												?>
										</nav>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Mobile Menu -->
				</div>
			</div>	
			<!-- Navigation End -->
		</div>
	</div>
</header>
<?php 
if ( !is_page_template( 'templates/template-homepage.php' ) ) {
		startkit_breadcrumbs_style(); 
	}
?>