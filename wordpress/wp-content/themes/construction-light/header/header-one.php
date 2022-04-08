<header id="masthead" class="site-header headerone">
	<?php if(get_theme_mod('construction_light_top_header_enable', 'enable') == 'enable'): ?>
	<div class="cons_light_top_bar hide-on-mobile-<?php echo esc_attr(get_theme_mod('construction_light_top_header_hide_mobile', 'enable')); ?>">
        <div class="container">
        	<div class="row">
            	<div class="col-lg-6 col-md-6 col-sm-12 top-bar-menu left wow fadeInLeft">
	            	<?php
						$topheaderleft = get_theme_mod( 'construction_light_topheader_left', 'quick_contact' );
						
						if($topheaderleft == 'quick_contact'){    

						    construction_light_quick_contact();

						}else if($topheaderleft == 'social_media'){    

						    construction_light_topheader_social();

						}else{

							wp_nav_menu( array( 'theme_location' => 'menu-2', 'depth' => 1 ) );
						}
					?>
	            </div>

	            <div class="col-lg-6 col-md-6 col-sm-12 top-bar-menu right wow fadeInRight">
	            	<?php
						$topheaderright = get_theme_mod( 'construction_light_topheader_right', 'social_media' );

						if($topheaderright == 'quick_contact'){    

						    construction_light_quick_contact();

						}else if($topheaderright == 'social_media'){    

						    construction_light_topheader_social();

						}else{

							wp_nav_menu( array( 'theme_location' => 'menu-2', 'depth' => 1 ) );
						}
					?>
	            </div>
	        </div>
        </div>
    </div>
	<?php endif; ?>

    <div class="nav-classic">
	    <div class="container">
	        <div class="row">
	        	<div class="col-md-12">
		        	<div class="header-middle-inner">
		            	<div class="site-branding">
							
							<div class="brandinglogo-wrap">
			            		<?php the_custom_logo(); ?>

					            <h1 class="site-title">
					                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					                    <?php bloginfo( 'name' ); ?>
					                </a>
					            </h1>
					            <?php 
					                $construction_light_description = get_bloginfo( 'description', 'display' );
					                if ( $construction_light_description || is_customize_preview() ) : ?>
					                    <p class="site-description"><?php echo $construction_light_description; /* WPCS: xss ok. */ ?></p>
					            <?php endif; ?>
					        </div>

				            <?php do_action('construction_light_menu_toggle'); ?>
							<!-- Mobile navbar toggler  -->

							
				        </div> <!-- .site-branding -->
					       
		                <div class="contact-info hide-on-mobile-<?php  echo esc_attr(get_theme_mod('construction_light_quick_info_hide_mobile', 'disable')); ?>">
						    <div class="quickcontact">
					        	<?php
					        		$phone_number  = get_theme_mod('construction_light_contact_num');
						            $phonenumber   = preg_replace('/\D+/','', $phone_number );
						            $email_address = get_theme_mod('construction_light_email');
						            $map_address   = get_theme_mod('construction_light_address');

					            if(!empty( $phone_number )) { ?>

				                	<div class="get-tuch">
				                	    <i class="fas fa-phone-volume"></i>
				                	    <ul>
				                	        <li>
				                	            <h4><?php esc_html_e('Phone Number','construction-light'); ?></h4>
				                	        </li>
				                	        <li>
				                	        	<p>
					                	            <a href="tel:<?php if($phone_number[0] == '+') echo '0'; echo esc_attr( $phonenumber ); ?>">
		        			                            <?php echo esc_html( $phone_number ); ?>
		        			                        </a>
		        			                    </p>
				                	        </li>
				                	    </ul>
				                	</div>

					            <?php }  if(!empty( $map_address )) { ?>

				            		<div class="get-tuch">
				            		    <i class="fas fa-map-marker-alt"></i>
				            		    <ul>
				            		        <li>
				            		            <h4><?php esc_html_e('Contact Address','construction-light'); ?></h4>
				            		        </li>
				            		        <li>
				            		            <p><?php echo esc_html( $map_address ); ?></p>
				            		        </li>
				            		    </ul>
				            		</div>
					                    
					            <?php }  if(!empty( $email_address )) { ?>

				            		<div class="get-tuch">
				            		    <i class="far fa-envelope"></i>
				            		    <ul>
				            		        <li>
				            		            <h4><?php esc_html_e('Email Address','construction-light'); ?></h4>
				            		        </li>
				            		        <li>
				            		            <p>
				            		            	<a href="mailto:<?php echo esc_attr( antispambot( $email_address ) ); ?>">
									                    
									                    <?php echo esc_html( antispambot( $email_address ) ); ?>
									                </a>
				            		            </p>
				            		        </li>
				            		    </ul>
				            		</div>
					           	
					            <?php }  ?>
						    </div> <!--/ End Contact -->
						</div>
			        </div>
					<?php
						$enable_search = get_theme_mod('construction_light_enable_search', 'enable');
						$search_layout = get_theme_mod('construction_light_search_layout', 'layout_one');
					?>
					<div class="nav-menu">
						<nav class="box-header-nav main-menu-wapper" aria-label="<?php esc_attr_e( 'Main Menu', 'construction-light' ); ?>" role="navigation">
							<?php
								wp_nav_menu( array(
										'theme_location'  => 'menu-1',
										'menu'            => 'primary-menu',
										'container'       => '',
										'container_class' => '',
										'container_id'    => '',
										'menu_class'      => 'main-menu',
									)
								);
							?>
							<?php if( $enable_search == 'enable' and $search_layout == 'layout_two'): ?>
							<div class="search-wrapper search-layout-two conslight-search-wrapper">
								<?php get_search_form(); ?>
								<div class="search-layout-two conslight-close-icon">
									<span>x</span>
								</div>
							</div>
							<?php endif; ?>
			            </nav>
						<?php if( $enable_search == 'enable'): ?>
			            <div class="extralmenu-wrap">
							<ul>
								<li class="menu-item-search"><a class="searchicon <?php echo esc_html($search_layout); ?>" href="javascript:void(0)"><i class="fas fa-search"></i></a></li>
							</ul>
						</div>
						<?php endif; ?>
					</div>
				</div>
	        </div><!-- .row end -->
	    </div><!-- .container end -->
	</div>

</header><!-- #masthead -->