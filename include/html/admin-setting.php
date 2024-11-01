<?php
/**
 * Delivery Date and Time admin setting
 * 
 * @return html
 * 
 **/

	defined( 'ABSPATH' ) || exit;

	$tmd_data   = new tmd_dlverdate;
	$week_days  = $tmd_data->tmd_dlverdate_week();  

	$selected_days = get_option( 'tmd_off_days' );
	
?>

<div class="tmd-dlvrdt-container">
	
	<h2><?php esc_html_e($GLOBALS['title']); ?></h2>

	<form method="post" action="options.php">
		
		<?php settings_fields( 'tmd_dlvrdate_settings' ); ?>

		<table class="tmd-dlvrdt-table">
			
			<tbody>
				
				<tr>
					<th class="tmd-dlvr-th"><?php esc_html_e('Enable Settings', 'tmddeliverydate'); ?></th>
					<td class="tmd-dlvr-td"><input type="checkbox" name="tmd_dlvrdt_status" value="yes" <?php checked( 'yes', get_option( 'tmd_dlvrdt_status' ) ); ?> /> <?php esc_html_e('Enable Settings to apply Changes.', 'tmddeliverydate') ?></td>
				</tr>

				<tr>
					<th class="tmd-dlvr-th"><?php esc_html_e('Off Time', 'tmddeliverydate'); ?></th>
					<td class="tmd-dlvr-td"> 
						<label for="tmd-dlvrdt-to"><?php esc_html_e('To', 'tmddeliverydate') ?></label>
						<br>
						<input type="text" id="tmd-dlvrdt-to" name="tmd_dlvrdt_to" 
						value="<?php esc_html_e( get_option( 'tmd_dlvrdt_to' ), 'tmddeliverydate'); ?>" autocomplete="off" /> <?php esc_html_e("After Time select delivery won't be select on that time before.", 'tmddeliverydate') ?>
						
						<div class="tmd-dlvr-clear"></div>

						<label for="tmd-dlvrdt-from"><?php esc_html_e('From', 'tmddeliverydate') ?></label>
						<br>
						<input type="text" id="tmd-dlvrdt-from" name="tmd_dlvrdt_from" 
						value="<?php esc_html_e( get_option( 'tmd_dlvrdt_from' ), 'tmddeliverydate'); ?>" autocomplete="off" /> <?php esc_html_e("After Time select delivery won't be select on that time after.", 'tmddeliverydate') ?>
						
					</td>
				</tr>

				<tr>
					<th class="tmd-dlvr-th"><?php esc_html_e('Week Day Off', 'tmddeliverydate'); ?></th>
					<td class="tmd-dlvr-td">

						<?php 

							$checked = '';
							foreach ($week_days as $key => $week_day):

								if(!empty($selected_days)){
									$checked = in_array($key, $selected_days) ? 'checked="checked"' : ''; 
								}

								?>
									<div class="tmd-dlvr-cover">
									<label for="tmd<?php echo esc_html($week_day); ?>">
									<input type="checkbox" id="tmd<?php esc_attr_e( $week_day );  ?>" 
									value="<?php esc_attr_e($key); ?>" 
									name="tmd_off_days[]" <?php esc_attr_e( $checked );  ?> />
									<?php esc_attr_e( $week_day ); ?></label><br></div>

								<?php
							endforeach; 

						?>

						<div class="tmd-dlvr-clear"></div>

						<?php esc_html_e("one day composary to check, user won't be able to pick that days.", 'tmddeliverydate') ?>

					</td>
				</tr>

			</tbody>

		</table>

		<?php submit_button(); ?>
		
	</form>

</div>