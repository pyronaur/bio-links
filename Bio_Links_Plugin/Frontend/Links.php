<?php


namespace Bio_Links_Plugin\Frontend;


class Links {

	public static function all( $post_id ) {

		return get_post_meta( $post_id, 'link', true );
	}
}