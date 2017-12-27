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
				'title'        => __( 'Links', 'biolinks' ),
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
				'desc'    => '(optional)',
				'id'      => biolinks_prefix( 'description' ),
				'type'    => 'textarea_small',
				'options' => [],
			]
		);

		$links_group = $cmb->add_field(
			[
				'id'          => biolinks_prefix( 'links' ),
				'type'        => 'group',
				'description' => esc_html__( 'Linkity tuuu tuuu', 'bio-links' ),
				// 'repeatable'  => false, // use false if you want non-repeatable group
				'options'     => [
					'group_title'   => esc_html__( 'Button {#}', 'bio-links' ), // since version 1.1.4, {#} gets replaced by row number
					'add_button'    => esc_html__( 'Add Another Button', 'bio-links' ),
					'remove_button' => esc_html__( 'Remove Button', 'bio-links' ),
					'sortable'      => true, // beta
					// 'closed'     => true, // true to have the groups closed by default
				],
			]
		);

		$cmb->add_group_field(
			$links_group,
			[
				'name' => 'Title',
				'id'   => 'title',
				'type' => 'text',
			]
		);

		$cmb->add_group_field(
			$links_group,
			[
				'name' => 'Link',
				'desc' => 'URL ',
				'id'   => 'url',
				'type' => 'text_url',
			]
		);


	}
}