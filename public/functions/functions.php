<?php

/**
 * Easy access to our god-class
 * @return \Bio_Links_Plugin
 */
function biolinks_instance() {

	return Bio_Links_Plugin::instance();
}

global $biolinks_current_meta;
function biolinks_current_meta() {

	global $biolinks_current_meta;
	if ( ! isset( $biolinks_current_meta ) ) {
		$biolinks_current_meta = biolinks_new_meta_instance();
	}

	return $biolinks_current_meta;
}

function biolinks_new_meta_instance() {

	return new Bio_Links_Plugin\Frontend\Biolinks_Meta( get_the_ID() );
}


/**
 * Detect whether current layout is an archive layout
 *
 * @return bool
 */
function biolinks_is_queried() {

	return ( 'biolink' === get_post_type() );
}

function biolinks_body_class() {

	echo biolinks_current_meta()->layout(); // it's already sanitized @layout method
}