<?php

/**
 * Plugin Name: Dokan Extension
 * Description: Description
 * Plugin URI: http://#
 * Author: Author
 * Author URI: http://#
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: text-domain
 * Domain Path: domain/path
 */

use TierPricingTable\Admin\Export\Woocommerce as WooCommerceExport;
use TierPricingTable\Admin\Import\Woocommerce as WooCommerceImport;
use TierPricingTable\Admin\Import\WPAllImport;

class Dokanextend
{

	public $version    = '1.0.0';
    private $container = [];

	public function __construct() {
		$this->define_constants();

		register_activation_hook( __FILE__, [ $this, 'activation' ] );
		register_deactivation_hook( __FILE__, [ $this, 'deactivation' ] );

        add_action( 'dokan_loaded', array( $this, 'init_plugin' ) );
	}


	public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new Self();
        }

        return $instance;
    }

    public function __get( $prop ) {
        if ( array_key_exists( $prop, $this->container ) ) {
            return $this->container[ $prop ];
        }

        return $this->{$prop};
    }

    public function __isset( $prop ) {
        return isset( $this->{$prop} ) || isset( $this->container[ $prop ] );
    }

    public function define_constants() {
        define( 'DOKANEXTENDED_VERSION', $this->version );
        define( 'DOKANEXTENDED_SEPARATOR', ' | ');
        define( 'DOKANEXTENDED_FILE', __FILE__ );
        define( 'DOKANEXTENDED_ROOT', __DIR__ );
        define( 'DOKANEXTENDED_PATH', dirname( DOKANEXTENDED_FILE ) );
        define( 'DOKANEXTENDED_INCLUDES', DOKANEXTENDED_PATH . '/includes' );
        define( 'DOKANEXTENDED_URL', plugins_url( '', DOKANEXTENDED_FILE ) );
        define( 'DOKANEXTENDED_ASSETS', DOKANEXTENDED_URL . '/assets' );
    }

    public function init_plugin() {
    	$this->includes();
    	$this->init_classes();
        $this->init_hooks();
    }

    public function includes() {
        require_once DOKANEXTENDED_INCLUDES . '/class-min-max.php';
        require_once DOKANEXTENDED_INCLUDES . '/class-tier-pricing.php';
        require_once DOKANEXTENDED_INCLUDES . '/functions.php';
    }

    public function init_classes() {

        if( is_plugin_active( 'woocommerce-min-max-quantities/woocommerce-min-max-quantities.php' ) ) {
            $this->container['min_max'] = new DokanMinMax();
        }

        if( is_plugin_active( 'tier-pricing-table/tier-pricing-table.php' ) ) {
            new WooCommerceExport();
            new WooCommerceImport();
            new WPAllImport();

            $this->container['min_max'] = new DokanTierPriceing();
        }
    }

    public function activation() {

    }

    public function deactivation() {

    }

    public function init_hooks() {
        add_action( 'init', [ $this, 'localization_setup' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueueAssets' ] );

	}

	public function localization_setup() {
        load_plugin_textdomain( 'dokanextend', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

    public function enqueueAssets() {
        wp_register_script( 'dokan-extended-frontend-js', DOKANEXTENDED_ASSETS . '/js/main.js',[ 'jquery' ], $this->version, true );
        wp_register_style( 'dokan-extended-frontend-css', DOKANEXTENDED_ASSETS . '/css/main.css' );

        wp_enqueue_script( 'dokan-extended-frontend-js' );
        wp_enqueue_style( 'dokan-extended-frontend-css' );
    }

    public function plugin_path() {
        return untrailingslashit( plugin_dir_path( __FILE__ ) );
    }

    public function template_path() {
        return apply_filters( 'dokan_template_path', 'dokan/' );
    }
}


if ( ! function_exists( 'dokanextend' ) ) {

	function dokanextend() {
		return Dokanextend::init();
	}
}

dokanextend();