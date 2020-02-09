<?php


namespace Bio_Links_Plugin\Frontend;


class Link {

	protected $data;

	/**
	 * Link constructor.
	 */
	public function __construct( $data ) {
		$this->data = $data;

	}

	public function get( $key, $default = false ) {
		if ( ! isset( $this->data[ $key ] ) ) {
			return $default;
		}

		return $this->data[ $key ];

	}


	public function the_title() {

		if ( ! $this->get( 'title' ) ) {
			return;
		}
		echo wp_kses_post( $this->get( 'title' ) );

	}


	public function the_url() {

		if ( ! $this->get( 'url' ) ) {
			return;
		}

		echo esc_url( $this->get( 'url' ) );
	}


}