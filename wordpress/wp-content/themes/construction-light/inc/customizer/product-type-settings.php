<?php
/**
 * Product Type Settings
*/
$wp_customize->add_section('construction_light_producttype_section', array(
    'title' => esc_html__('Product Type (Tab)', 'construction-light'),
    'panel' => 'construction_light_frontpage_settings',
    'priority' => construction_light_get_section_position('construction_light_producttype_section'),
    'hiding_control' => 'construction_light_producttype_section_disable'
));

//ENABLE/DISABLE SERVICE SECTION
$wp_customize->add_setting('construction_light_producttype_section_disable', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'disable'
));

$wp_customize->add_control(new Construction_Light_Switch_Control($wp_customize, 'construction_light_producttype_section_disable', array(
    'section' => 'construction_light_producttype_section',
    'label' => esc_html__('Enable Section ', 'construction-light'),
    'switch_label' => array(
        'enable' => esc_html__('Yes', 'construction-light'),
        'disable' => esc_html__('No', 'construction-light'),
    ),
    'class' => 'switch-section',
    'priority' => -1
)));


$wp_customize->add_setting('construction_light_producttype_title', array(
    'sanitize_callback' => 'sanitize_text_field',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('construction_light_producttype_title', array(
    'section' => 'construction_light_producttype_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'construction-light')
));

$wp_customize->add_setting('construction_light_producttype_sub_title', array(
    'sanitize_callback' => 'sanitize_text_field',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('construction_light_producttype_sub_title', array(
    'section' => 'construction_light_producttype_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'construction-light')
));



$wp_customize->add_setting('construction_light_producttype_category', array(
    'sanitize_callback' => 'sanitize_text_field',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control( new Construction_Light_Multiple_Check_Control($wp_customize, 
    'construction_light_producttype_category', 

    array(
        'label'		=> esc_html__( 'Select Category', 'construction-light' ),
        'settings'	=> 'construction_light_producttype_category',
        'section'	=> 'construction_light_producttype_section',
        'choices'	=> array(
            'latest_product'  => esc_html__('Latest Product', 'construction-light'),
            'upsell_product'  => esc_html__('UpSell Product', 'construction-light'),
            'feature_product' => esc_html__('Feature Product', 'construction-light'),
            'on_sale'         => esc_html__('On Sale Product', 'construction-light'),
        )
    )
));

$wp_customize->add_setting('construction_light_producttype_layout', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'tab_styleone',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('construction_light_producttype_layout', array(
    'section' => 'construction_light_producttype_section',
    'type' => 'select',
    'label' => esc_html__('Layout', 'construction-light'),
    'choices' => array(
        'tab_styleone' => __('Style One', 'construction-light'),
        'tab_styletwo' => __('Style Two', 'construction-light'),
        'tab_stylethree' => __('Style Three', 'construction-light'),
    )
));


$wp_customize->add_setting('construction_light_producttype_category_view', array(
    'default' => 'grid',
    'sanitize_callback' => 'construction_light_sanitize_select',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('construction_light_producttype_category_view', array(
    'section' => 'construction_light_producttype_section',
    'type' => 'select',
    'label' => esc_html__('View', 'construction-light'),
    'choices' => array(
        'grid'  => esc_html__('Grid', 'construction-light'),
        'slider'  => esc_html__('Slider', 'construction-light')
    )
));

$wp_customize->add_setting('construction_light_producttype_col', array(
    'sanitize_callback' => 'absint',
    'default' => 3,
));

$wp_customize->add_control('construction_light_producttype_col', array(
    'section' => 'construction_light_producttype_section',
    'label' => esc_html__('No of Columns', 'construction-light'),
    'type' => 'select',
    'choices' => array(
        '2' => 2,
        '3' => 3,
        '4' => 4,
    )
));

$wp_customize->add_setting('construction_light_producttype_no_of_product', array(
    'sanitize_callback' => 'absint',
    'default' => 4,
));

$wp_customize->add_control('construction_light_producttype_no_of_product', array(
    'section' => 'construction_light_producttype_section',
    'label' => esc_html__('No of Products', 'construction-light'),
    'type' => 'select',
    'choices' => array(
        '4' => 4,
        '8' => 8,
        '12' => 12,
    )
));

$wp_customize->selective_refresh->add_partial('construction_light_producttype_title', array(
    'selector' => '.cl-producttype-section .cl-section-title',
    'render_callback' => 'construction_light_producttype_title',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('construction_light_producttype_sub_title', array(
    'selector' => '.cl-producttype-section .cl-section-tagline',
    'render_callback' => 'construction_light_producttype_title',
    'container_inclusive' => true
));