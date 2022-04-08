<?php 
add_action( 'wp_enqueue_scripts', 'quick_setuply_enqueue_styles' );
function quick_setuply_enqueue_styles() {
	wp_enqueue_style( 'quick-setuplyparent-style', get_template_directory_uri() . '/style.css' ); 
} 

include("custom_css.php");

function quick_setuply_load_google_fonts() {
	wp_enqueue_style( 'quick-setuply-google-fonts', '//fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;1,500&display=swap' ); 
}
add_action( 'wp_enqueue_scripts', 'quick_setuply_load_google_fonts' ); 



require_once( get_stylesheet_directory() . '/inc/custom-header.php' );



function quick_setuply_customize_register( $wp_customize ) {

	// General options
	$wp_customize->add_section( 'design', array(
		'title' => __( 'General Design', 'creativeily' ),
		'description' => __( 'Design options', 'creativeily' ),
		'priority' => 2,
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_setting( 'body_bg_color', array(
		'default' => '#f3f3f3',
		'type' => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_bg_color', array(
		'label' => __( 'General Background Color', 'creativeily' ),
		'section' => 'design',
		'mime_type' => 'color',
	) ) );
// Sidebar
	$wp_customize->add_section( 'sidebar', array(
		'title' => __( 'Sidebar Options', 'creativeily' ),
		'priority' => 2,
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'sidebar_background_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_background_color', array(
		'label'       => __( 'Sidebar Background Color', 'creativeily' ),
		'section'     => 'sidebar',
		'priority'   => 1,
		'settings'    => 'sidebar_background_color',
	) ) );

	$wp_customize->add_setting( 'sidebar_title_color', array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_title_color', array(
		'label'       => __( 'Title Color', 'creativeily' ),
		'section'     => 'sidebar',
		'priority'   => 1,
		'settings'    => 'sidebar_title_color',
	) ) );

	$wp_customize->add_setting( 'sidebar_text_color', array(
		'default'           => '#777',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_text_color', array(
		'label'       => __( 'Text Color', 'creativeily' ),
		'section'     => 'sidebar',
		'priority'   => 1,
		'settings'    => 'sidebar_text_color',
	) ) );
	$wp_customize->add_setting( 'sidebar_link_color', array(
		'default'           => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_link_color', array(
		'label'       => __( 'Link Color', 'creativeily' ),
		'section'     => 'sidebar',
		'priority'   => 1,
		'settings'    => 'sidebar_link_color',
	) ) );
	$wp_customize->add_setting( 'sidebar_border_color', array(
		'default'           => '#eee',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_border_color', array(
		'label'       => __( 'Border Color', 'creativeily' ),
		'section'     => 'sidebar',
		'priority'   => 1,
		'settings'    => 'sidebar_border_color',
	) ) );
	$wp_customize->add_setting( 'sidebar_button_bg_color', array(
		'default'           => '#cca152',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_button_bg_color', array(
		'label'       => __( 'Button Background Color', 'creativeily' ),
		'section'     => 'sidebar',
		'priority'   => 1,
		'settings'    => 'sidebar_button_bg_color',
	) ) );


	// Blog Feed
	$wp_customize->add_section( 'blogposts', array(
		'title' => __( 'All Blog Posts', 'creativeily' ),
		'priority' => 2,
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_setting( 'blogposts_background', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blogposts_background', array(
		'label'       => __( 'Background Color', 'creativeily' ),
		'section'     => 'blogposts',
		'priority'   => 1,
		'settings'    => 'blogposts_background',
	) ) );
	$wp_customize->add_setting( 'blogposts_headline', array(
		'default'           => '#111',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blogposts_headline', array(
		'label'       => __( 'Headline Color', 'creativeily' ),
		'section'     => 'blogposts',
		'priority'   => 1,
		'settings'    => 'blogposts_headline',
	) ) );

	$wp_customize->add_setting( 'blogposts_meta', array(
		'default'           => '#B5B8C0',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blogposts_meta', array(
		'label'       => __( 'Meta Color', 'creativeily' ),
		'section'     => 'blogposts',
		'priority'   => 1,
		'settings'    => 'blogposts_meta',
	) ) );

	$wp_customize->add_setting( 'blogposts_text', array(
		'default'           => '#989898',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blogposts_text', array(
		'label'       => __( 'Text Color', 'creativeily' ),
		'section'     => 'blogposts',
		'priority'   => 1,
		'settings'    => 'blogposts_text',
	) ) );

	$wp_customize->add_setting( 'blogposts_button_text', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blogposts_button_text', array(
		'label'       => __( 'Button Text Color', 'creativeily' ),
		'section'     => 'blogposts',
		'priority'   => 1,
		'settings'    => 'blogposts_button_text',
	) ) );
	$wp_customize->add_setting( 'blogposts_button_bg', array(
		'default'           => '#cca152',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'blogposts_button_bg', array(
		'label'       => __( 'Button Background Color', 'creativeily' ),
		'section'     => 'blogposts',
		'priority'   => 1,
		'settings'    => 'blogposts_button_bg',
	) ) );


	function quick_setuply_sanitize_checkbox( $input ) {
		return ( ( isset( $input ) && true == $input ) ? true : false );
	}

}
add_action('customize_register','quick_setuply_customize_register');





if(! function_exists('quick_setuply_css_from_customizer_php' ) ):
	function quick_setuply_css_from_customizer_php(){
		?>

		<style type="text/css">

<?php if ( get_theme_mod( 'toggle_post_author_category' ) == '1' ) : ?>

	.postinfo span:nth-of-type(2),
.postinfo span:nth-of-type(3) {
      display: inline-block;
}
.postinfo span:first-of-type:after{
      display: inline-block;
}
<?php endif; ?>
			<?php if ( get_theme_mod( 'toggle_headline_shadow' ) == '1' ) : ?>
				.info{
					text-shadow:0 2px 3px rgba(0,0,0,0.2)
				}
			<?php endif; ?>
			.header a.logo, .logo:hover { color: <?php echo esc_attr(get_theme_mod( 'logo_color')); ?>; }
			.has-sidebar #secondary{ background: <?php echo esc_attr(get_theme_mod( 'sidebar_background_color')); ?>; }
			.has-sidebar #secondary h2, .has-sidebar #secondary h1, .has-sidebar #secondary h3, .has-sidebar #secondary h4, .has-sidebar #secondary h5, .has-sidebar #secondary h6, .has-sidebar #secondary th{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_title_color')); ?>; }
			.has-sidebar #secondary p, .has-sidebar #secondary .widget, .has-sidebar #secondary li, .has-sidebar #secondary ol, .has-sidebar #secondary ul,.has-sidebar #secondary dd, .has-sidebar #secondary span, .has-sidebar #secondary  div{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_text_color')); ?>; }
			.has-sidebar #secondary button.search-submit{ background: <?php echo esc_attr(get_theme_mod( 'sidebar_button_bg_color')); ?>; color:#fff; }
			.has-sidebar #secondary a{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_link_color')); ?>; }
			.has-sidebar #secondary *, .has-sidebar #secondary .widget h2{ border-color: <?php echo esc_attr(get_theme_mod( 'sidebar_border_color')); ?>; }
			.blog .wrapmain article, .archive .wrapmain article, .search-results .wrapmain article{ background: <?php echo esc_attr(get_theme_mod( 'blogposts_background')); ?>; }
			.blog .wrapmain article h2, .archive .wrapmain article h2, .search-results .wrapmain article h2,.blog .wrapmain article h2 a, .archive .wrapmain article h2 a, .search-results .wrapmain article h2 a{ color: <?php echo esc_attr(get_theme_mod( 'blogposts_headline')); ?>; }
			.postinfo, .postinfo *{ color: <?php echo esc_attr(get_theme_mod( 'blogposts_meta')); ?>; }
			.blog .wrapmain article .entry-content p, .archive .wrapmain article .entry-content p, .search-results .wrapmain article .entry-content p{ color: <?php echo esc_attr(get_theme_mod( 'blogposts_text')); ?>; }
			a.button.button-readmore{ background: <?php echo esc_attr(get_theme_mod( 'blogposts_button_bg')); ?>; }
			a.button.button-readmore{ color: <?php echo esc_attr(get_theme_mod( 'blogposts_button_text')); ?>; }
			.error404 .content-area, .search-no-results .content-area,.single .wrapmain article, .page .wrapmain article, #commentform{ background: <?php echo esc_attr(get_theme_mod( 'postpages_background')); ?>; }
			#commentform label, h3#reply-title, h2.comments-title, .page .wrapmain article h1, .page .wrapmain article h2, .page .wrapmain article h3, .page .wrapmain article h4, .page .wrapmain article h5, .page .wrapmain article h6, .page .wrapmain article th,.single .wrapmain article h1, .single .wrapmain article h2, .single .wrapmain article h3, .single .wrapmain article h4, .single .wrapmain article h5, .single .wrapmain article h6, .single .wrapmain article th{ color: <?php echo esc_attr(get_theme_mod( 'postpages_headline')); ?>; }
			.error404 .content-area p, .search-no-results .content-area p, .single .wrapmain article, .single .wrapmain article p, .single .wrapmain article dd, .single .wrapmain article li, .single .wrapmain article ul, .single .wrapmain article ol, .single .wrapmain article address, .single .wrapmain article table, .single .wrapmain article th, .single .wrapmain article td, .single .wrapmain article blockquote, .single .wrapmain article span, .single .wrapmain article div .page .wrapmain article, .page .wrapmain article p, .page .wrapmain article dd, .page .wrapmain article li, .page .wrapmain article ul, .page .wrapmain article ol, .page .wrapmain article address, .page .wrapmain article table, .page .wrapmain article th, .page .wrapmain article td, .page .wrapmain article blockquote, .page .wrapmain article span, .page .wrapmain article div{ color: <?php echo esc_attr(get_theme_mod( 'postpages_text')); ?>; }
			.single .wrapmain article a, .page .wrapmain article a{ color: <?php echo esc_attr(get_theme_mod( 'postpages_link')); ?>; }
			.wrapmain .search-submit, .page .wrapmain article a.button, .single .wrapmain article a.button, .nav-links span.button, form#commentform input#submit{ background: <?php echo esc_attr(get_theme_mod( 'postpages_buttons_bg')); ?>; }
			.wrapmain .search-submit, .nav-links span.button, form#commentform input#submit{ color: <?php echo esc_attr(get_theme_mod( 'postpages_buttons_text')); ?>; }
			.page .wrapmain article td,.single .wrapmain article td,.page .wrapmain article th, .single .wrapmain article th,.single .wrapmain article *, .page .wrapmain article *{ border-color: <?php echo esc_attr(get_theme_mod( 'postpages_borders')); ?>; }
			.footer-column-three h3{ color: <?php echo esc_attr(get_theme_mod( 'footer_headline')); ?>; }
			footer{ background: <?php echo esc_attr(get_theme_mod( 'footer_background')); ?>; }
			.footer-column-wrapper .widget a{ color: <?php echo esc_attr(get_theme_mod( 'footer_link')); ?>; }
			.footer-column-wrapper .widget *{ border-color: <?php echo esc_attr(get_theme_mod( 'footer_border')); ?>; }
			.footer-column-wrapper .widget .search-submit{ background: <?php echo esc_attr(get_theme_mod( 'footer_button_bg')); ?>; }
			.footer-column-wrapper .widget .search-submit{ color: <?php echo esc_attr(get_theme_mod( 'footer_button_text')); ?>; }
			.site-info, .site-info *,.footer-column-wrapper .widget, .footer-column-wrapper .widget li, .footer-column-wrapper .widget p, .footer-column-wrapper abbr, .footer-column-wrapper cite, .footer-column-wrapper table caption, .footer-column-wrapper td, .footer-column-wrapper th{ color: <?php echo esc_attr(get_theme_mod( 'footer_text')); ?>; }
			<?php if ( get_theme_mod( 'hide_logo' ) == '1' ) : ?>.logo, .logo:hover {display:none !important;}<?php endif; ?>
			<?php if ( get_theme_mod( 'hide_navigation' ) == '1' ) : ?>.mobile-bar {display:none !important;}<?php endif; ?>
		</style>
	<?php }
	add_action( 'wp_head', 'quick_setuply_css_from_customizer_php' );
endif;

