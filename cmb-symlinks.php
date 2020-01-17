<?php

/**
 * Support Symlinks in Development environmnent
 */
function biolinks_update_cmb2_meta_box_url( $url ) {

	return plugin_dir_url( __FILE__ ) . '/vendor/cmb2/cmb2';
}

add_filter( 'cmb2_meta_box_url', 'biolinks_update_cmb2_meta_box_url' );
