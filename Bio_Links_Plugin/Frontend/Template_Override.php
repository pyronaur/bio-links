<?php


namespace Bio_Links_Plugin\Frontend;


class Template_Override {

	protected $layout;


	/**
	 * Template constructor.
	 */
	public function __construct( $layout ) {

		$this->layout = $layout;
	}


	/**
	 * Directly and instantly load template file
	 *
	 * If you're looking for a function to use in themes, have a look at `biolinks_get_template` function instead
	 */
	public function load() {


		if ( Template::load( 'biolinks-template', $this->layout ) ) {
			die();
		}


	}
}