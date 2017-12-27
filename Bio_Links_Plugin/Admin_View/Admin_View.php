<?php


namespace Bio_Links_Plugin\Admin_View;


use Bio_Links_Plugin\Settings\Register_Metaboxes;

class Admin_View {
	
	private $metaboxes;


	/**
	 * Public_View constructor.
	 */
	public function __construct() {

		// Show welcome message in admin view
//		new Welcome_Message();

		// Portfolio entry meta fields ( subtitle, gallery, ... )
		$this->metaboxes = new Register_Metaboxes();

		// Enqueue scripts
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );
	}


	public function enqueue( $hook ) {

		/**
		 * Only enqueue styles when they're necessary
		 *
		 *  Edit Posts: `post.php`         *
		 * `biolinks_post_page_biolinks_options` is a very special key that WordPress generates. I wouldn't have guessed it.
		 */
		if (
			! in_array( $hook, [ 'post.php', 'post-new.php', 'biolinks_post_page_biolinks_options' ] )
			&&
			false === apply_filters( 'biolinks/force_admin_style', false )
		) {
			return;
		}

		wp_enqueue_style( 'biolinks-admin', BIOLINKS_PLUGIN_DIR_URL . 'public/build/biolinks-admin.css' );
	}


}