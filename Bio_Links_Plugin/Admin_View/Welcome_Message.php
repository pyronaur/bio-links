<?php


namespace Bio_Links_Plugin\Admin_View;


class Welcome_Message {


	private $meta_key     = 'biolinks_welcome_status';
	private $action_close = 'close_welcome';


	/**
	 * Welcome_Message constructor.
	 */
	public function __construct() {

		add_action( 'admin_notices', [ $this, 'display' ] );
		add_action( 'admin_init', [ $this, 'ignore' ] );

		if ( $this->should_display() ) {
			add_filter( 'biolinks/force_admin_style', '__return_true' );
		}

	}


	public function should_display() {

		global $current_user;
		$user_id = $current_user->ID;

		return ( 'message_is_closed' != get_user_meta( $user_id, $this->meta_key, true ) );
	}


	public function display() {

		if ( $this->should_display() ) {
			$this->the_message();
		}


	}

	public function the_message() {

		$url_video_tutorial = "https://colormelon.com/easy-biolinks-full-setup-guide/?utm_source=easy-biolinks&utm_medium=welcome";
		$url_documentation  = "http://go.colormelon.com/epp-tutorial";
		?>
		<div class="Biolinks_Welcome notice">
			<h4><?php esc_html_e( 'Welcome to Bio Links', 'biolinks' ); ?></h4>
			<p>

				<?php
				printf(
					wp_kses(
						__(
							'To get started, have a look at the <a target="_blank" href="%1$s">full setup guide</a> or the <a target="_blank" href="%2$s">video tutorial</a>',
							'biolinks'
						),
						// Kses rules:
						[
							// Allow links with targets and hrefs
							'a' => [
								'href'   => [],
								'target' => [],
							],
						]
					),

					// Pass variables to printf()
					$url_video_tutorial,
					$url_documentation
				);
				?>
			</p>
			<a class="Biolinks_Hide" href="?<?php echo $this->action_close ?>=1">&times;</a>
		</div>

		<?php
	}


	function ignore() {

		global $current_user;
		$user_id = $current_user->ID;

		if ( isset( $_GET[ $this->action_close ] ) && '1' == $_GET[ $this->action_close ] ) {
			add_user_meta( $user_id, $this->meta_key, 'message_is_closed', true );
		}
	}

}