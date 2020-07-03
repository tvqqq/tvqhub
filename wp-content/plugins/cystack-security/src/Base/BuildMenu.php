<?php
/**
 * @package CyStackSecurity
 */
namespace CyStack\Base;
use CyStack\Base\MenuConstants;
use CyStack\Base\Enqueue;

class BuildMenu
{
	public function register() {
		add_action( 'plugins_loaded', array( $this, 'load_languages') );
		add_action( 'admin_menu', array( $this, 'build_menu') );
	}
	public function load_languages() {
		load_plugin_textdomain( 'cystack-plugin', false, '/cystack-plugin/languages' );
	}

	public function build_menu() {
		$target_id = get_option('cystack_targetId');
		$notification_icon = '';

		if ( ! $target_id ) {
			$notification_icon = ' <span class="update-plugins count-1"><span class="plugin-count">!</span></span>';
		}

		if ( ! empty( $target_id ) ) {
			add_menu_page( __( 'CyStack', 'cystack-plugin' ), __( 'CyStack', 'cystack-plugin' ) . $notification_icon, 'manage_options', MenuConstants::ROOT, array( $this, 'build_app' ), CYSTACK_PLUGIN_URL . 'assets/media/icon.svg', '25.100713' );
			add_submenu_page( 'cystack', __( 'CyStack Dashboard', 'cystack-plugin' ), __( 'Dashboard', 'cystack-plugin' ), 'manage_options', MenuConstants::DASHBOARD, array( $this, 'build_app' ) );
			add_submenu_page( 'cystack', __( 'CyStack Blacklist Monitor', 'cystack-plugin' ), __( 'Blacklist Monitor', 'cystack-plugin' ), 'manage_options', MenuConstants::BLACKLIST_MONITOR, array( $this, 'build_app' ) );
			add_submenu_page( 'cystack', __( 'CyStack DNS Monitor', 'cystack-plugin' ), __( 'DNS Monitor', 'cystack-plugin' ), 'manage_options', MenuConstants::DNS_MONITOR, array( $this, 'build_app' ) );
			add_submenu_page( 'cystack', __( 'CyStack Hacking Monitor', 'cystack-plugin' ), __( 'Hacking Monitor', 'cystack-plugin' ), 'manage_options', MenuConstants::HACKING_MONITOR, array( $this, 'build_app' ) );
			add_submenu_page( 'cystack', __( 'CyStack HTTPS Monitor', 'cystack-plugin' ), __( 'HTTPS Monitor', 'cystack-plugin' ), 'manage_options', MenuConstants::HTTPS_MONITOR, array( $this, 'build_app' ) );
			add_submenu_page( 'cystack', __( 'CyStack Uptime Monitor', 'cystack-plugin' ), __( 'Uptime Monitor', 'cystack-plugin' ), 'manage_options', MenuConstants::UPTIME_MONITOR, array( $this, 'build_app' ) );
			add_submenu_page( 'cystack', __( 'CyStack Vulnerability Monitor', 'cystack-plugin' ), __( 'Vulnerability Monitor', 'cystack-plugin' ), 'manage_options', MenuConstants::VULN_MONITOR, array( $this, 'build_app' ) );
			add_submenu_page( 'cystack', __( 'CyStack Members', 'cystack-plugin' ), __( 'Members', 'cystack-plugin' ), 'manage_options', MenuConstants::MEMBERS, array( $this, 'build_app' ) );
			add_submenu_page( 'cystack', __( 'CyStack Settings', 'cystack-plugin' ), __( 'Settings', 'cystack-plugin' ), 'manage_options', MenuConstants::SETTINGS, array( $this, 'build_app' ) );
			remove_submenu_page( MenuConstants::ROOT, MenuConstants::ROOT );
		} else {
			add_menu_page( __( 'CyStack', 'cystack-plugin' ), __( 'CyStack', 'cystack-plugin' ) . $notification_icon, 'manage_options', MenuConstants::ROOT, array( $this, 'build_app' ), CYSTACK_PLUGIN_URL . 'assets/media/icon.svg', '25.100713' );
		}
	}

	/**
	 * Renders the CyStack admin page.
	 */
	public function build_app() {
		Enqueue::enqueue_bridge_assets();
		$error_message = '';

		if ( $error_message ) {
			?>
			<div class='notice notice-warning'>
				<p>
					<?php echo esc_html( $error_message ); ?>
				</p>
			</div>
			<?php
		} else {
			?>
			<div id="cystack-iframe-container"></div>
			<?php
		}
	}
}