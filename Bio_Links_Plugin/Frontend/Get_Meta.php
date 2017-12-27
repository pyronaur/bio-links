<?php


namespace Bio_Links_Plugin\Frontend;


trait Get_Meta {
	protected $meta = [];


	public function set_meta( $meta ) {

		$this->meta = $meta;
	}


	public function get( $key, $prefix = true ) {

		if ( $prefix ) {
			$key = biolinks_prefix( $key );
		}

		if ( ! isset( $this->meta[ $key ] ) ) {
			return false;
		}

		$meta = $this->meta[ $key ];
		if ( is_array( $meta ) ) {
			return $meta[0];
		}

		return $meta;

	}
}