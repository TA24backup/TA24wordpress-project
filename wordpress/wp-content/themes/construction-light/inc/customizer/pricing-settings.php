<?php
/**
 * Product Type Settings
*/
$wp_customize->add_section('construction_light_pricing_section', array(
    'title' => esc_html__('Pricing', 'construction-light'),
    'panel' => 'construction_light_frontpage_settings',
    'priority' => construction_light_get_section_position('construction_light_pricing_section'),
    'hiding_control' => 'construction_light_pricing_section_disable'
));

//ENABLE/DISABLE SERVICE SECTION
$wp_customize->add_setting('construction_light_pricing_section_disable', array(
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage',
    'default' => 'disable'
));

$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_pricing_section_disable', array(
    'section' => 'construction_light_pricing_section',
    'label' => esc_html__('Enable Section ', 'construction-light'),
    'switch_label' => array(
        'enable' => esc_html__('Yes', 'construction-light'),
        'disable' => esc_html__('No', 'construction-light'),
    ),
    'class' => 'switch-section',
    'priority' => -1
)));

// Pricing Section Title.
$wp_customize->add_setting( 'construction_light_pricing_title', array(
    'sanitize_callback' => 'sanitize_text_field', 	 //done	
    'transport' => 'postMessage'
));

$wp_customize->add_control('construction_light_pricing_title', array(
    'label'		=> esc_html__( 'Enter Section Title', 'construction-light' ),
    'section'	=> 'construction_light_pricing_section',
    'type'      => 'text'
));

// Our Service Section Sub Title.
$wp_customize->add_setting( 'construction_light_pricing_sub_title', array(
    'sanitize_callback' => 'sanitize_text_field',			//done
    'transport' => 'postMessage'
) );

$wp_customize->add_control( 'construction_light_pricing_sub_title', array(
    'label'    => esc_html__( 'Enter Section Sub Title', 'construction-light' ),
    'section'  => 'construction_light_pricing_section',
    'type'     => 'text',
));


$wp_customize->add_setting('construction_light_pricing', array(
    'sanitize_callback' => 'construction_light_sanitize_repeater',		//done
    'transport' => 'postMessage',
    'default' => json_encode(array(
        array(
            'page'   => '',
            'price' =>'',
            'popular' =>'',
            'icon' => '',
            'type' => ''
            
        )
    ))
));

$wp_customize->add_control(new Construction_Light_Repeater_Control( $wp_customize, 
    'construction_light_pricing', 
    array(
        'label' 	   => esc_html__('Pricing Setting', 'construction-light'),
        'section' 	   => 'construction_light_pricing_section',
        'settings' 	   => 'construction_light_pricing',
        'cl_box_label' => esc_html__('Item #', 'construction-light'),
        'cl_box_add_control' => esc_html__('Add New', 'construction-light'),
    ),
    array(

        'page' => array(
            'type'    => 'select',
            'label'   => esc_html__('Page', 'construction-light'),
            'options' => $pages
        ),

        'price' => array(
            'type'    => 'text',
            'label'   => esc_html__('Price', 'construction-light'),
            'default' => ''
        ),

        'popular'  => array(
            'type'   => 'select',
            'label'  => esc_html__('Is Popular?', 'construction-light'),
            'default' => '0',
            'options' => array(
                '0' => esc_html__( 'No', 'construction-light' ),
                '1' => esc_html__( 'Yes', 'construction-light' ),
            )
        ),

        'icon' 	=> array(
            'type'    => 'icons',
            'label'   => esc_html__('Icon', 'construction-light'),
            'default' => ''
        ),

        'type'   => array(
            'type'    => 'text',
            'label'   => esc_html__('Type', 'construction-light'),
            'default' => 'monthly',
            'description' => esc_html__('Monthly/Yearly', 'construction-light'),
        ),
    )
));

$wp_customize->selective_refresh->add_partial('construction_light_pricing_title', array(
    'settings' => array('construction_light_pricing_title'),
    'selector' => '#price-section h2',
));

$wp_customize->selective_refresh->add_partial('construction_light_pricing_section_settings', array(
    'settings' => array('construction_light_pricing_section_disable', 'construction_light_pricing'),
    'selector' => '#price-section',
    'container_inclusive' => true,
    'render_callback' => function () {
        if(get_theme_mod('construction_light_pricing_section_disable', 'disable') === 'enable') {
            return get_template_part('section/section', 'pricing');
        }
    }
));