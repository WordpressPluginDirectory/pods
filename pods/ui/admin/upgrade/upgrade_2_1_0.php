<?php
// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

global $wpdb;
?>
<div class="wrap pods-admin">
	<div id="icon-pods" class="icon32"><br /></div>

	<h2 class="italicized"><?php _e( 'Upgrade Pods', 'pods' ); ?></h2>

	<img src="<?php echo esc_url( PODS_URL ); ?>ui/images/pods-logo-notext-rgb-transparent.png" class="pods-leaf-watermark-right" />

	<div id="pods-wizard-box" class="pods-wizard-steps-3" data-action="pods_admin" data-method="upgrade" data-_wpnonce="<?php echo esc_attr( wp_create_nonce( 'pods-upgrade' ) ); ?>" data-version="<?php echo esc_attr( $new_version ); ?>">
		<div id="pods-wizard-heading">
			<ul>
				<li class="pods-wizard-menu-current" data-step="1">
					<i></i> <span>1</span> <?php _e( 'Getting Started', 'pods' ); ?> <em></em>
				</li>
				<li data-step="2">
					<i></i> <span>2</span> <?php _e( 'Prepare', 'pods' ); ?> <em></em>
				</li>
				<li data-step="3">
					<i></i> <span>3</span> <?php _e( 'Upgrade', 'pods' ); ?> <em></em>
				</li>
			</ul>
		</div>
		<div id="pods-wizard-main">

			<!-- Getting Started Panel -->
			<div id="pods-wizard-panel-1" class="pods-wizard-panel">
				<div class="pods-wizard-content pods-wizard-grey">
					<p>
						<?php
						$intro = __( 'Thanks for upgrading your Pods 2.x site! We sincerely hope you enjoy over two years worth of planning and work, available to you for <em>free</em>.', 'pods' ) . ' ' . __( 'We need to run a few updates to your database to optimize your relationship data.', 'pods' );

						echo $intro;
						?>
					</p>
				</div>

				<?php require_once PODS_DIR . 'ui/admin/upgrade/backup.php'; ?>
			</div>
			<!-- // Getting Started Panel -->

			<!-- Prepare Panel -->
			<div id="pods-wizard-panel-2" class="pods-wizard-panel">
				<div class="pods-wizard-content">
					<p><?php _e( 'We will prepare your relationships for the upgrade. If any issues are found they will be displayed below for your review. Be sure to backup your database before continuing onto the next step for the Upgrade.', 'pods' ); ?></p>
				</div>
				<table cellpadding="0" cellspacing="0">
					<col style="width: 70px">
					<col style="width: 110px">
					<col style="width: 580px">
					<thead>
					<tr>
						<th colspan="3"><?php _e( 'Preparing Your Relationships for Upgrade', 'pods' ); ?>..</th>
					</tr>
					</thead>
					<tbody>
					<tr class="pods-wizard-table-pending" data-upgrade="relationships">
						<td class="pods-wizard-right pods-wizard-status">
							<i><img src="<?php echo esc_url( PODS_URL ); ?>ui/images/spinner.gif" alt="Loading..." /></i>
						</td>
						<td class="pods-wizard-right pods-wizard-count">&mdash;</td>
						<td class="pods-wizard-name">
							<?php _e( 'Relationships', 'pods' ); ?> <span class="pods-wizard-info"></span>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
			<!-- // Prepare Panel -->

			<!-- Migrate Panel -->
			<div id="pods-wizard-panel-3" class="pods-wizard-panel">
				<div class="pods-wizard-content">
					<p><?php _e( 'During this process your Relationships will be optimized.', 'pods' ); ?></p>
				</div>
				<table cellpadding="0" cellspacing="0">
					<col style="width: 70px">
					<col style="width: 110px">
					<col style="width: 580px">
					<thead>
					<tr>
						<th colspan="3"><?php _e( 'Optimizing Your Relationships', 'pods' ); ?>..</th>
					</tr>
					</thead>
					<tbody><!-- complete|pending|active <i></i> -->
					<tr class="pods-wizard-table-pending" data-upgrade="relationships">
						<td class="pods-wizard-right pods-wizard-status">
							<i><img src="<?php echo esc_url( PODS_URL ); ?>ui/images/spinner.gif" alt="Loading..." /></i>
						</td>
						<td class="pods-wizard-right pods-wizard-count">&mdash;</td>
						<td class="pods-wizard-name">
							<?php _e( 'Relationships', 'pods' ); ?> <span class="pods-wizard-info"></span>
						</td>
					</tr>
					<tr class="pods-wizard-table-pending" data-upgrade="cleanup">
						<td class="pods-wizard-right pods-wizard-status">
							<i><img src="<?php echo esc_url( PODS_URL ); ?>ui/images/spinner.gif" alt="Loading..." /></i>
						</td>
						<td class="pods-wizard-right pods-wizard-count">&mdash;</td>
						<td class="pods-wizard-name">
							<?php _e( 'Cleanup', 'pods' ); ?> <span class="pods-wizard-info"></span>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
			<!-- // Mirate Panel -->

		</div>
		<div id="pods-wizard-actions">
			<div id="pods-wizard-toolbar">
				<a href="#start" id="pods-wizard-start" class="button button-secondary"><?php _e( 'Start Over', 'pods' ); ?></a>
				<a href="#next" id="pods-wizard-next" class="button button-primary" data-next="<?php esc_attr_e( 'Next Step', 'pods' ); ?>" data-finished="<?php esc_attr_e( 'Start using Pods', 'pods' ); ?>"><?php _e( 'Next Step', 'pods' ); ?></a>
			</div>
			<div id="pods-wizard-finished">
				<?php _e( 'Upgrade Complete!', 'pods' ); ?>
			</div>
		</div>
	</div>
</div>

<script>
	var pods_admin_wizard_callback = function ( step ) {
		jQuery( '#pods-wizard-start, #pods-wizard-next' ).hide();

		if ( step == 2 ) {
			jQuery( '#pods-wizard-box' ).PodsUpgrade( 'prepare' );

			return false;
		}
		else {
			if ( step == 3 ) {
				jQuery( '#pods-wizard-box' ).PodsUpgrade( 'migrate' );
			}
		}
	};

	jQuery( function ( $ ) {
		$( '#pods-wizard-box' ).Pods( 'wizard' );
	} );
</script>
