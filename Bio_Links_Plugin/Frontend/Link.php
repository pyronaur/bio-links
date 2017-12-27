<?php


namespace Bio_Links_Plugin\Frontend;


class Link {
	use Get_Meta;


	/**
	 * Link constructor.
	 */
	public function __construct( $meta ) {

		$this->set_meta( $meta );
	}


	public function the_title() {

		if ( ! $this->get( 'title', false ) ) {
			return;
		}
		echo wp_kses_post( $this->get( 'title', false ) );

	}


	public function the_url() {

		if ( ! $this->get( 'url', false ) ) {
			return;
		}

		echo esc_url( $this->get( 'url', false ) );
	}


}