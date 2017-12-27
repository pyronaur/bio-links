<?php

/**
 * Easy access to our god-class
 * @return \Bio_Links_Plugin
 */
function biolinks_instance() {

	return Bio_Links_Plugin::instance();
}

/**
 * Detect whether current layout is an archive layout
 *
 * @return bool
 */
function biolinks_is_queried() {
	return ( 'biolink' === get_post_type() );
}