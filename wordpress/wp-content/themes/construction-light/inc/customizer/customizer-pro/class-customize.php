<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
class ConstructionLight_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ), 10 );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'constructionlight_enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {
		
		// Load custom sections.
		require_once get_theme_file_path('inc/customizer/customizer-pro/section-pro.php');

		// Register custom section types.
		$manager->register_section_type( 'ConstructionLight_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new ConstructionLight_Customize_Section_Pro(
				$manager,
				'construction-light-info',
				array(
					'title'    => '',
					'pro_text' => esc_html__( 'Upgrade To Pro','construction-light' ),
					'pro_url'  => 'https://sparklewpthemes.com/wordpress-themes/constructionlightpro/',
					'priority'  => -1,
				)
			)
		);


		// Register Documentation Section.
		$manager->add_section(
			new ConstructionLight_Customize_Section_Pro(
				$manager,
				'construction-light-doc',
				array(
					'title'    => esc_html__( 'Documentation', 'construction-light' ),
					'pro_text' => esc_html__( 'View','construction-light' ),
					'pro_url'  => 'http://docs.sparklewpthemes.com/constructionlight/',
					'priority'  => 2,
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function constructionlight_enqueue_control_scripts() {

		wp_enqueue_script( 'constructionlight-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customizer-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'constructionlight-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customizer-pro/customize-controls.css' );
	}
}
if(class_exists('WP_Customize_Section')){
	// Doing this customizer thang!
	ConstructionLight_Customize::get_instance();
}
