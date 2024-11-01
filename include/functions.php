<?php
/**
 * Delivery Date and Time for WooCommerce required function
 * 
 * 
 **/

defined( 'ABSPATH' ) || exit;

/**
 * Delivery Date and Time for WooCommerce Final Class
 * 
 **/
final class Dlvr_datetime
{
    /**
     * Delivery Date and Time for WooCommerce construct return hook
     * 
     */
    public function __construct()
    {
        add_action( 'admin_menu', array($this, 'delivery_date_and_time_admin_menu_by_tmd'));
        add_action( 'admin_enqueue_scripts', array($this, 'admin_script_by_tmd'));
        add_action( 'wp_enqueue_scripts', array($this, 'front_script_by_tmd'));
        add_action( 'admin_init', array($this, 'register_admin_setting'));
        add_action( 'admin_init', array($this, 'register_setting_param_by_tmd'));

        $this->_include();
    }

    /**
     * Delivery Date and Time for WooCommerce instance null
     * 
     * @var $instance 
     */
    protected static $instance = null;

    /**
     * Delivery Date and Time for WooCommerce return self
     * 
     * @since 1.0.1 
     */
    public static function instance(){
        if( is_null( self::$instance ) ):
            self::$instance = new self();
        endif;

        return self::$instance;
    } 

    /**
     * admin menu
     * 
     * @since 1.0.2
     */
    public function delivery_date_and_time_admin_menu_by_tmd(){

        add_menu_page( __('Delivery Date And Time', 'tmddeliverydate'), 
                        __('Delivery Date And Time', 'tmddeliverydate'), 
                        'manage_woocommerce', 
                        'delivery_date_and_time', 
                        array($this, '_delivery_and_date_by_tmd') ,
                        'dashicons-clock', 
                        51 
                    );
    }

    /*Delivery Date and Time for WooCommerce menu callback function*/
    public function _delivery_and_date_by_tmd(){
        /*Tmd Delivery DateTime For WooCommerce setting page */
        include_once dirname(TMDDELIVERYDATE_PLUGIN_FILE) .'/include/html/admin-setting.php';

    }

    /**
     * Delivery Date and Time for WooCommerce required files 
     * 
     * @since 1.0.2
     **/
    public function _include(){
        include_once dirname(TMDDELIVERYDATE_PLUGIN_FILE) .'/include/classes/dlvr-class.php';
        include_once dirname(TMDDELIVERYDATE_PLUGIN_FILE) .'/include/core-functions.php';
    }

    /**
     * Delivery Date and Time for WooCommerce enqueue script
     *
     * @package script
     **/
    function admin_script_by_tmd(){
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('jquery');
        
        wp_enqueue_script('dlvr-timepicker', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/dlvr-timepicker.min.js', false, TMDDELIVERYDATE_PLUGIN_VERSION);

        wp_enqueue_script( 'dlvrdt-script',  plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/script.min.js', false, TMDDELIVERYDATE_PLUGIN_VERSION);
         wp_enqueue_style('jquery-ui');
        wp_enqueue_style( 'dlvrdt-style',  plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/dlvrdt.min.css', false, TMDDELIVERYDATE_PLUGIN_VERSION );
        wp_enqueue_style( 'dlvrdt-ui-style',  plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/dlvr-ui.min.css', false, TMDDELIVERYDATE_PLUGIN_VERSION );
    }


    /**
     * Delivery Date and Time for WooCommerce enqueue script for front
     *
     * @package script
     **/
    function front_script_by_tmd(){
        //script
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('dlvr-time-picker', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/dlvr-timepicker.min.js' , array( 'jquery' ), TMDDELIVERYDATE_PLUGIN_VERSION );

        //style
        wp_enqueue_style( 'jquery-ui-style',  plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/dlvr-ui-datepicker.css', false, TMDDELIVERYDATE_PLUGIN_VERSION );
        wp_enqueue_style( 'jquery-ui-style' ); 
        wp_enqueue_style( 'dlvrdt-ui-style-f',  plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/dlvr-ui.min.css', false, TMDDELIVERYDATE_PLUGIN_VERSION );

    }


    /**
     * Delivery Date and Time for WooCommerce register plugin settings
     * 
     **/
    function register_admin_setting() {

        $data       = new tmd_dlverdate;
        $settings   = $data->tmd_dlvrdate_input();

        foreach ($settings as $values):
            
            register_setting( 'tmd_dlvrdate_settings', $values);

        endforeach;


    }


    /**
     * Tmd Delivery DateTime For WooCommerce register stting redirect 
     * 
     * @return $setting 
     **/
     function register_setting_param_by_tmd(){

        $data = new tmd_dlverdate;
        $settings = $data->dlver_setting_param();


     }
}

Dlvr_datetime::instance();