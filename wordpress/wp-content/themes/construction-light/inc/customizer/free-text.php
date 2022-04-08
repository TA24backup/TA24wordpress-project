<?php            
/**
 * Free Text
*/
$wp_customize->add_section( 'construction_light_freetext_section', array(
    'title'           => esc_html__('Free Hand HTML', 'construction-light'),
    'priority'        => construction_light_get_section_position('construction_light_freetext_section'),
    'panel'			  => 'construction_light_frontpage_settings'
));


    $wp_customize->add_setting( 'construction_light_freetext_section', array(
        'default'   =>  'disable',
        'transport' => 'postMessage',
        'sanitize_callback'  =>  'construction_light_sanitize_switch',
    ));

    $wp_customize->add_control(new Construction_Light_Switch_Control( $wp_customize,'construction_light_freetext_section', 
        array(
            'section'       => 'construction_light_freetext_section',
            'label'         =>  esc_html__('Enable', 'construction-light'),
            'type'          =>  'switch',
            'switch_label' => array(
                'enable' => esc_html__('Enable', 'construction-light'),
                'disable' => esc_html__('Disable', 'construction-light'),
            ),
        )
    ));

    $wp_customize->add_setting('construction_light_free_text', array(
        'default'       =>      '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('construction_light_free_text', array(
        'section'    => 'construction_light_freetext_section',
        'label'      => esc_html__('Content', 'construction-light'),
        'type'       => 'textarea'  
    ));

    $wp_customize->add_setting('construction_light_pro_freetext_image', array(
        'transport' => 'postMessage',
        'sanitize_callback'	=> 'esc_url_raw'		//done
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'construction_light_pro_freetext_image', array(
        'label'	   => esc_html__('Background Image','construction-light'),
        'section'  => 'construction_light_freetext_section',
        'type'	   => 'image',
    )));
    
    
    $wp_customize->selective_refresh->add_partial('education_pro_freetext_refresh', array(
            'settings' => array(
                'construction_light_freetext_area_options',
                'construction_light_pro_freetext_image',
                'construction_light_free_text',
        ),
        'selector' => '#free-hand-text-section',
        'container_inclusive' => true,
        'render_callback' => function() {
            return get_template_part('section/section', 'freetext');
        }
    ));