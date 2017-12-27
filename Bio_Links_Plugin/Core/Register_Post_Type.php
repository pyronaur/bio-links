<?php


namespace Bio_Links_Plugin\Core;


class Register_Post_Type {


	public static function register_post_type() {

		$labels  = [
			'name'                  => esc_html_x( 'Bio Links', 'Bio Link General Name', 'bio-links' ),
			'singular_name'         => esc_html_x( 'Bio Link Entry', 'Bio Link Singular Name', 'bio-links' ),
			'menu_name'             => esc_html__( 'Bio Links', 'bio-links' ),
			'name_admin_bar'        => esc_html__( 'Bio Link', 'bio-links' ),
			'attributes'            => esc_html__( 'Item Attributes', 'bio-links' ),
			'parent_item_colon'     => esc_html__( 'Parent Item:', 'bio-links' ),
			'all_items'             => esc_html__( 'All Items', 'bio-links' ),
			'add_new_item'          => esc_html__( 'Add New Item', 'bio-links' ),
			'add_new'               => esc_html__( 'Add New', 'bio-links' ),
			'new_item'              => esc_html__( 'New Item', 'bio-links' ),
			'edit_item'             => esc_html__( 'Edit Item', 'bio-links' ),
			'update_item'           => esc_html__( 'Update Item', 'bio-links' ),
			'view_item'             => esc_html__( 'View Item', 'bio-links' ),
			'view_items'            => esc_html__( 'View Items', 'bio-links' ),
			'search_items'          => esc_html__( 'Search Item', 'bio-links' ),
			'not_found'             => esc_html__( 'Not found', 'bio-links' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'bio-links' ),
			'featured_image'        => esc_html__( 'Featured Image', 'bio-links' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'bio-links' ),
			'items_list'            => esc_html__( 'Items list', 'bio-links' ),
			'items_list_navigation' => esc_html__( 'Items list navigation', 'bio-links' ),
			'filter_items_list'     => esc_html__( 'Filter items list', 'bio-links' ),
		];
		$rewrite = [
			'slug'       => 'links',
			'with_front' => false,
			'pages'      => false,
			'feeds'      => false,
		];
		$args    = [
			'label'               => esc_html__( 'Bio Link', 'bio-links' ),
			'labels'              => $labels,
			'supports'            => [ 'title' ],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 15,
			'menu_icon'           => 'dashicons-admin-links',
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
			'show_in_rest'        => true,
		];

		$args = apply_filters( 'biolinks/post_type/args', $args );
		register_post_type( 'biolink', $args );


	}


}