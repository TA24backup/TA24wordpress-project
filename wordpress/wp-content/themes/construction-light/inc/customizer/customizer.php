<?php
/**
 * Construction Light Theme Customizer
 *
 * @package Construction Light
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function construction_light_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	//$wp_customize->remove_control("header_image");

	if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'construction_light_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'construction_light_customize_partial_blogdescription',
		) );
	}

	if (class_exists('woocommerce')) {
		require get_template_directory() . '/inc/customizer/product-type-settings.php';
	}
	$construction_light_pro_features = '<ul class="upsell-features">
        <li>' . esc_html__( "40+ One Click Pre-defined demos" , "construction-light" ) . '</li>
		<li>' . esc_html__( "Margin & Padding Controls" , "construction-light" ) . '</li>
		<li>' . esc_html__( "Drag and Drop Re-Order" , "construction-light" ) . '</li>
        <li>' . esc_html__( "Advance Customizer & Widgets" , "construction-light" ) . '</li>
        <li>' . esc_html__( "Unlimited Color Options" , "construction-light" ) . '</li>
        <li>' . esc_html__( "Advanced Top Header Setting" , "construction-light" ) . '</li>
        <li>' . esc_html__( "Search Options (with category, Ajax)" , "construction-light" ) . '</li>
        <li>' . esc_html__( "GDPR Compliance & Cookies Consent" , "construction-light" ) . '</li>
        <li>' . esc_html__( "Included Maintenance Mode" , "construction-light" ) . '</li>
        <li>' . esc_html__( "Slider Type and Layout Options" , "construction-light" ) . '</li>
        <li>' . esc_html__( "20+ Custom Elementor Block" , "construction-light" ) . '</li>
        <li>' . esc_html__( "14+ Custom Widgets" , "construction-light" ) . '</li>
        <li>' . esc_html__( "Remove Footer Credit Text" , "construction-light" ) . '</li>
        <li>' . esc_html__( "Breadcrumb Layout and Option" , "construction-light" ) . '</li>
        <li>' . esc_html__( "Website layout (Fullwidth or Boxed)" , "construction-light" ) . '</li>
        <li>' . esc_html__( "4+ advanced blog Layout" , "construction-light" ) . '</li>
        <li>' . esc_html__( "WooCommerce Compatible" , "construction-light" ) . '</li>
        <li>' . esc_html__( "Fully Multilingual and Translation ready" , "construction-light" ) . '</li>
		<li>' . esc_html__( "WPML Support" , "construction-light" ) . '</li>
		<li>' . esc_html__( "One Click Demo Import Included" , "construction-light" ) . '</li>
        <li>' . esc_html__( "Fully RTL ready" , "construction-light" ) . '</li>
    </ul>';
    
    /**
     * Important Link
    */
    $wp_customize->add_section('construction_light_implink_link_section',array(
        'title'       => esc_html__( 'Pro Theme Features', 'construction-light' ),
        'priority'      => 1
    ));
	// Register custom section types.
	$wp_customize->register_section_type( 'Construction_Light_Customize_Section_Pro' );
	$wp_customize->register_section_type('Construction_Light_Upgrade_Section');

      $wp_customize->add_setting('construction_light_theme_features', array(
		  'title' => esc_html__('Pro Theme Features', 'construction-light'),
		  'sanitize_callback' => 'construction_light_sanitize_checkbox',	//done
          'priority'      => -1
      ));

      $wp_customize->add_control( 'construction_light_theme_features', array(
          'settings'    => 'construction_light_theme_features',
          'section'   => 'construction_light_implink_link_section',
          'description' => $construction_light_pro_features,
      ));

	$wp_customize->get_section( 'static_front_page' )->title = esc_html__('Enable Front Page', 'construction-light');
	$wp_customize->get_section( 'static_front_page' )->priority = 3;


	/**
	 *	Enable Front Page.
	*/

    $wp_customize->add_setting('construction_light_enable_frontpage', array(
    	'default' => false,
        'sanitize_callback' => 'construction_light_sanitize_checkbox',	//done
    ));

    $wp_customize->add_control('construction_light_enable_frontpage', array(
        'type' => 'checkbox',
        'label' => esc_html__('Enable Construction Light Front Page?', 'construction-light'),
        'section' => 'static_front_page',
        'description' => esc_html__( 'Note :- Front Page only Works after selecting "Your latest posts" Options & Enabling the check box', 'construction-light' )
    ));


    $wp_customize->get_section( 'colors' )->title = esc_html__('Theme Colors Settings', 'construction-light');
	$wp_customize->get_section( 'colors' )->priority = 3;

	// Primary Color.
	$wp_customize->add_setting('construction_light_primary_color', array(
	    'default' => '#ffc107',
	    'sanitize_callback' => 'sanitize_hex_color',
	));

	$wp_customize->add_control('construction_light_primary_color', array(
	    'type' => 'color',
	    'label' => esc_html__('Primary Color', 'construction-light'),
	    'section' => 'colors',
	));

    /**
	 * Add General Settings Panel
	 *
	 * @since 1.0.0
	*/
	$wp_customize->add_panel(
	    'construction_light_general_settings_panel',
	    array(
	        'priority'       => 3,
	        'title'          => esc_html__( 'General Settings', 'construction-light' ),
	    )
	);


		$wp_customize->get_section( 'title_tagline' )->panel = 'construction_light_general_settings_panel';
		$wp_customize->get_section( 'title_tagline' )->priority = 5;

		$wp_customize->get_section( 'header_image' )->panel = 'construction_light_general_settings_panel';
		$wp_customize->get_section( 'header_image' )->priority = 7;


		$wp_customize->get_section( 'background_image' )->panel = 'construction_light_general_settings_panel';
		$wp_customize->get_section( 'background_image' )->priority = 15;

		$wp_customize->add_setting('title_tagline_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'title_tagline_upgrade_text', array(
	        'section' => 'title_tagline',
	        'label' => esc_html__('For more settings,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Customize title and tagline width', 'construction-light'),
	        ),
	        'priority' => 100
	    )));

    // List All Pages
	$pages = array();

	$pages_obj = get_pages();

	$pages[''] = esc_html__('Select Page', 'construction-light');

	foreach ($pages_obj as $page) {
	    $pages[$page->ID] = $page->post_title;
	}
	
	// List All Category
	$categories = get_categories();
	$blog_cat = array();

	foreach ($categories as $category) {
	    $blog_cat[$category->term_id] = $category->name;
	}

	/**
	 * Header Settings.
	*/
	$wp_customize->add_panel('construction_light_header_settings', array(
		'title'		=>	esc_html__('Header Setting','construction-light'),
		'priority'	=>	10,
	));

	/**
	 * Top Header 
	*/
	$wp_customize->add_section('construction_light_top_header', array(
		'title'		=>	esc_html__('Top Header Settings','construction-light'),
		'panel'		=> 'construction_light_header_settings',
	));

	$wp_customize->add_setting('construction_light_top_header_enable', array(
		'default' => 'enable',
		'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		'transport' => 'postMessage',
	));

	$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_top_header_enable', array(
		'label' => esc_html__('Enable / Disable', 'construction-light'),
		'section' => 'construction_light_top_header',
		'switch_label' => array(
			'enable' => esc_html__('Enable', 'construction-light'),
			'disable' => esc_html__('Disable', 'construction-light'),
		),
	)));

	$wp_customize->add_setting('construction_light_top_header_hide_mobile', array(
		'default' => 'enable',
		'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		'transport' => 'postMessage',
	));

	$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_top_header_hide_mobile', array(
		'label' => esc_html__('Hide On Mobile', 'construction-light'),
		'section' => 'construction_light_top_header',
		'switch_label' => array(
			'enable' => esc_html__('Yes', 'construction-light'),
			'disable' => esc_html__('No', 'construction-light'),
		),
	)));

	$topheader_options = array(
        'quick_contact' => esc_html__('Quick Contact Information', 'construction-light'),
        'social_media'  => esc_html__('Social Media Links', 'construction-light'),
        'top_menu'  => esc_html__('Top Menu Nav', 'construction-light'),
    );

		// Top Header Left Side Options.
		$wp_customize->add_setting('construction_light_topheader_left', array(
		    'default' => 'quick_contact',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_select'        //done
		));

		$wp_customize->add_control('construction_light_topheader_left', array(
		    'label' => esc_html__('Top Header Left Side', 'construction-light'),
		    'section' => 'construction_light_top_header',
		    'type' => 'select',
		    'choices' => $topheader_options
		));

		// Top Header Right Side Options.
		$wp_customize->add_setting('construction_light_topheader_right', array(
		    'default' => 'social_media',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_select'        //done
		));

		$wp_customize->add_control('construction_light_topheader_right', array(
		    'label' => esc_html__('Top Header Right Side', 'construction-light'),
		    'section' => 'construction_light_top_header',
		    'type' => 'select',
		    'choices' => $topheader_options
		));

	// Top Header Contact Address.
	$wp_customize->add_setting('construction_light_address', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',			//done
	));

	$wp_customize->add_control('construction_light_address', array(
		'label'			=> esc_html__( 'Enter Contact Address', 'construction-light' ),
		'section'		=> 'construction_light_top_header',
		'type' 			=> 'text',
	));

	//Top Header Contact Number.
	$wp_customize->add_setting( 'construction_light_contact_num', array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',			//done
	));

	$wp_customize->add_control('construction_light_contact_num', array(
		'label'			=> esc_html__( 'Enter Contact Number', 'construction-light' ),
		'section'		=> 'construction_light_top_header',
		'type' 			=> 'text',
	));
	
	//Top Header Contact Email.
	$wp_customize->add_setting( 'construction_light_email', array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',			//done
	));

	$wp_customize->add_control('construction_light_email', array(
		'label'			=> esc_html__( 'Enter Email Address', 'construction-light' ),
		'section'		=> 'construction_light_top_header',
		'type' 			=> 'text',
	));

	//  Top Header Social Links.
	$wp_customize->add_setting('construction_light_topheader_social', array(
		'transport'         => 'postMessage',
	    'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
	    'default' => json_encode(array(
	        array(
	            'topheader_icon' =>'fab fa-facebook-f',
	            'social_link'   => '',
	        )
	    ))
	));

	$wp_customize->add_control( new Construction_Light_Repeater_Control( $wp_customize, 
		'construction_light_topheader_social', 
		array(
		    'label' 	   => esc_html__('Social Links Settings', 'construction-light'),
		    'section' 	   => 'construction_light_top_header',
		    'settings' 	   => 'construction_light_topheader_social',
		    'cl_box_label' => esc_html__('Social Links Options', 'construction-light'),
		    'cl_box_add_control' => esc_html__('Add New', 'construction-light'),
		),

	    array(

	        'topheader_icon' => array(
	            'type' => 'icons',
	            'label' => esc_html__('Choose Icon', 'construction-light'),
	            'default' => 'fab fa-facebook-f'
	        ),
	        
	        'social_link' => array(
	            'type' => 'url',
	            'label' => esc_html__('Enter Social Link', 'construction-light'),
	            'default' => ''
	        )
		)

	) );

	$wp_customize->add_setting('construction_light_top_header_upgrade_text', array(
        'sanitize_callback' => 'construction_light_sanitize_text'
    ));

    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_top_header_upgrade_text', array(
        'section' => 'construction_light_top_header',
        'label' => esc_html__('For more settings,', 'construction-light'),
        'choices' => array(
            esc_html__('Advanced user friendly customizer', 'construction-light'),
            esc_html__('Enable/Disable Top Header', 'construction-light'),
            esc_html__('Change Top Header Background Color', 'construction-light'),
            esc_html__('Change text and anchor link color', 'construction-light'),
            esc_html__('Customize header padding', 'construction-light'),
        ),
        'priority' => 100
    )));


	/**
	 * Header Layout Settings
	*/
	$wp_customize->add_section('construction_light_header', array(
		'title'		=>	esc_html__('Header Layout Settings','construction-light'),
		'panel'		=> 'construction_light_header_settings',
	));

		//  Header Left Side Options.
		$wp_customize->add_setting('construction_light_header_layout', array(
			'transport' => 'postMessage',
		    'default' => 'layout_one',
		    'sanitize_callback' => 'construction_light_sanitize_select'        //done
		));

		$wp_customize->add_control('construction_light_header_layout', array(
		    'label' => esc_html__('Header Layout', 'construction-light'),
		    'section' => 'construction_light_header',
		    'type' => 'select',
		    'choices' => array(
		    	'layout_one' => esc_html__('Layout One' , 'construction-light'),
		    	'layout_two' => esc_html__('Layout Two' ,'construction-light'),
		    	'layout_three' => esc_html__('Layout Three' ,'construction-light'),
		    )
		));

		$wp_customize->selective_refresh->add_partial('construction_light_topheader_settings', array(
			'settings' => array('construction_light_top_header_enable','construction_light_topheader_left','construction_light_topheader_right','construction_light_topheader_social','construction_light_header_layout'),
			'selector' => '#masthead',
			'container_inclusive' => true,
			'render_callback' => function() {
				if(get_theme_mod('construction_light_header_layout','layout_one') === 'layout_one') {
					return get_template_part('header/header', 'one');
				} else if(get_theme_mod('construction_light_header_layout','layout_one') === 'layout_two') {
					return get_template_part('header/header', 'two');
				} else if(get_theme_mod('construction_light_header_layout','layout_one') === 'layout_three') {
					return get_template_part('header/header', 'three');
				}
			}
		));

		$wp_customize->add_setting('construction_light_enable_search', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_enable_search', array(
		    'label' => esc_html__('Search Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_header',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		$wp_customize->add_setting('construction_light_quick_info_hide_mobile', array(
		    'default' => 'disable',
			// 'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_quick_info_hide_mobile', array(
		    'label' => esc_html__('Quick Info Hide On Mobile', 'construction-light'),
		    'section' => 'construction_light_header',
		    'switch_label' => array(
		        'enable' => esc_html__('Yes', 'construction-light'),
		        'disable' => esc_html__('No', 'construction-light'),
		    ),
		)));

		$wp_customize->add_setting('construction_light_search_layout', array(
		    'default' => 'layout_one',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_select'        //done
		));

		$wp_customize->add_control('construction_light_search_layout', array(
		    'label' => esc_html__('Search Layout', 'construction-light'),
		    'section' => 'construction_light_header',
		    'type' => 'select',
		    'choices' => array(
		    	'layout_one' => esc_html__('Layout One' , 'construction-light'),
		    	'layout_two' => esc_html__('Layout Two' ,'construction-light'),
		    )
		));

		$wp_customize->selective_refresh->add_partial('construction_light_search_settings', array(
			'settings' => array('construction_light_enable_search','construction_light_search_layout'),
			'selector' => '#masthead',
			'container_inclusive' => true,
			'render_callback' => function() {
				return get_template_part('header/header', 'one');
			}
		));

		$wp_customize->add_setting('construction_light_header_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_header_upgrade_text', array(
	        'section' => 'construction_light_header',
	        'label' => esc_html__('For more styling,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Five Header Layouts', 'construction-light'),
	            esc_html__('Customize header padding', 'construction-light'),
	            esc_html__('Select Background Type', 'construction-light'),
	            esc_html__('Select Background Color', 'construction-light'),
	            esc_html__('Change Quick Info Color', 'construction-light'),
	            esc_html__('Change Nav Text Color, Background and Wrapper Color ', 'construction-light'),
	            esc_html__('Change Hover and Active Color', 'construction-light'),
	            esc_html__('Change Header Text Color', 'construction-light'),
	        ),
	        'priority' => 100
	    )));
	

	/**
	 * Home Page Settings
	*/
	$wp_customize->add_panel('construction_light_frontpage_settings', array(
		'title'		=>	esc_html__('Home Sections','construction-light'),
		'priority'	=>	35,
		'description' => esc_html__('Drag and Drop to Reorder', 'construction-light'). '<img class="construction_light-drag-spinner" src="'.admin_url('/images/spinner.gif').'">',
	));


		/**
		 *	Main Banner Slider.
		*/
		$wp_customize->add_section('construction_light_slider_section', array(
			'title'		=>	esc_html__('Home Slider Settings','construction-light'),
			'panel'		=> 'construction_light_frontpage_settings',
			'priority'  => -1
		));


		/**
         * Enable/Disable Option
         *
         * @since 1.0.0
        */
        $wp_customize->add_setting('construction_light_banner_slider_section', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_banner_slider_section', array(
		    'label' => esc_html__('Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_slider_section',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		/** Slider Navigation Style */
		$wp_customize->add_setting('construction_light_nav_style', array(
			'default' => '1',
			'transport' => 'postMessage',
			'sanitize_callback' => 'construction_light_sanitize_select'         
		));

		$wp_customize->add_control('construction_light_nav_style', array(
			'label'   => esc_html__('Navigation Style','construction-light'),
			'section' => 'construction_light_slider_section',
			'type'    => 'select',
			'choices' => array(
				'1' => esc_html__('Style 1','construction-light'),
				'2' => esc_html__('Style 2','construction-light'),			
			)
		));
		
		/** Slider type */
		$wp_customize->add_setting('construction_light_slider_type', array(
			'default' => 'default',
			'transport' => 'postMessage',
			'sanitize_callback' => 'construction_light_sanitize_select'
		));

		$wp_customize->add_control('construction_light_slider_type', array(
			'section' => 'construction_light_slider_section',
			'type' => 'radio',
			'label' => esc_html__('Slider Type', 'construction-light'),
			'choices' => array(
				'default' => esc_html__('Default Slider', 'construction-light'),
				'advance' => esc_html__('Advance Slider', 'construction-light'),	
			)
		));

		// Normal Page Slider Type
		$wp_customize->add_setting('construction_light_slider', array(
		    'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
			'transport' => 'postMessage',
		    'default' => json_encode(array(
		        array(
		            'slider_page' => '',
		            'button_text' => '',
		            'button_url' => '',
		            'button_one_text' => '',
		            'button_one_url' => '',
		        )
		    ))
		));

		$wp_customize->add_control(new Construction_Light_Repeater_Control( $wp_customize, 
			'construction_light_slider', 
			array(
			    'label' 	   => esc_html__('Banner Slider Page Settings', 'construction-light'),
			    'section' 	   => 'construction_light_slider_section',
			    'settings' 	   => 'construction_light_slider',
			    'cl_box_label' => esc_html__('Slider Settings Options', 'construction-light'),
			    'cl_box_add_control' => esc_html__('Add New Slider', 'construction-light'),
			),

		    array(

		        'slider_page' => array(
		            'type' => 'select',
		            'label' => esc_html__('Select Slider Page', 'construction-light'),
		            'options' => $pages
		        ),

		        'button_text' => array(
		            'type' => 'text',
		            'label' => esc_html__('Enter First Button Text', 'construction-light'),
		            'default' => ''
		        ),
		        
		        'button_url' => array(
		            'type' => 'url',
		            'label' => esc_html__('Enter First Button Url', 'construction-light'),
		            'default' => ''
		        ),

		        'button_one_text' => array(
		            'type' => 'text',
		            'label' => esc_html__('Enter Second Button Text', 'construction-light'),
		            'default' => ''
		        ),
		        
		        'button_one_url' => array(
		            'type' => 'url',
		            'label' => esc_html__('Enter Second Button Url', 'construction-light'),
		            'default' => ''
		        ),
			)
		));

	/**
	 * advance slider
	 */
	$wp_customize->add_setting('construction_light_sliders', array(
		'sanitize_callback' => 'construction_light_sanitize_repeater',
		'transport' => 'postMessage',
		'default' => json_encode(array(
			array(
				'image' => '',
				'title' => '',
				'subtitle' => '',
				'button_link' => '',
				'button_link_one' => '',
				'button_text' => esc_html__('Read More', 'construction-light'),
				'button_text_one' => '',
			)
		)),
		// 'transport' => 'postMessage'
	));
	$wp_customize->add_control(new Construction_Light_Repeater_Control($wp_customize, 
	'construction_light_sliders', 
		array(
			'label' => esc_html__('Add Sliders', 'construction-light'),
			'section' => 'construction_light_slider_section',
			'cl_box_label' => esc_html__('Slider', 'construction-light'),
			'cl_box_add_control' => esc_html__('Add Slider', 'construction-light'),
		), 
		array(
		'image' => array(
			'type' => 'upload',
			'label' => esc_html__('Upload Image', 'construction-light'),
			'default' => ''
		),
		'title' => array(
			'type' => 'text',
			'label' => esc_html__('Slider Caption Title', 'construction-light'),
			'default' => ''
		),
		'subtitle' => array(
			'type' => 'textarea',
			'label' => esc_html__('Slider Caption Subtitle', 'construction-light'),
			'default' => ''
		),
		'button_link' => array(
			'type' => 'text',
			'label' => esc_html__('First Button Link', 'construction-light'),
			'default' => ''
		),
		'button_text' => array(
			'type' => 'text',
			'label' => esc_html__('First Button Text', 'construction-light'),
			'default' => esc_html__('Read More', 'construction-light')
		),
		'button_link_one' => array(
			'type' => 'text',
			'label' => esc_html__('Second Button Link', 'construction-light'),
			'default' => ''
		),
		'button_text_one' => array(
			'type' => 'text',
			'label' => esc_html__('Second Button Text', 'construction-light'),
			'default' => ''
		),
		
	)));

	$wp_customize->selective_refresh->add_partial( 'construction_light_slider_type', array (
		'settings' => array( 'construction_light_slider_type' ),
		'selector' => '.slider-title',
	));

	$wp_customize->selective_refresh->add_partial('construction_light_banner_slider_settings', array(
		'settings' => array('construction_light_banner_slider_section','construction_light_slider_type','construction_light_slider','construction_light_sliders'),
		'selector' => '#banner-slider',
		'container_inclusive' => true,
		'render_callback' => function() {
			if(get_theme_mod('construction_light_banner_slider_section', 'enable') === 'enable') {
				if(get_theme_mod('construction_light_slider_type', 'default') === 'default') {
					return do_action('construction_light_action_banner_slider');
				} else {
					return do_action('construction_light_action_advance_banner_slider');
				}
			}
		}
	));

	// enable contact form
	$wp_customize->add_setting('construction_light_banner_contact_enable', array(
		'default' => 'disable',
		// 'transport' => 'postMessage',
		'sanitize_callback' => 'construction_light_sanitize_switch',     //done
	));

	$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_banner_contact_enable', array(
		'label' => esc_html__('Enable Contact Form', 'construction-light'),
		'section' => 'construction_light_slider_section',
		'switch_label' => array(
			'enable' => esc_html__('Yes', 'construction-light'),
			'disable' => esc_html__('No', 'construction-light'),
		),
	)));
	
	$wp_customize->add_setting('construction_light_contact_form', array(
		// 'transport' => 'postMessage',
		'sanitize_callback' => 'construction_light_sanitize_text'         
	));

	$wp_customize->add_control('construction_light_contact_form', array(
		'label'   => esc_html__('Contact Form Short Code','construction-light'),
		'section' => 'construction_light_slider_section',
		'type'    => 'text',
		'description' => esc_html__( 'Example: [contact-form-7 id="897" title="Untitled"]', 'construction-light' )
		
	));

	$wp_customize->add_setting('construction_light_slider_section_upgrade_text', array(
        'sanitize_callback' => 'construction_light_sanitize_text'
    ));

    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_slider_section_upgrade_text', array(
        'section' => 'construction_light_slider_section',
        'label' => esc_html__('For more styling and controls,', 'construction-light'),
        'choices' => array(
        	esc_html__('Advanced Level of Customization', 'construction-light'),
            esc_html__('Select Slider Types', 'construction-light'),
            esc_html__('Supports Revolution Slider', 'construction-light'),
            esc_html__('Customize Slider Overlay Color', 'construction-light'),
            esc_html__('Customize Title and Description Color', 'construction-light'),
            esc_html__('Customize Caption Button Color', 'construction-light'),
            esc_html__('Customize Slider Section Margin and Padding', 'construction-light'),
            esc_html__('Adjust Slider Height', 'construction-light'),
        ),
        'priority' => 100
    )));

	/**
	 * Features Service Section 
	*/
	$wp_customize->add_section('construction_light_promoservice_section', array(
		'title'		=>	esc_html__('Features Service Section','construction-light'),
		'panel'		=> 'construction_light_frontpage_settings',
		'priority'  => construction_light_get_section_position('construction_light_promoservice_section')
	));


		/**
         * Enable/Disable Option
         *
         * @since 1.0.0
        */
        $wp_customize->add_setting('construction_light_features_service_section', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_features_service_section', array(
		    'label' => esc_html__('Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_promoservice_section',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		$wp_customize->add_setting('construction_light_promoservice_type', array(
			'sanitize_callback' => 'construction_light_sanitize_select',
			'default' => 'normal',
			'transport' => 'postMessage'
		));
		
		$wp_customize->add_control('construction_light_promoservice_type', array(
			'type' => 'radio',
			'section' => 'construction_light_promoservice_section',
			'label' => esc_html__('Type', 'construction-light'),
			'choices' => array(
				'normal' => esc_html__('Default', 'construction-light'),
				'advance' => esc_html__('Advance', 'construction-light')
			)
		));

		$wp_customize->selective_refresh->add_partial( 'construction_light_promoservice_type', array (
			'settings' => array( 'construction_light_promoservice_type' ),
			'selector' => '#cl-promoservice-section .feature-list'
		));

		//  Features Service Page.
		$wp_customize->add_setting('construction_light_promo_service', array(
		    'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
			'transport' => 'postMessage',
		    'default' => json_encode(array(
		        array(
		            'promoservice_page' => '',
		            'promoservice_icon' =>'fa fa-cogs',

		        )
		    ))
		));

		$wp_customize->add_control(new Construction_Light_Repeater_Control( $wp_customize, 
			'construction_light_promo_service', 

			array(
			    'label' 	   => esc_html__('Features Service Settings', 'construction-light'),
			    'section' 	   => 'construction_light_promoservice_section',
			    'settings' 	   => 'construction_light_promo_service',
			    'cl_box_label' => esc_html__('Features Service Settings', 'construction-light'),
			    'cl_box_add_control' => esc_html__('Add New', 'construction-light'),
			),

		    array(

		        'promoservice_page' => array(
		            'type' => 'select',
		            'label' => esc_html__('Select Page', 'construction-light'),
		            'options' => $pages
		        ),

		        'promoservice_icon' => array(
		            'type' => 'icons',
		            'label' => esc_html__('Choose Icon', 'construction-light'),
		            'default' => 'fa fa-cogs'
		        )
			)
		));

		$wp_customize->add_setting('construction_light_promoservice_advance', array(
			'sanitize_callback' => 'construction_light_sanitize_repeater',
			'transport' => 'postMessage',
			'default' => json_encode(array(
				array(
					'icon' => 'icofont-angry-monster',
					'title' => '',
					'content' => '',
					'link_text' => '',
					'link' => ''
				)
			)),
			// 'transport' => 'postMessage'
		));
		/**
		 * advance features
		 */
		$wp_customize->add_control(new Construction_Light_Repeater_Control($wp_customize, 'construction_light_promoservice_advance', array(
			'section' => 'construction_light_promoservice_section',
			'label' 	   => esc_html__('Features Service Settings', 'construction-light'),
			'cl_box_label' => esc_html__('Service Block', 'construction-light'),
			'settings' 	   => 'construction_light_promoservice_advance',
			'cl_box_add_control' => esc_html__('Add New', 'construction-light'),
				), array(
			'image' => array(
				'type' => 'upload',
				'label' => esc_html__('Image', 'construction-light')
			),
			'icon' => array(
				'type' => 'icons',
				'label' => esc_html__('Select Icon', 'construction-light'),
				'default' => 'icofont-angry-monster'
			),
			'title' => array(
				'type' => 'text',
				'label' => esc_html__('Title', 'construction-light'),
				'default' => ''
			),
			'content' => array(
				'type' => 'textarea',
				'label' => esc_html__('Content', 'construction-light'),
				'default' => ''
			),
			'link_text' => array(
				'type' => 'text',
				'label' => esc_html__('Link Text', 'construction-light'),
				'default' => esc_html__('Read More', 'construction-light'),
			),
			'link' => array(
				'type' => 'text',
				'label' => esc_html__('Link', 'construction-light'),
				'default' => ''
			)
		)));

		$wp_customize->selective_refresh->add_partial( 'construction_light_promoservice_settings', array (
			'settings' => array('construction_light_features_service_section','construction_light_promoservice_type','construction_light_promo_service','construction_light_promoservice_advance'),
			'selector' => '#cl-promoservice-section',
			'container_inclusive' => true,
			'render_callback' => function () {
				if(get_theme_mod('construction_light_features_service_section', 'enable') === 'enable') {
					return get_template_part('section/section', 'promoservice');
				} 
			}
		));

		$wp_customize->add_setting('construction_light_promoservice_section_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_promoservice_section_upgrade_text', array(
	        'section' => 'construction_light_promoservice_section',
	        'label' => esc_html__('For more styling and controls,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Change Main Title, Title and Sub-Title', 'construction-light'),
	            esc_html__('Select from various title styles', 'construction-light'),
	            esc_html__('Choose service block style from default to advanced and vice-versa', 'construction-light'),
	            esc_html__('Select from various service styles', 'construction-light'),
	            esc_html__('Change Main Title, Section Title and Text Color', 'construction-light'),
	            esc_html__('Change Icon Color and Icon Background Color', 'construction-light'),
	            esc_html__('Choose from various background types', 'construction-light'),
	            esc_html__('Customize Padding', 'construction-light'),
	        ),
	        'priority' => 100
	    )));
	
	/**
	 * About Us Section 
	*/
	$wp_customize->add_section('construction_light_aboutus_section', array(
		'title'		=>	esc_html__('About Us Section','construction-light'),
		'panel'		=> 'construction_light_frontpage_settings',
		'priority'  => construction_light_get_section_position('construction_light_aboutus_section')
	));

		/**
         * Enable/Disable Option
         *
         * @since 1.0.0
        */
        $wp_customize->add_setting('construction_light_aboutus_service_section', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_aboutus_service_section', array(
		    'label' => esc_html__('Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_aboutus_section',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		// About Us Page.
		$wp_customize->add_setting( 'construction_light_aboutus', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'			//done
		) );

		$wp_customize->add_control( 'construction_light_aboutus', array(
			'label'    => esc_html__( 'Select Page ', 'construction-light' ),
			'section'  => 'construction_light_aboutus_section',
			'type'     => 'dropdown-pages'
		));

		// About Us Image.
		$wp_customize->add_setting('construction_light_aboutus_image2', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw'		//done
		));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'construction_light_aboutus_image2', array(
			'label'	   => esc_html__('Upload About Features Image','construction-light'),
			'section'  => 'construction_light_aboutus_section',
		)));
			
		// ));
	
		// About Us Content.
		$wp_customize->add_setting( 'construction_light_aboutus_content', array(
			'default' => 'excerpt',
			'transport' => 'postMessage',
			'sanitize_callback' => 'construction_light_sanitize_select'	    	//done
		) );

		$wp_customize->add_control( 'construction_light_aboutus_content', array(
			'label'    => esc_html__( 'Select Page ', 'construction-light' ),
			'section'  => 'construction_light_aboutus_section',
			'type'     => 'select',
			'choices' => array(
				'excerpt' => esc_html__('Excerpt','construction-light'),
				'full_content' => esc_html__('Full Content', 'construction-light')
			)
		));

		// About Us Button Text.
		$wp_customize->add_setting( 'construction_light_aboutus_button_text', array(
			'default'           => esc_html__( 'Read More','construction-light' ),
			'sanitize_callback' => 'sanitize_text_field'			//done
		) );

		$wp_customize->add_control( 'construction_light_aboutus_button_text', array(
			'label'    => esc_html__( 'Enter Button Text', 'construction-light' ),
			'section'  => 'construction_light_aboutus_section',
			'type'     => 'text',
			'active_callback' => 'construction_light_active_about_button'
		));

		$wp_customize->selective_refresh->add_partial('construction_light_aboutus_button_text', array(
			'selector' => '.about_us_front .btn',
			'container_inclusive' => true
		));
	

		$wp_customize->add_setting( 'construction_light_aboutus_email_address', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		));

		$wp_customize->add_control( 'construction_light_aboutus_email_address', array(
			'label'    => esc_html__( 'Enter About Us Email Address', 'construction-light' ),
			'section'  => 'construction_light_aboutus_section',
			'type'     => 'text',
		));


		$wp_customize->add_setting( 'construction_light_aboutus_phone_number', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		));

		$wp_customize->add_control( 'construction_light_aboutus_phone_number', array(
			'label'    => esc_html__( 'Enter About Us Phone Number', 'construction-light' ),
			'section'  => 'construction_light_aboutus_section',
			'type'     => 'text',
		));


		// About Us Show Progress Bar.
		$wp_customize->add_setting( 'construction_light_aboutus_progressbar', array(
			'default' => true,
			'transport' => 'postMessage',
			'sanitize_callback' => 'construction_light_sanitize_checkbox'			//done
		));

		$wp_customize->add_control( 'construction_light_aboutus_progressbar', array(
			'label'    => esc_html__( 'Check to Display Progress Bar', 'construction-light' ),
			'section'  => 'construction_light_aboutus_section',
			'type'     => 'checkbox'
		));

		// About Us Style
		$wp_customize->add_setting( 'construction_light_aboutus_style', array(
			'default' => 'left',
			'transport' => 'postMessage',
			'sanitize_callback' => 'construction_light_sanitize_select'			//done
		) );

		$wp_customize->add_control( 'construction_light_aboutus_style', array(
			'label'    => esc_html__( 'Display Style', 'construction-light' ),
			'section'  => 'construction_light_aboutus_section',
			'type'     => 'select',
			'choices'	=> array(
				'left'	=> esc_html__( 'Left', 'construction-light' ),
				'right'	=> esc_html__( 'Right', 'construction-light' ),
				'bottom' => esc_html__( 'Bottom', 'construction-light' ),
			)
		));

		// About Us Text Alignment
		$wp_customize->add_setting( 'construction_light_aboutus_alignment', array(
			'default' => 'text-left',
			'transport' => 'postMessage',
			'sanitize_callback' => 'construction_light_sanitize_select'			//done
		) );

		$wp_customize->add_control( 'construction_light_aboutus_alignment', array(
			'label'    => esc_html__( 'Text Alignment', 'construction-light' ),
			'section'  => 'construction_light_aboutus_section',
			'type'     => 'select',
			'choices'	=> array(
				'text-left'	=> esc_html__( 'Left', 'construction-light' ),
				'text-right'	=> esc_html__( 'Right', 'construction-light' ),
				'text-center' => esc_html__( 'Center', 'construction-light' ),
			)
		));

		// About Us Progress Bar.
		$wp_customize->add_setting('construction_light_progressbar', array(
		    'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
			'transport' => 'postMessage',
		    'default' => json_encode(array(
		        array(
		            'progressbar_title'  =>'',
		            'progressbar_number'  =>'',	            
		        )
		    ))
		));

		$wp_customize->add_control(new Construction_Light_Repeater_Control($wp_customize, 
			'construction_light_progressbar', 

			array(
			    'label' 	   => esc_html__('Achievement Awards Settings', 'construction-light'),
			    'section' 	   => 'construction_light_aboutus_section',
			    'settings' 	   => 'construction_light_progressbar',
			    'cl_box_label' => esc_html__('Achievement Awards Settings', 'construction-light'),
			    'cl_box_add_control' => esc_html__('Add New Awards', 'construction-light'),
			    'active_callback' => 'construction_light_active_progressbar'
			),
		    array(
		        'progressbar_title' => array(
		            'type' => 'text',
		            'label' => esc_html__('Enter Achievement Awards Title', 'construction-light'),
		            'default' => ''
		        ),

		        'progressbar_number' => array(
		            'type' => 'text',
		            'label' => esc_html__('Enter Number Achievement Awards ', 'construction-light'),
		            'default' => ''
		        ),
		        
			)
		));

		$wp_customize->selective_refresh->add_partial('construction_light_aboutus', array(
			'settings' => array('construction_light_aboutus'),
			'selector' => '#cl_aboutus h3',
		));

		$wp_customize->selective_refresh->add_partial('construction_light_aboutus_service_settings', array (
			'settings' => array('construction_light_aboutus_service_section','construction_light_aboutus','construction_light_aboutus_image2','construction_light_aboutus_content','construction_light_aboutus_progressbar','construction_light_aboutus_style','construction_light_aboutus_alignment','construction_light_progressbar'),
			'selector' => '#cl_aboutus',
			'container_inclusive' => true,
			'render_callback' => function () {
				if(get_theme_mod('construction_light_aboutus_service_section', 'enable') === 'enable') {
					return get_template_part('section/section', 'aboutus');
				}
			}
		));	

		$wp_customize->add_setting('construction_light_aboutus_text_color', array(
            'default' => '#000',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'construction_light_aboutus_text_color', array(
            'section' => 'construction_light_aboutus_section',
            'label' => esc_html__('Text Color', 'construction-light')
		)));
		

		$wp_customize->add_setting('construction_light_aboutus_bg_color', array(
            'default' => '#FFFFFF',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'construction_light_aboutus_bg_color', array(
            'section' => 'construction_light_aboutus_section',
            'label' => esc_html__('Background Color', 'construction-light')
        )));
		$wp_customize->add_setting('construction_light_aboutus_section_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_aboutus_section_upgrade_text', array(
	        'section' => 'construction_light_aboutus_section',
	        'label' => esc_html__('For more settings and controls,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Change About Us Section Layout', 'construction-light'),
	            esc_html__('Change About Us Section Alignment', 'construction-light'),
	            esc_html__('Change Main Title, Title and Text Color', 'construction-light'),
	            esc_html__('Change Background Type', 'construction-light'),
	            esc_html__('Customize Section Padding', 'construction-light'),
	        ),
	        'priority' => 100
	    )));

	/**
	 * Our Service Section 
	*/
	$wp_customize->add_section('construction_light_service_section', array(
		'title'		=>	esc_html__('Our Service Section','construction-light'),
		'panel'		=> 'construction_light_frontpage_settings',
		'priority'  => construction_light_get_section_position('construction_light_service_section')
	));

		/**
         * Enable/Disable Option
         *
         * @since 1.0.0
        */
        $wp_customize->add_setting('construction_light_service_service_section', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_service_service_section', array(
		    'label' => esc_html__('Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_service_section',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		// Our Service Section Title.
		$wp_customize->add_setting( 'construction_light_service_title', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		) );

		$wp_customize->add_control( 'construction_light_service_title', array(
			'label'    => esc_html__( 'Enter Service Section Title', 'construction-light' ),
			'section'  => 'construction_light_service_section',
			'type'     => 'text',
		));

		$wp_customize->selective_refresh->add_partial('construction_light_service_title', array(
			'settings' => array('construction_light_service_title'),
			'selector' => '#cl-service-section .section-title',
		));

		// Our Service Section Sub Title.
		$wp_customize->add_setting( 'construction_light_service_sub_title', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		));

		$wp_customize->add_control( 'construction_light_service_sub_title', array(
			'label'    => esc_html__( 'Enter Service Section Sub Title', 'construction-light' ),
			'section'  => 'construction_light_service_section',
			'type'     => 'text',
		));		

		$wp_customize->add_setting('construction_light_service_type', array(
			'sanitize_callback' => 'construction_light_sanitize_select',
			'default' => 'normal',
			'transport' => 'postMessage'
		));

		$wp_customize->add_control('construction_light_service_type', array(
			'type' => 'radio',
			'section' => 'construction_light_service_section',
			'label' => esc_html__('Type', 'construction-light'),
			'choices' => array(
				'normal' => esc_html__('Default', 'construction-light'),
				'advance' => esc_html__('Advance', 'construction-light')
			)
		));

		//  Our Service Page.
		$wp_customize->add_setting('construction_light_service', array(
		    'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
			'transport' => 'postMessage',
		    'default' => json_encode(array(
		        array(
		            'service_page' => '',
		            'service_icon' =>'fa fa-cogs'
		        )
		    ))
		));

		$wp_customize->add_control(new Construction_Light_Repeater_Control( $wp_customize,
			'construction_light_service', 
			array(
			    'label' 	   => esc_html__('Our Service Settings', 'construction-light'),
			    'section' 	   => 'construction_light_service_section',
			    'settings' 	   => 'construction_light_service',
			    'cl_box_label' => esc_html__('Service Settings Options', 'construction-light'),
			    'cl_box_add_control' => esc_html__('Add New Page', 'construction-light'),
			),
		    array(
		        'service_page' => array(
		            'type' => 'select',
		            'label' => esc_html__('Select Service Page', 'construction-light'),
		            'options' => $pages
		        ),

		        'service_icon' => array(
		            'type' => 'icons',
		            'label' => esc_html__('Choose Icon', 'construction-light'),
		            'default' => 'fa fa-cogs'
		        )
			)
		));

		/**
		 * advance features
		 */
		$wp_customize->add_setting('construction_light_service_advance', array(
			'sanitize_callback' => 'construction_light_sanitize_repeater',
			'transport' => 'postMessage',
			'default' => json_encode(array(
				array(
					'icon' => 'icofont-angry-monster',
					'title' => '',
					'content' => '',
					'link_text' => '',
					'link' => '',
				)
			)),
		));

		$wp_customize->add_control(new Construction_Light_Repeater_Control($wp_customize, 'construction_light_service_advance', array(
				'section' => 'construction_light_service_section',
				'label' 	   => esc_html__('Service Settings', 'construction-light'),
				'cl_box_label' => esc_html__('Service Block', 'construction-light'),
				'settings' 	   => 'construction_light_service_advance',
				'cl_box_add_control' => esc_html__('Add New', 'construction-light'),
			), array(
			'image' => array(
				'type' => 'upload',
				'label' => esc_html__('Image', 'construction-light'),
			),
			'icon' => array(
				'type' => 'icons',
				'label' => esc_html__('Select Icon', 'construction-light'),
				'default' => 'icofont-angry-monster'
			),
			'title' => array(
				'type' => 'text',
				'label' => esc_html__('Title', 'construction-light'),
				'default' => ''
			),
			'content' => array(
				'type' => 'textarea',
				'label' => esc_html__('Content', 'construction-light'),
				'default' => ''
			),
			'link_text' => array(
				'type' => 'text',
				'label' => esc_html__('Link Text', 'construction-light'),
				'default' => esc_html__('Read More', 'construction-light'),
			),
			'link' => array(
				'type' => 'text',
				'label' => esc_html__('Link', 'construction-light'),
				'default' => ''
			)
		)));

		// Our Service Section Button text.
		$wp_customize->add_setting( 'construction_light_service_button', array(
			'default'           => esc_html__( 'Read More','construction-light' ),
			'transport' 		=> 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		));

		$wp_customize->add_control( 'construction_light_service_button', array(
			'label'    => esc_html__( 'Enter Services Button Text', 'construction-light' ),
			'section'  => 'construction_light_service_section',
			'type'     => 'text',
		));

		// Service Section Layout.
		$wp_customize->add_setting( 'construction_light_service_layout', array(
			'default' => 'layout_one',
			'transport' => 'postMessage',
			'sanitize_callback' => 'construction_light_sanitize_select'			//done
		) );

		$wp_customize->add_control( 'construction_light_service_layout', array(
			'label'    => esc_html__( 'Our Service Layout', 'construction-light' ),
			'section'  => 'construction_light_service_section',
			'type'     => 'select',
			'choices'  => array(
				'layout_one'  => esc_html__('Layout One', 'construction-light'),
				'layout_two'  =>esc_html__('Layout Two', 'construction-light'),
				'layout_three'  =>esc_html__('Layout Three', 'construction-light'),
			)
		));

		$wp_customize->add_setting('construction_light_service_img', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw'		//done
		));
	
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'construction_light_service_img', array(
			'label'	   => esc_html__('Background Image','construction-light'),
			'section'  => 'construction_light_service_section',
			'type'	   => 'image',
		)));

		$wp_customize->selective_refresh->add_partial('construction_light_service_settings', array(
			'settings' => array(
				'construction_light_service_service_section',
				'construction_light_service_type',
				'construction_light_service',
				'construction_light_service_advance',
				'construction_light_service_button',
				'construction_light_service_layout',
				'construction_light_service_img'
			),
			'selector' => '#cl-service-section',
			'container_inclusive' => true,
			'render_callback' => function () {
				return get_template_part('section/section', 'service');
			}
		));

		$wp_customize->add_setting('construction_light_service_section_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_service_section_upgrade_text', array(
	        'section' => 'construction_light_service_section',
	        'label' => esc_html__('For more settings,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Contains Description Field', 'construction-light'),
	            esc_html__('Five Differrent Title Styles', 'construction-light'),
	            esc_html__('Default and Advanced Service Blocks', 'construction-light'),
	            esc_html__("Select Service Image and configure it's position", 'construction-light'),
	            esc_html__('Six Different Service Layouts', 'construction-light'),
	            esc_html__('Change Section Main Title, Title and Text Color', 'construction-light'),
	            esc_html__('Change Icon Color and Icon Background Color', 'construction-light'),
	            esc_html__('Change Excerpt Color', 'construction-light'),
	            esc_html__('Change Read More Link Color', 'construction-light'),
	            esc_html__('Customize Padding for Services Section', 'construction-light'),
	        ),
	        'priority' => 100
	    )));


	/**
	 * Call To Action Section
	*/
	$wp_customize->add_section('construction_light_calltoaction_section', array(
		'title'		=> 	esc_html__('Call To Action Section','construction-light'),
		'panel'		=> 'construction_light_frontpage_settings',
		'priority'  => construction_light_get_section_position('construction_light_calltoaction_section')
	));

		/**
         * Enable/Disable Option
         *
         * @since 1.0.0
        */
        $wp_customize->add_setting('construction_light_cta_service_section', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_cta_service_section', array(
		    'label' => esc_html__('Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_calltoaction_section',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		$wp_customize->selective_refresh->add_partial('construction_light_cta_settings', array(
			'settings' => array('construction_light_cta_service_section'),
			'selector' => '#cl_cta',
			'container_inclusive' => true,
			'render_callback' => function () {
				if(get_theme_mod('construction_light_cta_service_section','enable') === 'enable') {
					return get_template_part('section/section', 'calltoaction'); 
				} 
			}
		));

		// Call To Action Image.
		$wp_customize->add_setting('construction_light_calltoaction_image', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw'		//done
		));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'construction_light_calltoaction_image', array(
			'label'	   => esc_html__('Upload Background Image','construction-light'),
			'section'  => 'construction_light_calltoaction_section',
			'type'	   => 'image',
		)));


		// Call To Action Title.
		$wp_customize->add_setting('construction_light_calltoaction_title', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field'		//done
		));

		$wp_customize->add_control( 'construction_light_calltoaction_title', array(
			'label'	   => esc_html__('Enter Section Title','construction-light'),
			'section'  => 'construction_light_calltoaction_section',
			'type'	   => 'text',
		));

		// Call To Action Subtitle.
		$wp_customize->add_setting('construction_light_calltoaction_subtitle', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field'		//done
		));

		$wp_customize->add_control('construction_light_calltoaction_subtitle', array(
			'label'	   => esc_html__('Enter Section Subtitle','construction-light'),
			'section'  => 'construction_light_calltoaction_section',
			'type'	   => 'text'
		));

		// Call To Action Button.
		$wp_customize->add_setting('construction_light_calltoaction_button', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field'		//done
		));

		$wp_customize->add_control('construction_light_calltoaction_button', array(
			'label'	   => esc_html__('Enter Button One Text','construction-light'),
			'section'  => 'construction_light_calltoaction_section',
			'type'	   => 'text',
		));
		
		// Call To Action Button Link.
		$wp_customize->add_setting('construction_light_calltoaction_link', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw'		//done
		));

		$wp_customize->add_control('construction_light_calltoaction_link', array(
			'label'	   => esc_html__('Enter Button One Link','construction-light'),
			'section'  => 'construction_light_calltoaction_section',
			'type'	   => 'url',
		));


		// Call To Action Button.
		$wp_customize->add_setting('construction_light_calltoaction_button_one', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field'		//done
		));

		$wp_customize->add_control('construction_light_calltoaction_button_one', array(
			'label'	   => esc_html__('Enter Button Two Text','construction-light'),
			'section'  => 'construction_light_calltoaction_section',
			'type'	   => 'text',
		));
		
		// Call To Action Button Link.
		$wp_customize->add_setting('construction_light_calltoaction_link_one', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw'		//done
		));

		$wp_customize->add_control('construction_light_calltoaction_link_one', array(
			'label'	   => esc_html__('Enter Button Two Link','construction-light'),
			'section'  => 'construction_light_calltoaction_section',
			'type'	   => 'url',
		));

		$wp_customize->add_setting('construction_light_calltoaction_section_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_calltoaction_section_upgrade_text', array(
	        'section' => 'construction_light_calltoaction_section',
	        'label' => esc_html__('For more settings,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Customize Section Title, Sub-Title and Text Color', 'construction-light'),
	            esc_html__('Four Different Background Types', 'construction-light'),
	            esc_html__('Change Background Color', 'construction-light'),
	            esc_html__('Customize Call To Action Padding', 'construction-light'),
	        ),
	        'priority' => 100
	    )));


	/**
	 * Video Call To Action Section
	*/
	$wp_customize->add_section('construction_light_video_calltoaction_section', array(
		'title'		=> 	esc_html__('Video Call To Action Section','construction-light'),
		'panel'		=> 'construction_light_frontpage_settings',
		'priority'  => construction_light_get_section_position('construction_light_video_calltoaction_section')
	));

		/**
         * Enable/Disable Option
         *
         * @since 1.0.0
        */
        $wp_customize->add_setting('construction_light_video_cta_service_section', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_video_cta_service_section', array(
		    'label' => esc_html__('Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_video_calltoaction_section',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		$wp_customize->selective_refresh->add_partial('construction_light_video_cta_service_section', array(
			'selector' => '#cl_ctavideo',
			'container_inclusive' => true,
			'render_callback' => function () {
				if(get_theme_mod('construction_light_video_cta_service_section', 'enable') === 'enable') {
					return get_template_part('section/section', ' video_calltoaction');
				}
			}
		));

		// Call To Action Video Button URL.
		$wp_customize->add_setting('construction_light_video_button_url', array(
			'sanitize_callback'	=> 'esc_url_raw',		//done
			'transport' => 'postMessage'
		));

		$wp_customize->add_control('construction_light_video_button_url', array(
			'label'	   => esc_html__('Enter Youtube Video URL','construction-light'),
			'section'  => 'construction_light_video_calltoaction_section',
			'type'	   => 'url'
		));

		// Video Call To Action Title.
		$wp_customize->add_setting('construction_light_video_calltoaction_title', array(
			'sanitize_callback'	=> 'sanitize_text_field',		//done
			'transport' => 'postMessage'
		));

		$wp_customize->add_control( 'construction_light_video_calltoaction_title', array(
			'label'	   => esc_html__('Enter Section Title','construction-light'),
			'section'  => 'construction_light_video_calltoaction_section',
			'type'	   => 'text',
		));

		$wp_customize->selective_refresh->add_partial('construction_light_video_calltoaction_title', array(
			'settings' => 'construction_light_video_calltoaction_title',
			'selector' => '#cl_ctavideo h2',
		));

		// Video Call To Action Subtitle.
		$wp_customize->add_setting('construction_light_video_calltoaction_subtitle', array(
			'sanitize_callback'	=> 'sanitize_text_field',		//done
			'transport' => 'postMessage'
		));

		$wp_customize->add_control('construction_light_video_calltoaction_subtitle', array(
			'label'	   => esc_html__('Enter Section Subtitle','construction-light'),
			'section'  => 'construction_light_video_calltoaction_section',
			'type'	   => 'text',
		));

		// Video Call To Action Background Image.
		$wp_customize->add_setting('construction_light_video_calltoaction_image', array(
			'sanitize_callback'	=> 'esc_url_raw',		//done
			'transport' => 'postMessage'
		));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'construction_light_video_calltoaction_image', array(
			'label'	   => esc_html__('Upload Video Background Image','construction-light'),
			'section'  => 'construction_light_video_calltoaction_section',
			'type'	   => 'image',
		)));

		$wp_customize->add_setting('construction_light_video_calltoaction_section_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_video_calltoaction_section_upgrade_text', array(
	        'section' => 'construction_light_video_calltoaction_section',
	        'label' => esc_html__('For more styling and controls,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Change Section Title and Text Color', 'construction-light'),
	            esc_html__('Change Background Type', 'construction-light'),
	            esc_html__('Change Background Color', 'construction-light'),
	            esc_html__('Customize Section Padding', 'construction-light'),
	        ),
	        'priority' => 100
	    )));

	/**
	 * Portfolio Work Section. 
	*/
	$wp_customize->add_section('construction_light_recentwork_section', array(
		'title'		=> 	esc_html__('Portfolio Section','construction-light'),
		'panel'		=> 'construction_light_frontpage_settings',
		'priority'  => construction_light_get_section_position('construction_light_recentwork_section')
	));

		/**
         * Enable/Disable Option
         *
         * @since 1.0.0
        */
        $wp_customize->add_setting('construction_light_portfolio_section', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_portfolio_section', array(
		    'label' => esc_html__('Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_recentwork_section',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		// Portfolio Work Section Title.
		$wp_customize->add_setting( 'construction_light_recentwork_title', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field', 	 //done	
		));

		$wp_customize->add_control('construction_light_recentwork_title', array(
			'label'		=> esc_html__( 'Enter Section Title', 'construction-light' ),
			'section'	=> 'construction_light_recentwork_section',
			'type'      => 'text'
		));

		$wp_customize->selective_refresh->add_partial('construction_light_recentwork_title', array(
			'settings' => array('construction_light_recentwork_title'),
			'selector' => '#cl_portfolio h2',
		));
		
		// Our Service Section Sub Title.
		$wp_customize->add_setting( 'construction_light_recentwork_sub_title', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		) );

		$wp_customize->add_control( 'construction_light_recentwork_sub_title', array(
			'label'    => esc_html__( 'Enter Section Sub Title', 'construction-light' ),
			'section'  => 'construction_light_recentwork_section',
			'type'     => 'text',
		));

		$wp_customize->add_setting( 'construction_light_recentwork_type', array(
			'transport' => 'postMessage',
			'default' => 'default',
			'sanitize_callback' => 'sanitize_text_field'			//done
		));

		$wp_customize->add_control( 'construction_light_recentwork_type', array(
			'label'    => esc_html__( 'Type', 'construction-light' ),
			'section'  => 'construction_light_recentwork_section',
			'type'     => 'radio',
			'choices' => array(
				'default' => __('Default', 'construction-light'),
				'advance' => __('Advance', 'construction-light'),
			)
		));

		// Portfolio Work Images.
		$wp_customize->add_setting( 'construction_light_recent_work', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field', 	 //done	
		));

		$wp_customize->add_control( new Construction_Light_Multiple_Check_Control($wp_customize, 
			'construction_light_recent_work', 
			array(
				'label'		=> esc_html__( 'Select Category', 'construction-light' ),
				'settings'	=> 'construction_light_recent_work',
				'section'	=> 'construction_light_recentwork_section',
				'choices'	=> $blog_cat,
			)
		));

		/** repeator field for advance options */
		$wp_customize->add_setting('construction_light_advance_portfolio', array(
			'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
			'transport' => 'postMessage',
			'default' => json_encode(array(
				array(
					'title'   => '',
					'gallery' =>''
				)
			))
		));
		
		$wp_customize->add_control(new Construction_Light_Repeater_Control( $wp_customize, 
			'construction_light_advance_portfolio', 
			array(
				'label' 	   => esc_html__('Portfolio Images', 'construction-light'),
				'section' 	   => 'construction_light_recentwork_section',
				'settings' 	   => 'construction_light_advance_portfolio',
				'cl_box_label' => esc_html__('Item #', 'construction-light'),
				'cl_box_add_control' => esc_html__('Add New', 'construction-light'),
			),
			array(
				'title' => array(
					'type'    => 'text',
					'label'   => esc_html__('Title', 'construction-light')
				),
				'gallery' => array(
					'type'    => 'gallery',
					'label'   => esc_html__('Gallery', 'construction-light'),
					'default' => ''
				)
			)
		));

		$wp_customize->selective_refresh->add_partial('construction_light_portfolio_settings', array(
			'settings' => array(
				'construction_light_portfolio_section', 
				'construction_light_recent_work', 
				'construction_light_advance_portfolio',
				'construction_light_recentwork_type'
			),
			'selector' => '#cl_portfolio',
			'container_inclusive' => true,
			'render_callback' => function () {
				if(get_theme_mod('construction_light_portfolio_section','enable') === 'enable') {
					return get_template_part('section/section','recentwork');
				}
			}
		));

		$wp_customize->add_setting('construction_light_recentwork_section_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_recentwork_section_upgrade_text', array(
	        'section' => 'construction_light_recentwork_section',
	        'label' => esc_html__('For more styling and controls,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Field for Portfolio Description', 'construction-light'),
	            esc_html__('Five Different Title Styles', 'construction-light'),
	        ),
	        'priority' => 100
	    )));


	/**
	 * Counter Section. 
	*/
	$wp_customize->add_section('construction_light_counter_section', array(
		'title'		=> 	esc_html__('Counter Section','construction-light'),
		'panel'		=> 'construction_light_frontpage_settings',
		'priority'  => construction_light_get_section_position('construction_light_counter_section')
	));

		/**
         * Enable/Disable Option
         *
         * @since 1.0.0
        */
        $wp_customize->add_setting('construction_light_counter_section', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_counter_section', array(
		    'label' => esc_html__('Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_counter_section',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		// Counter Section Title.
		$wp_customize->add_setting('construction_light_counter_title', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field'		//done
		));

		$wp_customize->add_control('construction_light_counter_title', array(
			'label'	   => esc_html__('Enter Section Title','construction-light'),
			'section'  => 'construction_light_counter_section',
			'type'	   => 'text',
		));

		$wp_customize->selective_refresh->add_partial('construction_light_counter_title', array(
			'settings' => array('construction_light_counter_title'),
			'selector' => '#cl_counter .section-title',
		));

		// Our Service Section Sub Title.
		$wp_customize->add_setting( 'construction_light_counter_sub_title', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		) );

		$wp_customize->add_control( 'construction_light_counter_sub_title', array(
			'label'    => esc_html__( 'Enter Section Sub Title', 'construction-light' ),
			'section'  => 'construction_light_counter_section',
			'type'     => 'text',
		));

		// Counter Background Image.
		$wp_customize->add_setting('construction_light_counter_image', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw'		//done
		));

		$wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'construction_light_counter_image', array(
			'label'	   => esc_html__('Upload Counter Background Image','construction-light'),
			'section'  => 'construction_light_counter_section',
			'type'	   => 'image',
		)));

		// Counter Section.
		$wp_customize->add_setting('construction_light_counter', array(
		    'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
			'transport' => 'postMessage',
		    'default' => json_encode(array(
				array(
		            'counter_icon'  =>'',
		            'counter_title'  =>'',
					'counter_number'  =>'',	            
					'counter_prefix' => '',
					'counter_suffix' => ''
		        )
		    ))
		));

		$wp_customize->add_control(new Construction_Light_Repeater_Control( $wp_customize, 
			'construction_light_counter', 

			array(
			    'label' 	   => esc_html__('Counter Settings', 'construction-light'),
			    'section' 	   => 'construction_light_counter_section',
			    'settings' 	   => 'construction_light_counter',
			    'cl_box_label' => esc_html__('Counter Settings Options', 'construction-light'),
			    'cl_box_add_control' => esc_html__('Add New', 'construction-light'),
			),

		    array(

		    	'counter_icon' => array(
		            'type' => 'icons',
		            'label' => esc_html__('Choose Counter Icon', 'construction-light'),
		            'default' => 'fa fa-cogs'
		        ),

		        'counter_title' => array(
		            'type' => 'text',
		            'label' => esc_html__('Enter Title', 'construction-light'),
		            'default' => ''
		        ),

		        'counter_number' => array(
		            'type' => 'text',
		            'label' => esc_html__('Enter Number', 'construction-light'),
		            'default' => ''
				),
				'counter_prefix' => array(
		            'type' => 'text',
		            'label' => esc_html__('Prefix', 'construction-light'),
		            'default' => ''
				),
				'counter_suffix' => array(
		            'type' => 'text',
		            'label' => esc_html__('Suffix', 'construction-light'),
		            'default' => ''
		        ),
		        
			)
		));

		$wp_customize->selective_refresh->add_partial('construction_light_counter_settings', array(
			'settings' => array('construction_light_counter_section','construction_light_counter'),
			'selector' => '#cl_counter',
			'container_inclusive' => true,
			'render_callback' => function () {
				if(get_theme_mod('construction_light_counter_section','enable') === 'enable' ) {
					return get_template_part('section/section', 'counter');
				}
			}
		));

		$wp_customize->add_setting('construction_light_counter_section_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_counter_section_upgrade_text', array(
	        'section' => 'construction_light_counter_section',
	        'label' => esc_html__('For more settings,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Five different title styles', 'construction-light'),
	            esc_html__('Includes field for description', 'construction-light'),
	            esc_html__('Change icon and border color', 'construction-light'),
	            esc_html__('Change counter color', 'construction-light'),
	            esc_html__('Change section title and subtitle color', 'construction-light'),
	            esc_html__('Change section text color', 'construction-light'),
	            esc_html__('Four different types of Background', 'construction-light'),
	            esc_html__('Adjust Background Color', 'construction-light'),
	            esc_html__('Input Custom Padding', 'construction-light'),
	        ),
	        'priority' => 100
	    )));

	/* Blog Section. */
	$wp_customize->add_section('construction_light_blog_section', array(
		'title'		=> 	esc_html__('Blog Section','construction-light'),
		'panel'		=> 'construction_light_frontpage_settings',
		'priority'  => construction_light_get_section_position('construction_light_blog_section')
	));

		/**
         * Enable/Disable Option
         *
         * @since 1.0.0
        */
        $wp_customize->add_setting('construction_light_home_blog_section', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_home_blog_section', array(
		    'label' => esc_html__('Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_blog_section',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		// Blog Title.
		$wp_customize->add_setting('construction_light_blog_title', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field'		//done
		));

		$wp_customize->add_control('construction_light_blog_title', array(
			'label'	   => esc_html__('Enter Section Title','construction-light'),
			'section'  => 'construction_light_blog_section',
			'type'	   => 'text',
		));

		$wp_customize->selective_refresh->add_partial('construction_light_blog_title', array(
			'settings' => array('construction_light_blog_title'),
			'selector' => '#cl_blog .section-title',
		));
		
		// Our Service Section Sub Title.
		$wp_customize->add_setting( 'construction_light_blog_sub_title', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		) );

		$wp_customize->add_control( 'construction_light_blog_sub_title', array(
			'label'    => esc_html__( 'Enter Section Sub Title', 'construction-light' ),
			'section'  => 'construction_light_blog_section',
			'type'     => 'text',
		));

		// Blog Posts.
		$wp_customize->add_setting('construction_light_blog', array(
			'transport' => 'postMessage',
		    'sanitize_callback' => 'sanitize_text_field',     //done
		));

		$wp_customize->add_control(new Construction_Light_Multiple_Check_Control($wp_customize, 'construction_light_blog', array(
		    'label'    => esc_html__('Select Category To Show Posts', 'construction-light'),
		    'settings' => 'construction_light_blog',
		    'section'  => 'construction_light_blog_section',
		    'choices'  => $blog_cat,
		)));

		// Select Blog Post Layout.
		$wp_customize->add_setting('construction_light_posts_num',array(
			'default'			 =>	'three',
			'transport'          => 'postMessage',
			'sanitize_callback'	 =>	'construction_light_sanitize_select'		//done	
		));

		$wp_customize->add_control( 'construction_light_posts_num', array(
			'label'	  =>	esc_html__('Number of Posts to display','construction-light'),
			'section' =>	'construction_light_blog_section',
			'type'	  =>	'select',
			'choices' => array(
				'three' => esc_html__( '3 Posts','construction-light'),
				'six'   => esc_html__( '6 Posts','construction-light' ),
			)
		));

		$wp_customize->selective_refresh->add_partial('construction_light_home_blog_settings', array(
			'settings' => array('construction_light_home_blog_section','construction_light_blog','construction_light_posts_num'),
			'selector' => '#cl_blog',
			'container_inclusive' => true,
			'render_callback' => function () {
				if(get_theme_mod('construction_light_home_blog_section','enable') === 'enable') {
					return get_template_part('section/section','blog');
				}
			}
		));

		// Select Blog Post Layout.
		$wp_customize->add_setting('construction_light_posts_alignment',array(
			'default'			 =>	'center',
			'transport'          => 'postMessage',
			'sanitize_callback'	 =>	'construction_light_sanitize_select'		//done	
		));

		$wp_customize->add_control( 'construction_light_posts_alignment', array(
			'label'	  =>	esc_html__('Alignment','construction-light'),
			'section' =>	'construction_light_blog_section',
			'type'	  =>	'select',
			'choices' => array(
				'left' => esc_html__('Left','construction-light'),
				'center' => esc_html__('Center','construction-light'),
				'right' => esc_html__('Right','construction-light')
			)
		));

		$wp_customize->add_setting('construction_light_blog_section_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_blog_section_upgrade_text', array(
	        'section' => 'construction_light_blog_section',
	        'label' => esc_html__('For more settings and controls,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Customize title styles', 'construction-light'),
	            esc_html__('Description field for section', 'construction-light'),
	            esc_html__('Customize Section Title and Sub-Title Color', 'construction-light'),
	            esc_html__('Customize Section Text Color', 'construction-light'),
	            esc_html__('Four Different Background Types', 'construction-light'),
	            esc_html__('Change Background Color', 'construction-light'),
	            esc_html__('Input Custom Padding', 'construction-light'),
	        ),
	        'priority' => 100
	    )));


	/* Testimonial Section. */
	$wp_customize->add_section('construction_light_testimonial_section', array(
		'title'		=> 	esc_html__('Testimonial Section','construction-light'),
		'panel'		=> 'construction_light_frontpage_settings',
		'priority'  => construction_light_get_section_position('construction_light_testimonial_section')
	));

		/**
         * Enable/Disable Option
         *
         * @since 1.0.0
        */
        $wp_customize->add_setting('construction_light_testimonial_options', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_testimonial_options', array(
		    'label' => esc_html__('Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_testimonial_section',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		// Blog Title.
		$wp_customize->add_setting('construction_light_testimonial_title', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'sanitize_text_field'		//done
		));

		$wp_customize->add_control('construction_light_testimonial_title', array(
			'label'	   => esc_html__('Enter Section Title','construction-light'),
			'section'  => 'construction_light_testimonial_section',
			'type'	   => 'text',
		));

		// Our Service Section Sub Title.
		$wp_customize->add_setting('construction_light_testimonial_sub_title', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		) );

		$wp_customize->add_control('construction_light_testimonial_sub_title', array(
			'label'    => esc_html__( 'Enter Section Sub Title', 'construction-light' ),
			'section'  => 'construction_light_testimonial_section',
			'type'     => 'text',
		));

		// Testimonial Image.
		$wp_customize->add_setting('construction_light_testimonials_image', array(
			'transport' => 'postMessage',
			'sanitize_callback'	=> 'esc_url_raw'		//done
		));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'construction_light_testimonials_image', array(
			'label'	   => esc_html__('Upload Testimonials Background Image','construction-light'),
			'section'  => 'construction_light_testimonial_section',
			'type'	   => 'image',
		)));

		//  Testimonial Page.
		$wp_customize->add_setting('construction_light_testimonials', array(
		    'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
			'transport' => 'postMessage',
		    'default' => json_encode(array(
		        array(
		            'testimonial_page' => '',
		            'designation'=>'',
		        )
		    ))
		));

		$wp_customize->add_control(new Construction_Light_Repeater_Control( $wp_customize, 
			'construction_light_testimonials', 

			array(
			    'label' 	   => esc_html__('Testimonials Settings', 'construction-light'),
			    'section' 	   => 'construction_light_testimonial_section',
			    'settings' 	   => 'construction_light_testimonials',
			    'cl_box_label' => esc_html__('Testimonial Settings Options', 'construction-light'),
			    'cl_box_add_control' => esc_html__('Add New Page', 'construction-light'),
			),
		    array(
		        'testimonial_page' => array(
		            'type' => 'select',
		            'label' => esc_html__('Select Testimonial Page', 'construction-light'),
		            'options' => $pages
		        ),

		        'designation' => array(
		            'type' => 'text',
		            'label' => esc_html__('Enter Designation', 'construction-light'),
		            'default' => ''
		        ),
			)
		));

		$wp_customize->selective_refresh->add_partial('construction_light_testimonial_settings', array(
			'settings' => array('construction_light_testimonial_options','construction_light_testimonials'),
			'selector' => '#cl_testimonial',
			'container_inclusive' => true,
			'render_callback' => function () {
				if(get_theme_mod('construction_light_testimonial_options','enable') === 'enable') {
					return get_template_part('section/section','testimonial');
				}
			}
		));

		$wp_customize->add_setting('construction_light_testimonial_section_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_testimonial_section_upgrade_text', array(
	        'section' => 'construction_light_testimonial_section',
	        'label' => esc_html__('For more settings,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Five different title styles', 'construction-light'),
	            esc_html__('Includes description field', 'construction-light'),
	            esc_html__('Various Testimonial Block Styles', 'construction-light'),
	            esc_html__('Adjust number of columns to display', 'construction-light'),
	            esc_html__('Change Section Title and Sub-Title Color', 'construction-light'),
	            esc_html__('Change Section Text Color', 'construction-light'),
	            esc_html__('Four Different Background Types', 'construction-light'),
	            esc_html__('Change Background Color', 'construction-light'),
	            esc_html__('Input Custom Padding', 'construction-light'),
	        ),
	        'priority' => 100
	    )));

	/* Team Section. */
	$wp_customize->add_section('construction_light_team_section', array(
		'title'		=> 	esc_html__('Our Team Section','construction-light'),
		'panel'		=> 'construction_light_frontpage_settings',
		'priority'  => construction_light_get_section_position('construction_light_team_section')
	));

		/**
         * Enable/Disable Option
         *
         * @since 1.0.0
        */
        $wp_customize->add_setting('construction_light_team_options', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_team_options', array(
		    'label' => esc_html__('Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_team_section',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		// Team Section Title.
		$wp_customize->add_setting( 'construction_light_team_title', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		) );

		$wp_customize->add_control( 'construction_light_team_title', array(
			'label'    => esc_html__( 'Enter Section Title', 'construction-light' ),
			'section'  => 'construction_light_team_section',
			'type'     => 'text',
		));

		$wp_customize->selective_refresh->add_partial('construction_light_team_title', array(
			'settings' => array('construction_light_team_title'),
			'selector' => '#cl_team .section-title',
		));
		
		// Our Service Section Sub Title.
		$wp_customize->add_setting( 'construction_light_team_sub_title', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		) );

		$wp_customize->add_control( 'construction_light_team_sub_title', array(
			'label'    => esc_html__( 'Enter Section Sub Title', 'construction-light' ),
			'section'  => 'construction_light_team_section',
			'type'     => 'text',
		));

		// Our Team Page.
		$wp_customize->add_setting('construction_light_team', array(
		    'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
			'transport' => 'postMessage',
		    'default' => json_encode(array(
		        array(
		            'team_page'   => '',
		            'designation' =>'',
		            'facebook'    =>'',
		            'twitter'     =>'',
		            'linkedin'      =>'',
		            'instagram'   => '',
		        )
		    ))
		));

		$wp_customize->add_control(new Construction_Light_Repeater_Control( $wp_customize, 
			'construction_light_team', 
			array(
			    'label' 	   => esc_html__('Team Settings', 'construction-light'),
			    'section' 	   => 'construction_light_team_section',
			    'settings' 	   => 'construction_light_team',
			    'cl_box_label' => esc_html__('Team Settings Options', 'construction-light'),
			    'cl_box_add_control' => esc_html__('Add New Page', 'construction-light'),
			),
		    array(

		        'team_page' => array(
		            'type'    => 'select',
		            'label'   => esc_html__('Select Team Page', 'construction-light'),
		            'options' => $pages
		        ),

		        'designation' => array(
		            'type'    => 'text',
		            'label'   => esc_html__('Enter Designation', 'construction-light'),
		            'default' => ''
		        ),

		        'facebook'  => array(
		            'type'   => 'url',
		            'label'  => esc_html__('Enter Facebook Link', 'construction-light'),
		            'default' => ''
		        ),

		        'twitter' 	=> array(
		            'type'    => 'url',
		            'label'   => esc_html__('Enter Twitter Link', 'construction-light'),
		            'default' => ''
		        ),

		        'linkedin'   => array(
		            'type'    => 'url',
		            'label'   => esc_html__('Enter Linkedin Link', 'construction-light'),
		            'default' => ''
		        ),
		        
		        'instagram' => array(
		            'type'    => 'url',
		            'label'   => esc_html__('Enter Instagram Link', 'construction-light'),
		            'default' => ''
		        )
			)
		));

		// Team Section Layout.
		$wp_customize->add_setting( 'construction_light_team_layout', array(
			'default'  => 'layout_one',
			'transport' => 'postMessage',
			'sanitize_callback' => 'construction_light_sanitize_select'			//done
		) );

		$wp_customize->add_control( 'construction_light_team_layout', array(
			'label'    => esc_html__( 'Team Section Layout', 'construction-light' ),
			'section'  => 'construction_light_team_section',
			'type' => 'select',
		    'choices' => array(
		        'layout_one' => esc_html__('Layout One', 'construction-light'),
		        'layout_two' => esc_html__('Layout Two', 'construction-light'),
		    )
		));

		$wp_customize->selective_refresh->add_partial('construction_light_team_settings', array(
			'settings' => array('construction_light_team_options','construction_light_team','construction_light_team_layout'),
			'selector' => '#cl_team',
			'container_inclusive' => true,
			'render_callback' => function () {
				if(get_theme_mod('construction_light_team_options','enable') === 'enable') {
					return get_template_part('section/section','team');
				}
			}
		));

		$wp_customize->add_setting('construction_light_team_section_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_team_section_upgrade_text', array(
	        'section' => 'construction_light_team_section',
	        'label' => esc_html__('For more styling and controls,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Includes Five Differrent Title Styles', 'construction-light'),
	            esc_html__('Field for Description', 'construction-light'),
	            esc_html__('Switch Between Two Types of Team Blocks', 'construction-light'),
	            esc_html__('Repeater Team Block with Numerous Controls', 'construction-light'),
	            esc_html__('Four Different Team Block Styles', 'construction-light'),
	            esc_html__('Adjust number of columns to display', 'construction-light'),
	            esc_html__('Enable/Disable Carousel Slider', 'construction-light'),
	            esc_html__('Change Section Title and Sub-Title Color', 'construction-light'),
	            esc_html__('Change Section Text Color', 'construction-light'),
	            esc_html__('Select Background Type', 'construction-light'),
	            esc_html__('Select Background Color', 'construction-light'),
	            esc_html__('Input Custom Padding', 'construction-light'),
	        ),
	        'priority' => 100
	    )));


	/**
	 * Clients Section. 
	*/
	$wp_customize->add_section('construction_light_client_section', array(
		'title'		=> 	esc_html__('Clients Section','construction-light'),
		'panel'		=> 'construction_light_frontpage_settings',
		'priority'  => construction_light_get_section_position('construction_light_client_section')
	));

		/**
         * Enable/Disable Option
         *
         * @since 1.0.0
        */
        $wp_customize->add_setting('construction_light_client_logo_options', array(
		    'default' => 'enable',
			'transport' => 'postMessage',
		    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
		));

		$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_client_logo_options', array(
		    'label' => esc_html__('Enable / Disable', 'construction-light'),
		    'section' => 'construction_light_client_section',
		    'switch_label' => array(
		        'enable' => esc_html__('Enable', 'construction-light'),
		        'disable' => esc_html__('Disable', 'construction-light'),
		    ),
		)));

		// Clients Section Title.
		$wp_customize->add_setting( 'construction_light_client_title', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		) );

		$wp_customize->add_control( 'construction_light_client_title', array(
			'label'    => esc_html__( 'Enter Section Title', 'construction-light' ),
			'section'  => 'construction_light_client_section',
			'type'     => 'text',
		));

		$wp_customize->selective_refresh->add_partial('construction_light_client_title', array(
			'settings' => array('construction_light_client_title'),
			'selector' => '#cl_clients .section-title',
		));

		// Clients Sub Title.
		$wp_customize->add_setting( 'construction_light_client_sub_title', array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field'			//done
		) );

		$wp_customize->add_control( 'construction_light_client_sub_title', array(
			'label'    => esc_html__( 'Enter Section Sub Title', 'construction-light' ),
			'section'  => 'construction_light_client_section',
			'type'     => 'text',
		));

		//  Clients Page.
		$wp_customize->add_setting('construction_light_client', array(
		    'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
			'transport' => 'postMessage',
		    'default' => json_encode(array(
		        array(
		            'client_image' => '',
		            'client_link'  => '',
		        )
		    ))
		));

		$wp_customize->add_control(new Construction_Light_Repeater_Control( $wp_customize, 
			'construction_light_client',

			array(
			    'label' 	   => esc_html__('Client Logo Settings', 'construction-light'),
			    'section' 	   => 'construction_light_client_section',
			    'settings' 	   => 'construction_light_client',
			    'cl_box_label' => esc_html__('Client Logo Setting Options', 'construction-light'),
			    'cl_box_add_control' => esc_html__('Add New', 'construction-light'),
			),

		    array(

		        'client_image' => array(
		            'type' => 'upload',
		            'label' => esc_html__('Upload Clients Logo', 'construction-light'),
		        ),

		        'client_link' => array(
					'type'      => 'text',
					'label'     => esc_html__( 'Enter Client Logo Link', 'construction-light' ),
					'default'   => ''
				), 
			)
		));

		$wp_customize->selective_refresh->add_partial('construction_light_client_logo_settings', array(
			'settings' => array('construction_light_client_logo_options', 'construction_light_client'),
			'selector' => '#cl_clients',
			'container_inclusive' => true,
			'render_callback' => function () {
				if(get_theme_mod('construction_light_client_logo_options','enable') === 'enable') {
					return get_template_part('section/section', 'client');
				}
			}
		));

		$wp_customize->add_setting('construction_light_client_section_upgrade_text', array(
	        'sanitize_callback' => 'construction_light_sanitize_text'
	    ));

	    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_client_section_upgrade_text', array(
	        'section' => 'construction_light_client_section',
	        'label' => esc_html__('For more styling and controls,', 'construction-light'),
	        'choices' => array(
	            esc_html__('Five Different Title Styles', 'construction-light'),
	            esc_html__('Field for Description', 'construction-light'),
	            esc_html__('Select Logo Style', 'construction-light'),
	            esc_html__('Change Section Title and Sub-Title Color', 'construction-light'),
	            esc_html__('Change Section Text Color', 'construction-light'),
	            esc_html__('Select Background Type', 'construction-light'),
	            esc_html__('Select Background Color', 'construction-light'),
	            esc_html__('Input Custom Padding', 'construction-light'),
	        ),
	        'priority' => 100
	    )));

		$wp_customize->add_section(new Construction_Light_Upgrade_Section($wp_customize, 'construction_light_frontpage_upgrade_section', array(
	        'title' => esc_html__('More Sections on Premium', 'construction-light'),
	        'panel' => 'construction_light_frontpage_settings',
	        'priority' => 1000,
	        'options' => array(
	            esc_html__('- Contact Section', 'construction-light'),
				esc_html__('- Free hand Text (HTML)', 'construction-light'),
				esc_html__('- Service Section With Multiple Layout', 'construction-light'),
				esc_html__('- WooCommerce Section', 'construction-light'),
	            esc_html__('- Pricing Section wtih more advance features', 'construction-light'),
	            esc_html__('- Tab Section', 'construction-light'),
	            
	            esc_html__('------------------------', 'construction-light'),
	            esc_html__('- Elementor Pagebuilder Compatible. All the above sections can be created with Elementor Page Builder or Customizer whichever you like.', 'construction-light'),
	        )
	    )));


	/**
	 * Theme Option Settings.
	*/
	$wp_customize->add_panel('construction_light_theme_options', array(
		'title'		=>	esc_html__('Theme Options','construction-light'),
		'priority'	=>	55,
	));

		// Site Layout.
		$wp_customize->add_section('construction_light_site_layout_section', array(
			'title'		=>	esc_html__('Site Layout','construction-light'),
			'panel'		=> 'construction_light_theme_options',
		));

			// Site Layout Options.
			$wp_customize->add_setting('construction_light_site_layout', array(
				'default' => 'full_width',
				'sanitize_callback' => 'construction_light_sanitize_select'         //done
			));

			$wp_customize->add_control('construction_light_site_layout', array(
				'label'   => esc_html__('Site Layout','construction-light'),
				'section' => 'construction_light_site_layout_section',
				'type'    => 'select',
				'choices' => array(
					'full_width' => esc_html__('Full Width','construction-light'),
					'boxed' => esc_html__('Boxed','construction-light'),			
				)
			));

		/**
		 * Page Layout Sidebar Options
		*/
		$wp_customize->add_section('construction_light_sidebar', array(
			'title'		=>	esc_html__('Display Sidebar Settings','construction-light'),
			'panel'		=> 'construction_light_theme_options',
		));

			// Enable or Disable Sticky Sidebar.
			$wp_customize->add_setting('construction_light_sticky_sidebar', array(
			    'default' => 'disable',
			    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
			));

			$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_sticky_sidebar', array(
			    'label' => esc_html__('Enable Sticky Sidebar', 'construction-light'),
			    'settings' => 'construction_light_sticky_sidebar',
			    'section' => 'construction_light_sidebar',
			    'switch_label' => array(
			        'enable' => esc_html__('Enable', 'construction-light'),
			        'disable' => esc_html__('Disable', 'construction-light'),
			    ),
			)));

			// Blog Sidebar Options.
			$wp_customize->add_setting('construction_light_blog_sidebar', array(
			    'default' => 'right',
				// 'transport' => 'postMessage',
			    'sanitize_callback' => 'construction_light_sanitize_select',     //done
			));

			$wp_customize->add_control('construction_light_blog_sidebar', array(
			    'label'   => esc_html__('Index Blog Posts Sidebar', 'construction-light'),
			    'section' => 'construction_light_sidebar',
			    'type'    => 'select',
			    'choices' => array(
			        'right' => esc_html__('Content / Sidebar', 'construction-light'),
			        'left' => esc_html__('Sidebar / Content', 'construction-light'),
			        'no' => esc_html__('Full Width', 'construction-light'),
			    ),
			));

			// Blog Archive Sidebar Options.
			$wp_customize->add_setting('construction_light_archive_sidebar', array(
			    'default' => 'right',
			    'sanitize_callback' => 'construction_light_sanitize_select',     //done
			));

			$wp_customize->add_control('construction_light_archive_sidebar', array(
			    'label'   => esc_html__('Blog Archive Sidebar', 'construction-light'),
			    'section' => 'construction_light_sidebar',
			    'type'    => 'select',
			    'choices' => array(
			        'right' => esc_html__('Content / Sidebar', 'construction-light'),
			        'left' => esc_html__('Sidebar / Content', 'construction-light'),
			        'no' => esc_html__('Full Width', 'construction-light'),	        
			    ),
			));

			// Page Sidebar Options.
			$wp_customize->add_setting('construction_light_page_sidebar', array(
			    'default' => 'right',
			    'sanitize_callback' => 'construction_light_sanitize_select',     //done
			));

			$wp_customize->add_control('construction_light_page_sidebar', array(
			    'label'   => esc_html__('Page Sidebar', 'construction-light'),
			    'section' => 'construction_light_sidebar',
			    'type'    => 'select',
			    'choices' => array(
			        'right' => esc_html__('Content / Sidebar', 'construction-light'),
			        'left' => esc_html__('Sidebar / Content', 'construction-light'),
			        'no' => esc_html__('Full Width', 'construction-light'),	        
			    ),
			));

			// Search Page Sidebar Options.
			$wp_customize->add_setting('construction_light_search_sidebar', array(
			    'default' => 'right',
			    'sanitize_callback' => 'construction_light_sanitize_select',     //done
			));

			$wp_customize->add_control('construction_light_search_sidebar', array(
			    'label'   => esc_html__('Search Page Sidebar', 'construction-light'),
			    'section' => 'construction_light_sidebar',
			    'type'    => 'select',
			    'choices' => array(
			        'right' => esc_html__('Content / Sidebar', 'construction-light'),
			        'left' => esc_html__('Sidebar / Content', 'construction-light'),
			        'no' => esc_html__('Full Width', 'construction-light'),	        
			    ),
			));


		/**
		 * Breadcrumbs Settings. 
		*/
		$wp_customize->add_section('construction_light_breadcrumb', array(
			'title'		=>	esc_html__('Breadcrumbs','construction-light'),
			'panel'		=> 'construction_light_theme_options',
		));

		    // Enable or Disable Breadcrumb.
			$wp_customize->add_setting('construction_light_enable_breadcrumbs', array(
			    'default' => 'enable',
				'transport' => 'postMessage',
			    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
			));

			$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_enable_breadcrumbs', array(
			    'label' => esc_html__('Enable', 'construction-light'),
			    'settings' => 'construction_light_enable_breadcrumbs',
			    'section' => 'construction_light_breadcrumb',
			    'switch_label' => array(
			        'enable' => esc_html__('Yes', 'construction-light'),
			        'disable' => esc_html__('No', 'construction-light'),
			    ),
			)));

			$wp_customize->selective_refresh->add_partial('construction_light_breadcrumbs_settings', array(
				'settings' => array('construction_light_enable_breadcrumbs'),
				'selector' => '.breadcrumb',
				'container_inclusive' => true,
				'render_callback' => function () {
					if(get_theme_mod('construction_light_enable_breadcrumbs','enable') === 'enable') {
						return do_action('construction_light_breadcrumbs');
					}
				}
			));

		    // Breadcrumb Image.
			$wp_customize->add_setting('construction_light_breadcrumbs_image', array(
				'transport' => 'postMessage',
				'sanitize_callback'	=> 'esc_url_raw'		//done
			));

			$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'construction_light_breadcrumbs_image', array(
				'label'	   => esc_html__('Breadcrumbs Background Image','construction-light'),
				'section'  => 'construction_light_breadcrumb',
				'type'	   => 'image',
			)));

			$wp_customize->add_setting('construction_light_breadcrumb_upgrade_text', array(
		        'sanitize_callback' => 'construction_light_sanitize_text'
		    ));

		    $wp_customize->add_control(new Construction_Light_Upgrade_Text($wp_customize, 'construction_light_breadcrumb_upgrade_text', array(
		        'section' => 'construction_light_breadcrumb',
		        'label' => esc_html__('For more styling and controls,', 'construction-light'),
		        'choices' => array(
		            esc_html__('Customize Breadcrumbs Section Padding', 'construction-light'),
		            esc_html__('Customize Breadcrumbs Section Margin', 'construction-light'),
		            esc_html__('Select Background Type', 'construction-light'),
		            esc_html__('Select Background Color', 'construction-light'),
		        ),
		        'priority' => 100
		    )));


		/**
		 * Blog Template.
		*/
		$wp_customize->add_section('construction_light_blog_template', array(
			'title'		  => esc_html__('Blog Template Settings','construction-light'),
			'priority'	  => 65,
		));


			//  Blog Template Blog Posts by Category.
			$wp_customize->add_setting('construction_light_blogtemplate_postcat', array(
				'transport' => 'postMessage',
			    'sanitize_callback' => 'sanitize_text_field',     //done
			));

			$wp_customize->add_control(new Construction_Light_Multiple_Check_Control($wp_customize, 'construction_light_blogtemplate_postcat', array(
			    'label'    => esc_html__('Select Category To Show Posts', 'construction-light'),
			    'settings' => 'construction_light_blogtemplate_postcat',
			    'section'  => 'construction_light_blog_template',
			    'choices'  => $blog_cat,
			    'description' => esc_html__('Note: Selected Category Only Work When you can select page template (
			    	Blog Template )','construction-light'),
			)));



			// Blog Sidebar Options.
			$wp_customize->add_setting('construction_light_blog_template_sidebar', array(
			    'default' => 'right',
			    'sanitize_callback' => 'construction_light_sanitize_select',     //done
			));

			$wp_customize->add_control('construction_light_blog_template_sidebar', array(
			    'label'   => esc_html__('Blog Template Layout Settings', 'construction-light'),
			    'section' => 'construction_light_blog_template',
			    'type'    => 'select',
			    'description' => esc_html__('Note: Blog Template Layout Only Work When you can select page template ( Blog Template )','construction-light'),
			    'choices' => array(
			        'right' => esc_html__('Content / Sidebar', 'construction-light'),
			        'left' => esc_html__('Sidebar / Content', 'construction-light'),
			        'no' => esc_html__('Full Width', 'construction-light'),
			    ),
			));


		$post_layout = array(
	        'none'  => esc_html__( 'Normal Layout', 'construction-light' ),
	        'masonry2-rsidebar'  => esc_html__( 'Masonry Layout', 'construction-light' )
	    );

			// Blog Template Layout.
			$wp_customize->add_setting('construction_light_blogtemplate_layout', array(
				'default'		=>	'none',
				'sanitize_callback'	=> 'construction_light_sanitize_select',	//done
			));

			$wp_customize->add_control('construction_light_blogtemplate_layout', array(
				'label'		=>	esc_html__('Post Display Layout','construction-light'),
				'section'	=> 'construction_light_blog_template',
				'type'		=> 'select',
				'choices' 	=> $post_layout
			));


		$post_description = array(
	        'none'     => esc_html__( 'None', 'construction-light' ),
	        'excerpt'  => esc_html__( 'Post Excerpt', 'construction-light' ),
	        'content'  => esc_html__( 'Post Content', 'construction-light' )
	    );
	        
	        $wp_customize->add_setting( 
	            'construction_light_post_description_options', 

	            array(
	                'default'           => 'excerpt',
	                'sanitize_callback' => 'construction_light_sanitize_select'
	            ) 
	        );
	        
	        $wp_customize->add_control( 
	            'construction_light_post_description_options', 

	            array(
	                'type' => 'select',
	                'label' => esc_html__( 'Post Description', 'construction-light' ),
	                'section' => 'construction_light_blog_template',
	                'choices' => $post_description
	            ) 
	        );


			// Blog Template Read More Button.
			$wp_customize->add_setting( 'construction_light_blogtemplate_btn', array(
				'default'           => esc_html__( 'Continue Reading','construction-light' ),
				'sanitize_callback' => 'sanitize_text_field',		//done
			));

			$wp_customize->add_control('construction_light_blogtemplate_btn', array(
				'label'		  => esc_html__( 'Enter Blog Button Text', 'construction-light' ),
				'section'	  => 'construction_light_blog_template',
				'type' 		  => 'text',
			));


			/**
	         * Number field for Excerpt Length section
	         *
	         * @since 1.0.0
	         */
	        $wp_customize->add_setting(
	            'construction_light_post_excerpt_length',
	            array(
	                'default'    => 50,
	                'sanitize_callback' => 'absint'
	            )
	        );

	        $wp_customize->add_control(
	            'construction_light_post_excerpt_length',

	            array(
	                'type'      => 'number',
	                'label'     => esc_html__( 'Enter Posts Excerpt Length', 'construction-light' ),
	                'section'   => 'construction_light_blog_template',
	            )
	        );


	        /**
	         * Enable/Disable Option for Post Elements Date
	         *
	         * @since 1.0.0
	        */
	        $wp_customize->add_setting('construction_light_post_date_options', array(
			    'default' => 'enable',
			    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
			));

			$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_post_date_options', array(
			    'label' => esc_html__('Post Meta Date', 'construction-light'),
			    'settings' => 'construction_light_post_date_options',
			    'section' => 'construction_light_blog_template',
			    'switch_label' => array(
			        'enable' => esc_html__('Enable', 'construction-light'),
			        'disable' => esc_html__('Disable', 'construction-light'),
			    ),
			)));


	        /**
	         * Enable/Disable Option for Post Elements Comments
	         *
	         * @since 1.0.0
	         */
	        $wp_customize->add_setting('construction_light_post_comments_options', array(
			    'default' => 'enable',
			    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
			));

			$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_post_comments_options', array(
			    'label' => esc_html__('Post Meta Comments', 'construction-light'),
			    'settings' => 'construction_light_post_comments_options',
			    'section' => 'construction_light_blog_template',
			    'switch_label' => array(
			        'enable' => esc_html__('Enable', 'construction-light'),
			        'disable' => esc_html__('Disable', 'construction-light'),
			    ),
			)));


	        /**
	         * Enable/Disable Option for Post Elements Tags
	         *
	         * @since 1.0.0
	         */
	        $wp_customize->add_setting('construction_light_post_author_options', array(
			    'default' => 'enable',
			    'sanitize_callback' => 'construction_light_sanitize_switch',     //done
			));

			$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_post_author_options', array(
			    'label' => esc_html__('Post Meta Author', 'construction-light'),
			    'settings' => 'construction_light_post_author_options',
			    'section' => 'construction_light_blog_template',
			    'switch_label' => array(
			        'enable' => esc_html__('Enable', 'construction-light'),
			        'disable' => esc_html__('Disable', 'construction-light'),
			    ),
			)));

	require get_template_directory() . '/inc/customizer/pricing-settings.php';
	require get_template_directory() . '/inc/customizer/free-text.php';

}
add_action( 'customize_register', 'construction_light_customize_register' );


//SANITIZATION FUNCTIONS
function construction_light_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function construction_light_customize_partial_blogname() {

	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function construction_light_customize_partial_blogdescription() {

	bloginfo( 'description' );
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
*/
function construction_light_customize_preview_js() {

	wp_enqueue_script( 'construction-light-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'construction_light_customize_preview_js' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 *
 */
function construction_light_customize_scripts(){

   wp_enqueue_style( 'fontawesome', get_template_directory_uri(). '/assets/library/fontawesome/css/all.min.css');

    wp_enqueue_style('construction-light-customizer', get_template_directory_uri() . '/assets/css/customizer.css');

    wp_enqueue_script('construction-light-customizer', get_template_directory_uri() . '/assets/js/customizer-admin.js', array('jquery', 'customize-controls'), true);
}
add_action('customize_controls_enqueue_scripts', 'construction_light_customize_scripts');


/**
 * Section Re Order
*/
add_action('wp_ajax_construction_light_sections_reorder', 'construction_light_sections_reorder');

function construction_light_sections_reorder() {

    if (isset($_POST['sections'])) {

        set_theme_mod('construction_light_frontpage_sections', $_POST['sections']);
    }

    wp_die();
}

function construction_light_get_section_position($key) {

    $sections = construction_light_homepage_section();

    $position = array_search($key, $sections);

    $return = ( $position + 1 ) * 11;

    return $return;
}

if( !function_exists('construction_light_homepage_section') ){

	function construction_light_homepage_section(){

		$defaults = apply_filters('construction_light_homepage_sections',
			array(
				'construction_light_promoservice_section',
				'construction_light_aboutus_section',
				'construction_light_video_calltoaction_section',
				'construction_light_service_section',
				'construction_light_calltoaction_section',
				'construction_light_recentwork_section',
				'construction_light_counter_section',
				'construction_light_blog_section',
				'construction_light_testimonial_section',
				'construction_light_team_section',
				'construction_light_client_section',
				'construction_light_producttype_section',
				'construction_light_pricing',
				'construction_light_freetext'
			)
		);

		$sections = get_theme_mod('construction_light_frontpage_sections', $defaults);
		
        return $sections;
	}
}