<?php 
/**
 * Plugin Name: Delivery Date and Time for WooCommerce
 * Plugin URI:  
 * Description: Delivery Date and Time for WooCommerce, The Plugin allows You To Estimate Delivery And Time Of Products.
 * Version: 2.0
 * Author: TMD Software Pvt. Ltd.
 * Author URI:  https://www.tmdextensions.com/wordpress-plugins
 * Text Domain: tmddeliverydate
 * Domain Path: /i18n/languages/
 * Requires at least: 5.1
 * Requires PHP: 5.6
 *
 * @package Delivery-DateTime-For-WooCommerce
 * @author  TMD Software Pvt. Ltd. <www.tmdextensions.com>
 * @link    https://www.tmdextensions.com/wordpress-plugins
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'TMDDELIVERYDATE_PLUGIN_FILE' ) ) {
    define( 'TMDDELIVERYDATE_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'TMDDELIVERYDATE_PLUGIN_VERSION' ) ) {
    define( 'TMDDELIVERYDATE_PLUGIN_VERSION', '2.0' );
}

/**
 * tmddeliverydate check Woocommerce exist 
 * 
 **/
add_action('plugins_loaded', function(){
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
    {

        include_once dirname(TMDDELIVERYDATE_PLUGIN_FILE) .'/include/functions.php';

    }else{

        add_action( 'admin_notices', function(){
            ?>
                <div class="notice notice-info is-dismissible">

                    <p><strong><?php _e( 'Warning! Please Install <a href="http://wordpress.org/plugins/woocommerce/">WooCommerce</a> First To Use Delivery Date and Time for WooCommerce.', 'tmddeliverydate' ); ?></strong></p>

                </div>
            <?php
        });

    }
}, 11);