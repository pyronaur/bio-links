<?php


namespace Bio_Links_Plugin\Frontend;


class Biolinks_Meta {
	private $post_id;

	use Get_Meta;


	/**
	 * Biolinks_Meta constructor.
	 */
	public function __construct( $post_id ) {

		$this->post_id = $post_id;
		$this->set_meta( get_post_meta( $post_id ) );
	}


	public function the_thumbnail() {


		if ( ! $this->get( 'thumbnail_id' ) ) {
			return;
		}


		$img = wp_get_attachment_image(
			$this->get( 'thumbnail_id' ),
			'thumbnail',
			NULL,
			[
				'class' => 'thumb',
			]
		);

		echo $img;


	}


	public function the_description() {

		if ( ! $this->get( 'description' ) ) {
			return;
		}

		echo wpautop( wp_kses_post( $this->get( 'description' ) ) );

	}


	/**
	 * @return Link[]
	 */
	public function links() {


		if ( ! $this->get( 'links' ) ) {
			return [];
		}

		return array_map(
			function ( $meta ) {

				return new Link( $meta );
			},
			unserialize( $this->get( 'links' ) )
		);

	}


	public function layout() {

		if ( ! $this->get( 'layout' ) ) {
			return 'default';
		}

		return sanitize_html_class( $this->get( 'layout' ) ); // biolinks_body_class() relies on sanizitation

	}


}