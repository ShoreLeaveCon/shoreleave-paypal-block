<?php
/*
    Plugin Name: Shore Leave PayPal blocks.
    Description: PayPal blocks for the front-end.
    Version: 0.1
    Author: That Blair Guy
    Author URI: https://ThatBlairGuy.com
    License: GPLv2 or later
*/

if ( !class_exists( 'ShoreLeave_PayPalBlocks')) {

    require_once plugin_dir_path( __FILE__ ) . 'includes/sl-paypal-block.php';

    class ShoreLeave_PayPalBlocks {
        // So yeah, it's a singleton. Not sure how I feel about that.
        static $instance = false;

        static $postTypes;

        private function __construct() {
            // Front end
            add_action('wp_enqueue_scripts',    array($this, 'setup_css'));
            add_shortcode('paypal-block',        array($this, 'generate_block'));
        }

        public static function getInstance() {
            if( !self::$instance )
                self::$instance = new self;
            return self::$instance;
        }

        public function generate_block($attributes, $content, $codeName) {
            return SL_PayPalBlock::generate($attributes);
        }

        public function setup_css() {
            wp_register_style(get_class($this), plugins_url('css/style.css',__FILE__ ));
            wp_enqueue_style(get_class($this));
        }
    }

    $ShoreLeave_PayPalBlocks = ShoreLeave_PayPalBlocks::getInstance();
}
