<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package quick-setuply
 */

/** 
 * Set up the WordPress core custom header feature.
 *
 * @uses quick_setuply_header_style()
 */
function quick_setuply_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'creativeily_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'fff',
		'flex-height'            => true,
		'default-image'			=> get_theme_file_uri( '/assets/img/header.jpg' ),
		'wp-head-callback'       => 'creativeily_header_style',
		) ) );
	register_default_headers( array(
		'header-bg' => array(
			'url'           => get_theme_file_uri( '/assets/img/header.jpg' ),
			'thumbnail_url' => get_theme_file_uri( '/assets/img/header.jpg' ),
			'description'   => _x( 'Default', 'Default header image', 'quick-setuply' )
			),	
		) );

}
add_action( 'after_setup_theme', 'quick_setuply_custom_header_setup' );

if ( ! function_exists( 'creativeily_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see quick_setuply_custom_header_setup().
	 */
function creativeily_header_style() {
	$header_text_color = get_header_textcolor();
	$header_image = get_header_image();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( empty( $header_image ) && $header_text_color == get_theme_support( 'custom-header', 'default-text-color' ) ){
			return;
		}

	// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		.image-creativeily-header {
			background: #222 url(<?php header_image(); ?> ) bottom center no-repeat;
		}
		.header .info h1, .header .meta p {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
		<?php if ( ! display_header_text() ) : ?>
		.header .info h1, .header .meta p {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px); 
			display:none;
		}
		<?php endif; ?>

		<?php header_image(); ?>"
		<?php
		if ( ! display_header_text() ) :
			?>
		.header .info h1, .header .meta p {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
			display:none;
		}
		<?php
		else :
			?>
		.header .info h1, .header .meta p {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}

		<?php endif; ?>
		</style>
		<?php
	}
	endif;
