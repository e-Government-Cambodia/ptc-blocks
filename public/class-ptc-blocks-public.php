<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.channchetra.com
 * @since      1.0.0
 *
 * @package    Ptc_Blocks
 * @subpackage Ptc_Blocks/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ptc_Blocks
 * @subpackage Ptc_Blocks/public
 * @author     Chann Chetra <chetra-chann@mptc.gov.kh>
 */
class Ptc_Blocks_Public {

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

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ptc_Blocks_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ptc_Blocks_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ptc-blocks-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ptc_Blocks_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ptc_Blocks_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ptc-blocks-public.js', array( 'jquery' ), $this->version, false );

	}
}
if( !function_exists( 'ptc_get_the_post_thumbnail' ) ) {
	
	function ptc_get_the_post_thumbnail( $size = 'post-thumbnail' ) {
		
		if( has_post_thumbnail() ) {
			$url = get_the_post_thumbnail_url( '', $size );
		}else{
			$url = get_template_directory_uri().'/asset/img/'.$size.'.png';
		}
		
		return $url;
	}
}

function ptc_the_block_title( $arr ){
	$link = '<div class="block-title2 primary-color">'.$arr['title'].'</div>';
	if ( isset( $arr['cat_id'] ) && $arr['cat_id'] != '' ) {
		// Get the URL of this category
		$category_link = get_category_link( $arr['cat_id'] );
	}	
	if ( isset( $category_link ) && $category_link != '' ) {
		$link = '<a class="primary-color" href="'. esc_url( $category_link ) .'">'.$arr['title'].'</a>';
	}
	if ( isset( $arr['taxonomy'] ) && $arr['taxonomy'] != '' ) {
		$href = get_term_link( $arr['type_slug'], $arr['taxonomy'] );
		if ( !is_wp_error( $href ) )
		$link = '<a class="primary-color" href="'. esc_url( $href ) .'">'.esc_html( $arr['title'] ).'</a>';
	}
	if( isset( $arr['link'] ) ) {
		$link = '<a class="primary-color" href="'. $arr['link'] .'">'.$arr['title'].'</a>';
	}
	if ( isset( $arr['cat_id'] ) && $arr['cat_id'] == '' ) {
		$link = '<a class="primary-color" href="#">'.$arr['title'].'</a>';
	}
    $html = '<div class="block-title2 primary-color">%s</div>';
    printf( $html, $link );
}