<?php

defined( 'ABSPATH' ) || exit; //direct access denine 


add_action( 'woocommerce_after_checkout_billing_form', function () {

	if(get_option('tmd_dlvrdt_status') != 'yes') return;

  	$dates = implode( ',' , get_option('tmd_off_days') );
	   
    ?>

        <p class="form-row form-row-first " id="">
            <?php _e('Delivery Date','tmddeliverydate');?>
            <span class="woocommerce-input-wrapper">
               <input type="text" class="input-text " name="tmd_order_date" id="tmd_dlvr_datepicker" placeholder="Choose Date"  autocomplete="off" />
            </span>
        </p>
    
        <p class="form-row form-row-last" id="">
            <?php _e('Delivery Time','tmddeliverydate');?>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text "  name="tmd_order_time"   id="tmd_dlvr_timepicker" autocomplete="off" placeholder="Choose Time" />
            </span>
        </p>

        <script>//ignore: script

            jQuery( function($) {
                "use strict";

                var off_days, c, i, day, to, from, time_to, time_from;
                off_days = [<?php esc_attr_e($dates);?>];
                to 	 = '<?php esc_attr_e( get_option( 'tmd_dlvrdt_to') );?>';
                from = '<?php esc_attr_e( get_option( 'tmd_dlvrdt_from') );?>';

                $( "#tmd_dlvr_datepicker" ).datepicker({
                    dateFormat: 'dd-mm-yy',
                    minDate: 0,
                    beforeShowDay: function(day) {
                        day = day.getDay();
                        for( i = 0; i < off_days.length; i++ ){
                            if(off_days[i]==day){
                                c = day;
                            }
                        }
                        if ( day == c ) {
                            return [false, "disabled_week"]
                        } 
                        else {
                            return [true, "selectable_week"]
                        }
                    }
                });

                $('#tmd_dlvr_timepicker').timepicker({
                    step: 30,
                    disableTimeRanges: [
                        [to, from]
                    ],
                });
                $('#tmd_dlvr_timepicker').timepicker('option', 'minTime', to); //set starting time
                $('#tmd_dlvr_timepicker').timepicker('option', 'maxTime', from); //set end time
            }); 

        </script>
    <?php 
}, 10, 1 );

add_action( 'woocommerce_checkout_update_order_meta', function  ( $order_id ) {

    if ( isset( $_POST ['tmd_order_date'] ) &&  '' != $_POST ['tmd_order_date'] ) {
        add_post_meta( $order_id, '_delivery_date',  sanitize_text_field( $_POST ['tmd_order_date'] ) );
    }
    if ( isset( $_POST ['tmd_order_time'] ) &&  '' != $_POST ['tmd_order_time'] ) {
        add_post_meta( $order_id, '_delivery_time',  sanitize_text_field( $_POST ['tmd_order_time'] ) );
    }
} , 10, 1);

/** 
 * tmd delivery date and time add value in order meta
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', function ($order) {
	if( version_compare( get_option( 'woocommerce_version' ), '3.0.0', ">=") ) {     
        $order_id = $order->get_id();
    } 
    else {
        $order_id = $order->id;
    }

    printf( '<p><strong>'.__('Delivery Date', 'tmddeliverydate').':</strong> <br/>' . get_post_meta( $order_id, '_delivery_date', true ) . '</p> <p><strong>'.__('Delivery Time', 'tmddeliverydate').':</strong> <br/>' . get_post_meta( $order_id, '_delivery_time', true ) . '</p>');

}, 10, 1 );

add_filter( 'woocommerce_email_order_meta_fields', function ( $fields, $sent_to_admin, $order ) {
    if( version_compare( get_option( 'woocommerce_version' ), '3.0.0', ">=" ) ) {  
        $order_id = $order->get_id();
    } 
    else {
        $order_id = $order->id;
    }

    $delivery_date = get_post_meta( $order_id, '_delivery_date', true );
    if ( '' != $delivery_date ) {
        $fields[ 'deliverydate' ] = array(
            'label' => __( 'Delivery Date', 'tmddeliverydate' ),
            'value' => $delivery_date,
        );
    }
    $delivery_time = get_post_meta( $order_id, '_delivery_time', true );
    if ( '' != $delivery_time ) {
        $fields[ 'deliverytime' ] = array(
            'label' => __( 'Delivery Time', 'tmddeliverydate' ),
            'value' => $delivery_time,
        );
    }
    return $fields;
}, 10, 3 );

add_filter( 'woocommerce_order_details_after_order_table', function  ( $order ) {

    if( version_compare( get_option( 'woocommerce_version' ), '3.0.0', ">=") ) {     
        $order_id = $order->get_id();
    } 
    else {
        $order_id = $order->id;
    }
    $delivery_date = get_post_meta( $order_id, '_delivery_date', true ); 
    if ( '' != $delivery_date ) {
        printf('<div class="woocommerce-column woocommerce-column--1"><h2 class="woocommerce-column__title">'.__('Delivery Date & Time', 'tmddeliverydate').'</h2><p><strong>' . __( 'Delivery Date', 'tmddeliverydate' ) . ':</strong> ' . $delivery_date);
    }

    $delivery_time = get_post_meta( $order_id, '_delivery_time', true );
    if ( '' != $delivery_time ) {
        printf( '<p><strong>' . __( 'Delivery Time', 'tmddeliverydate' ) . ':</strong> ' . $delivery_time ).'</div>';    
    }
}, 10, 1);