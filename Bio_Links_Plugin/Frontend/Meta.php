<?php


namespace Bio_Links_Plugin\Frontend;


class Meta {

	private $post_id;

	/**
	 * Meta constructor.
	 */
	public function __construct( $post_id ) {
		$this->post_id = $post_id;
	}

	public function get( $key, $prefix = true ) {

		if ( $prefix ) {
			$key = biolinks_prefix( $key );
		}

		$meta = get_post_meta( $this->post_id, $key );
		if ( count( $meta ) === 1 ) {
			$meta = array_shift( $meta );
		}

		return $meta;

	}

}