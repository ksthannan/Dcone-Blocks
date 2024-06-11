<?php
/**
 * Plugin Name:       Dcone Block Addons for Gutenberg
 * Description:       An awesome collection of Gutenberg block addons to build amazing websites easily.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           1.0.0
 * Author:            Devcone
 * Author URI:        https://devcone.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       dcone-blocks
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Define required constants
 */
define( 'DCONE_VER', '1.0.0' );
define( 'DCONE_URL', plugins_url('', __FILE__) );
define( 'DCONE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'DCONE_URL_ASSETS', DCONE_URL . '/blocks/assets' );

/**
 * Autoload require
 */
require_once __DIR__ . "/vendor/autoload.php";

class Dcone_Blocks {
    /**
     * Properties
     */
    private static $instance = null;

    function __construct() {
        // admin enqueue 
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_frontend_assets'));

        // wp enqueue 
        add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_frontend_assets'));

        // load features 
        add_action('init', array($this, 'initialize_features'));

        add_action( 'enqueue_block_assets', array($this, 'dcone_blocks_enqueue_assets') );

        // funnctions 
        new Dcone\Blocks\DconeBlockFunctions();
    }

    /**
     * Instance
     */
    public static function get_instance() {
        if ( self::$instance == null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    /**
     * Initialize features
     */
    public function initialize_features() {

		// Load textdomain
        load_plugin_textdomain( 'dcone-blocks', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

		// Register block 
		$this -> dcone_block_devcone_slider_block_init();

        
    }

    /**
     * Enqueue frontend assets
     */
    public function admin_enqueue_frontend_assets( ) {
        wp_enqueue_script('jquery');
        wp_enqueue_style( 'dcone-beerslider-style', DCONE_URL_ASSETS . '/css/BeerSlider.css', array(), DCONE_VER, 'all' );
        wp_enqueue_style( 'dcone-style', DCONE_URL_ASSETS . '/css/admin.css', array(), DCONE_VER, 'all' );
        wp_enqueue_script( 'dcone-beerslider', DCONE_URL_ASSETS . '/js/BeerSlider.js', array( 'jquery' ), DCONE_VER, true );
        wp_enqueue_script( 'dcone-script', DCONE_URL_ASSETS . '/js/admin.js', array( 'jquery' ), DCONE_VER, true );

        // Localize script to pass image URLs
        wp_localize_script('dcone-blocks-before-after-editor-script', 'dconeBlocks', array(
            'imageUrl' => DCONE_URL_ASSETS . '/images/before.png',
            'afterImageUrl' => DCONE_URL_ASSETS . '/images/after.png'
        ));

    }

    /**
     * Frontend assets
     */
    public function wp_enqueue_frontend_assets( ) {
        wp_enqueue_style( 'dcone-beerslider-frontend', DCONE_URL_ASSETS . '/css/BeerSlider.css', array(), DCONE_VER, 'all' );
        wp_enqueue_style( 'dcone-style-frontend', DCONE_URL_ASSETS . '/css/style.css', array(), DCONE_VER, 'all' );
        wp_enqueue_script( 'dcone-beerslider-frontend', DCONE_URL_ASSETS . '/js/BeerSlider.js', array( 'jquery' ), DCONE_VER, true );
        wp_enqueue_script( 'dcone-script-frontend', DCONE_URL_ASSETS . '/js/script.js', array( 'jquery' ), DCONE_VER, true );
    }

    public function dcone_blocks_enqueue_assets() {
        // wp_enqueue_script('jquery'); 

        // wp_enqueue_style( 'dcone-style', DCONE_URL_ASSETS . '/css/BeerSlider.css', array(), DCONE_VER, 'all' );
        // wp_enqueue_style( 'dcone-style', DCONE_URL_ASSETS . '/css/admin.css', array(), DCONE_VER, 'all' );
        // wp_enqueue_script( 'dcone-beerslider', DCONE_URL_ASSETS . '/js/BeerSlider.js', array( 'jquery' ), DCONE_VER, true );
        // wp_enqueue_script( 'dcone-script', DCONE_URL_ASSETS . '/js/admin.js', array( 'jquery' ), DCONE_VER, true );

        // // Register block script
        // wp_enqueue_script(
        //     'dcone-block-editor-script',
        //     plugins_url('build/index.js', __FILE__),
        //     array('wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n', 'wp-components', 'wp-block-editor', 'jquery', 'dcone-beerslider')
        // );
    
        // // Register block styles
        // wp_enqueue_style(
        //     'dcone-block-editor-style',
        //     plugins_url('build/index.css', __FILE__),
        //     array('wp-edit-blocks')
        // );
    }


	/**
	* Register block
	*/
	function dcone_block_devcone_slider_block_init() {

		// Register blocks in the format $dir => $render_callback.
        $blocks = array(
            'before-after'  => '',
        );

        foreach ( $blocks as $dir => $render_callback ) {
            $args = array();
            if ( ! empty( $render_callback ) ) {
                $args['render_callback'] = $render_callback;
            }
            register_block_type( __DIR__ . '/blocks/build/' . $dir, $args );
        }
	}

}

/**
 * Instantiate
 */
Dcone_Blocks::get_instance();





