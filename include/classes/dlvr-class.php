<?php
/**
 * tmd main class
 *  
 **/

defined( 'ABSPATH' ) || exit;

class tmd_dlverdate  //phpcs: ignore naming-convention
{
	
	/**
	 * tmd week days 
	 * 
	 * @return $week
	 **/
	static function tmd_dlverdate_week(){

		$week = array(
					'0' => __('Sunday',		'tmddeliverydate'),
					'1' => __('Monday', 	'tmddeliverydate'),
					'2' => __('Tuesday',	'tmddeliverydate'),
					'3' => __('Wednesday', 	'tmddeliverydate'),
					'4' => __('Thrusday', 	'tmddeliverydate'),
					'5' => __('Friday', 	'tmddeliverydate'),
					'6' => __('Saturday', 	'tmddeliverydate'),
				);

		return $week; 

	}

	/**
	 * Tmd Delivery DateTime admin setting form input
	 * 
	 * @return $settings_fields
	 **/
	public function tmd_dlvrdate_input(){

	    $settings_fields = array(
             0 => 'tmd_dlvrdt_status',
             1 => 'tmd_dlvrdt_to',
             2 => 'tmd_dlvrdt_from',
             3 => 'tmd_off_days'
            );

	    return $settings_fields;
	}


	/**
	 * Tmd delivery DateTime for WooCommerce setting param 
	 * 
	 * @param $links
	 * @return wp_hook 
	 **/
	function dlver_setting_param(){

		$tmd_dlversetting = plugin_basename( 'tmd-deliverydate-for-woocommerce/tmd-delivery-date.php' );

		return add_filter( "plugin_action_links_$tmd_dlversetting", function($links){
			
			return array( 'setting' => '<a href="'. admin_url( 'admin.php?page=tmd_deliverydate' ) .'">' . /* translators: wordpress */ __( 'Settings', 'tmddeliverydate' ) . '</a>') + $links;
		
		} );

	}

}