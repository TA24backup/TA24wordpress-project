<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mapster.me
 * @since      1.0.0
 *
 * @package    Mapster_Wordpress_Maps
 * @subpackage Mapster_Wordpress_Maps/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mapster_Wordpress_Maps
 * @subpackage Mapster_Wordpress_Maps/public
 * @author     Mapster Technology Inc <hello@mapster.me>
 */
class Mapster_Wordpress_Maps_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
			wp_enqueue_style('dashicons');
			wp_register_style('mapster_map_mapbox_css', plugin_dir_url( __FILE__ ) . "../admin/css/vendor/mapbox-gl-2.4.1.css", array(), $this->version);
			wp_register_style('mapster_map_maplibre_css', plugin_dir_url( __FILE__ ) . "../admin/css/vendor/maplibre-1.15.2.css", array(), $this->version);
			wp_register_style('mapster_map_directions_css', plugin_dir_url( __FILE__ ) . "../admin/css/vendor/directions.css", array(), $this->version);
			wp_register_style('mapster_map_geocoder_css', plugin_dir_url( __FILE__ ) . "../admin/css/vendor/mapbox-gl-geocoder-4.7.2.css", array(), $this->version);
			wp_register_style('mapster_map_geosearch_css', plugin_dir_url( __FILE__ ) . "../admin/css/vendor/leaflet-geosearch-3.0.5.css", array(), $this->version);
			wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../admin/css/mapster-wordpress-maps.css', array(), $this->version, 'all' );
			wp_register_style( 'mapster_map_public_css', plugin_dir_url( __FILE__ ) . 'css/mapster-wordpress-maps-public.css', array(), $this->version, 'all' );
			wp_register_style('mapster_map_draw_css', plugin_dir_url( __FILE__ ) . "../admin/css/vendor/mapbox-gl-draw-1.3.0.css", array(), $this->version);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		$settings_page_id = get_option('mapster_settings_page');
		$access_token = get_field('default_access_token', $settings_page_id);
		$injectedParams = array(
				'public' => true,
				'rest_url' => get_rest_url(),
				'directory' => plugin_dir_url( __FILE__ ),
				'mapbox_access_token' => $access_token
		);
		// wp_register_script('mapster_map_mapbox', plugin_dir_url( __FILE__ ) . "../admin/js/vendor/maplibre-1.15.2.js", array('jquery'), $this->version);
		// wp_register_script('mapster_map_mapbox_draw', plugin_dir_url( __FILE__ ) . "../admin/js/vendor/mapbox-gl-draw-1.3.0.js", array('mapster_map_mapbox'), $this->version);
		// wp_register_script('mapster_map_mapbox_submit', plugin_dir_url( __FILE__ ) . "js/mapster-wordpress-maps-submit.js", array('mapster_map_mapbox_draw'), $this->version);
		// wp_localize_script('mapster_map_mapbox_submit', 'params', $injectedParams);
		wp_register_script('mapster_map_maplibre', plugin_dir_url( __FILE__ ) . "../admin/js/vendor/maplibre-1.15.2.js", array('jquery'), $this->version);
		wp_register_script('mapster_map_maplibre_geocoder', plugin_dir_url( __FILE__ ) . "../admin/js/vendor/mapbox-gl-geocoder-4.7.2.js", array('mapster_map_maplibre'), $this->version);
		wp_register_script('mapster_map_maplibre_draw', plugin_dir_url( __FILE__ ) . "../admin/js/vendor/mapbox-gl-draw-1.3.0.js", array('mapster_map_maplibre_geocoder'), $this->version);
		wp_register_script('mapster_map_maplibre_submit', plugin_dir_url( __FILE__ ) . "js/mapster-wordpress-maps-submit.js", array('mapster_map_maplibre_draw'), $this->version, true);
		wp_localize_script('mapster_map_maplibre_submit', 'params', $injectedParams);
	}

	/**
	 * Register shortcode
	 *
	 * @since    1.0.0
	 */
	public function mapster_wordpress_maps_register_shortcodes() {
		add_shortcode( 'mapster_wp_map', array( $this, 'mapster_wordpress_maps_shortcode_display') );
		add_shortcode( 'mapster_wp_map_submit', array( $this, 'mapster_wordpress_maps_submission_shortcode_display') );
	}

	public function mapster_wordpress_maps_submission_shortcode_display( $atts ){

	  $id = rand(0, 10000);
		$map_provider = 'maplibre';
		if($map_provider === 'maplibre') {
			 wp_enqueue_style( "mapster_map_maplibre_css" );
			 wp_enqueue_style( "mapster_map_draw_css" );
			 wp_enqueue_style( "mapster_map_geocoder_css" );

			 wp_enqueue_script( "mapster_map_maplibre" );
				 wp_enqueue_script( "mapster_map_maplibre_geocoder" );
			 wp_enqueue_script( "mapster_map_maplibre_draw" );
			 wp_enqueue_script( 'mapster_map_maplibre_submit' );
		}
		// if($map_provider === 'mapbox') {
		// 	 wp_enqueue_style( "mapster_map_mapbox_css" );
		// 	 wp_enqueue_style( "mapster_map_draw_css" );
		//
		// 	 wp_enqueue_script( "mapster_map_mapbox" );
		// 	 wp_enqueue_script( "mapster_map_mapbox_draw" );
		// 	 wp_enqueue_script( 'mapster_map_mapbox_submit' );
		// }
		wp_enqueue_style( "mapster_map_public_css" );

		$latitude = isset($atts['latitude']) ? $atts['latitude'] : "0";
		$longitude = isset($atts['longitude']) ? $atts['longitude'] : "0";
		$header = isset($atts['header']) ? $atts['header'] : "Submit a Feature";
		$instructions = isset($atts['instructions']) ? $atts['instructions'] : "Click the map below to add points, fill out the form that appears, and submit. Your post will be reviewed by site admins.";
		$zoom = isset($atts['zoom']) ? $atts['zoom'] : "1";
		$allow_points = isset($atts['allow_points']) ? $atts['allow_points'] : "true";
		$allow_lines = isset($atts['allow_lines']) ? $atts['allow_lines'] : "true";
		$allow_polygons = isset($atts['allow_polygons']) ? $atts['allow_polygons'] : "true";
		$include_geocoder = isset($atts['include_geocoder']) ? $atts['include_geocoder'] : "";
		$mark_as_category = isset($atts['mark_as_category']) ? $atts['mark_as_category'] : "";
		$publish = isset($atts['publish']) ? $atts['publish'] : "draft";

	  return "
	 		<div>
				<button id='mapster-submit-".$id."' class='mapster-submit'>Submit Feature</button>
				<div id='mapster-submission-modal-overlay-".$id."' class='mapster-submission-modal-overlay'></div>
				<div id='mapster-submission-modal-".$id."' class='mapster-submission-modal'>
					<div id='mapster-submission-modal-close-".$id."' class='mapster-submission-modal-close'>
						<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 14 14' fill='none'>
							<path fill-rule='evenodd' clip-rule='evenodd' d='M13.7071 1.70711C14.0976 1.31658 14.0976 0.683417 13.7071 0.292893C13.3166 -0.0976311 12.6834 -0.0976311 12.2929 0.292893L7 5.58579L1.70711 0.292893C1.31658 -0.0976311 0.683417 -0.0976311 0.292893 0.292893C-0.0976311 0.683417 -0.0976311 1.31658 0.292893 1.70711L5.58579 7L0.292893 12.2929C-0.0976311 12.6834 -0.0976311 13.3166 0.292893 13.7071C0.683417 14.0976 1.31658 14.0976 1.70711 13.7071L7 8.41421L12.2929 13.7071C12.6834 14.0976 13.3166 14.0976 13.7071 13.7071C14.0976 13.3166 14.0976 12.6834 13.7071 12.2929L8.41421 7L13.7071 1.70711Z' fill='black' />
						</svg>
					</div>
					<div class='mapster-submission-modal-title'>
						<h1>" . $header . "</h1>
					</div>
					<div class='mapster-submission-modal-content'>
						<p>" . $instructions . "</p>
						<div id='mapster-submission-map-".$id."' class='mapster-submission-map'
							data-mapLibrary='".$map_provider."'
							data-allow_points='".$allow_points."'
							data-allow_lines='".$allow_lines."'
							data-allow_polygons='".$allow_polygons."'
							data-mark_as_category='".$mark_as_category."'
							data-include_geocoder='".$include_geocoder."'
							data-center='[".$longitude.",".$latitude."]'
							data-zoom='".$zoom."'
							data-category='".$mark_as_category."'
							data-publish='".$publish."'
						></div>
						<hr />
						<div class='mapster-submission-details'>
							<div>
	    					<label for='mapster-submission-post-title'>Name / Title</label>
								<div><input id='mapster-submission-post-title-".$id."' name='mapster-submission-post-title' type='text' placeholder='Name' /></div>
							</div>
							<div style='margin-top: 10px;'>
	    					<label for='mapster-submission-post-description'>Description</label>
								<textarea id='mapster-submission-post-description-".$id."' name='mapster-submission-post-description' placeholder='Description'></textarea>
							</div>
							<div id='mapster-submission-response-".$id."'>

							</div>
							<div>
								<button id='mapster-post-submit-".$id."' class='mapster-post-submit'>Submit</button>
							</div>
						</div>
					</div>
				</div>
			</div>
	  ";
	}

	/**
	 * Add shortcode to Map type content
	 *
	 * @since    1.0.0
	 */
	public function mapster_wordpress_maps_output_shortcode( $content ) {
		if( is_singular('mapster-wp-map') ) {
			$output_shortcode = do_shortcode( '[mapster_wp_map id="' . get_the_ID() . '"]' );
			$output_shortcode .= $content;
			return $output_shortcode;
		} else {
			return $content;
		}
	}

	/**
	 * Map shortcode logic
	 *
	 * @since    1.0.0
	 */
	public function mapster_wordpress_maps_shortcode_display( $atts ){

		$additional_plugins = array('Mwm_Store_Locator');
		$loaded_plugins = array();
		foreach($additional_plugins as $plugin_class) {
			if(class_exists($plugin_class)) {
				array_push($loaded_plugins, $plugin_class);
			}
		}

		// Handle script loading
		$settings_page_id = get_option('mapster_settings_page');
		$access_token = get_field('default_access_token', $settings_page_id);
		$injectedParams = array(
				'public' => true,
				'rest_url' => get_rest_url(),
				'loaded_plugins' => $loaded_plugins,
				'directory' => plugin_dir_url( __FILE__ ),
				'mapbox_access_token' => $access_token
		);

		$map_provider = get_field('map_type', $atts['id'])['map_provider'];

		// Check for required dependencies
		$directions_enabled = get_field('directions_control', $atts['id'])['enable'];
		$geocoder_enabled = false;
		if(get_field('geocoder_control', $atts['id'])['enable'] == true) {
			$geocoder_enabled = true;
		};
		if(get_field('filter', $atts['id'])['custom_search_filter']['enable'] == true) {
			$geocoder_enabled = true;
		};
		if(get_field('filter', $atts['id'])['filter_dropdown']['enable'] == true) {
			$geocoder_enabled = true;
		};

		$last_dependency = 'jquery';
		if($map_provider === 'maplibre') {
			wp_enqueue_script('mapster_map_'.$map_provider, plugin_dir_url( __FILE__ ) . "../admin/js/vendor/maplibre-1.15.2.js", array($last_dependency), $this->version);
			$last_dependency = 'mapster_map_'.$map_provider;
		}
		if($map_provider === 'mapbox') {
			wp_enqueue_script('mapster_map_'.$map_provider, plugin_dir_url( __FILE__ ) . "../admin/js/vendor/mapbox-gl-2.4.1.js", array($last_dependency), $this->version);
			$last_dependency = 'mapster_map_'.$map_provider;
		}
		wp_enqueue_script('mapster_map_turf', plugin_dir_url( __FILE__ ) . "../admin/js/vendor/custom-turf.js", array($last_dependency), $this->version);
		$last_dependency = 'mapster_map_turf';

		if($directions_enabled) {
			wp_enqueue_style( "mapster_map_directions_css" );
			wp_enqueue_script('mapster_map_directions_js', plugin_dir_url( __FILE__ ) . "../admin/js/vendor/mapbox-gl-directions-4.1.0.js", array($last_dependency), $this->version);
			$last_dependency = 'mapster_map_directions_js';
		}
		if($geocoder_enabled) {
			wp_enqueue_style( "mapster_map_geocoder_css" );
			wp_enqueue_script('mapster_map_geocoder_js', plugin_dir_url( __FILE__ ) . "../admin/js/vendor/mapbox-gl-geocoder-4.7.2.js", array($last_dependency), $this->version);
			$last_dependency = 'mapster_map_geocoder_js';
		}
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../admin/js/dist/mwp.js', array($last_dependency), $this->version, true );
		wp_localize_script( $this->plugin_name, 'params', $injectedParams);
		wp_enqueue_script( $this->plugin_name);

		wp_enqueue_style( "mapster_map_".$map_provider."_css" );
		wp_enqueue_style( $this->plugin_name );
		wp_enqueue_style( "mapster_map_public_css" );


		return "<div><div class='mapster-wp-maps' data-id='" . $atts['id'] . "' id='mapster-wp-maps-" . $atts['id'] . "'></div></div>";
	}

}
