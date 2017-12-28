<?php


namespace Bio_Links_Plugin\Settings;


class Register_Metaboxes {


	/**
	 * Register_Metaboxes constructor.
	 */
	public function __construct() {

		add_action( 'cmb2_init', [ $this, 'add_metaboxes' ] );


	}


	public function add_metaboxes() {

		$cmb = new_cmb2_box(
			[
				'id'           => biolinks_prefix( 'form' ),
				'title'        => esc_html__( 'Links', 'biolinks' ),
				'object_types' => [ 'biolink' ],
				'context'      => 'normal',
				'priority'     => 'high',
			]
		);

		$cmb->add_field(
			[
				'name'         => esc_html__( 'Profile Image', 'bio-links' ),
				'desc'         => esc_html__( 'Upload a featured image, for example your avatar', 'bio-links' ),
				'id'           => biolinks_prefix( 'thumbnail' ),
				'type'         => 'file',
				// Optional:
				'options'      => [
					'url' => false, // Hide the text input for the url
				],
				'text'         => [
					'add_upload_file_text' => 'Add image',
				],
				'query_args'   => [
					'type' => 'image',
				],
				'preview_size' => 'thumbnail',
			]
		);


		$cmb->add_field(
			[
				'name'    => esc_html__( 'Description', 'bio-links' ),
				'desc'    => esc_html__( '(optional)', 'bio-links' ),
				'id'      => biolinks_prefix( 'description' ),
				'type'    => 'textarea_small',
				'options' => [],
			]
		);

		$links_group = $cmb->add_field(
			[
				'id'          => biolinks_prefix( 'links' ),
				'type'        => 'group',
				'description' => esc_html__( 'Add buttons to your link page by clicking "Add Button" and adding a link title and URL', 'bio-links' ),
				'options'     => [
					'group_title'   => esc_html__( 'Button {#}', 'bio-links' ), // since version 1.1.4, {#} gets replaced by row number
					'add_button'    => esc_html__( 'Add Another Button', 'bio-links' ),
					'remove_button' => esc_html__( 'Remove Button', 'bio-links' ),
					'sortable'      => true,
				],
			]
		);

		$cmb->add_group_field(
			$links_group,
			[
				'name' => esc_html__( 'Title', 'bio-links' ),
				'id'   => 'title',
				'type' => 'text',
			]
		);

		$cmb->add_group_field(
			$links_group,
			[
				'name' => esc_html__( 'Link URL', 'bio-links' ),
				'id'   => 'url',
				'type' => 'text_url',
			]
		);

		$available_layouts = [
			'default' => esc_html__( 'Default', 'bio-links' ),
			'insta'   => esc_html__( 'Instagram Style', 'bio-links' ),
			'dark'    => esc_html__( 'Dark', 'bio-links' ),
			'chic'    => esc_html__( 'Chic', 'bio-links' ),
		];


		$cmb->add_field(
			[
				'name'             => esc_html__( 'Choose Style', 'bio-links' ),
				'desc'             => esc_html__( 'Pick a style for your link page!', 'bio-links' ),
				'id'               => biolinks_prefix( 'layout' ),
				'type'             => 'select',
				'show_option_none' => false,
				'default'          => 'custom',
				'options'          => apply_filters( 'biolinks/available_layouts', $available_layouts ),
			]
		);


	}
}