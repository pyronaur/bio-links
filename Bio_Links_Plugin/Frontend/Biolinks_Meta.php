<?php


namespace Bio_Links_Plugin\Frontend;


class Biolinks_Meta {

	protected $post_id;

	/**
	 * @var Meta
	 */
	protected $meta;

	/**
	 * Biolinks_Meta constructor.
	 */
	public function __construct( $post_id ) {

		$this->post_id = $post_id;
		$this->meta    = new Meta( $post_id );

	}


	public function the_thumbnail() {


		if ( ! $this->meta->get( 'thumbnail_id' ) ) {
			return;
		}


		$img = wp_get_attachment_image(
			$this->meta->get( 'thumbnail_id' ),
			'thumbnail',
			NULL,
			[
				'class' => 'thumb',
			]
		);

		echo $img;


	}


	public function the_description() {

		if ( ! $this->meta->get( 'description' ) ) {
			return;
		}

		echo wpautop( wp_kses_post( $this->meta->get( 'description' ) ) );

	}


	/**
	 * @return Link[]
	 */
	public function links() {

		$links = $this->meta->get( 'links' );

		if ( empty( $links ) || ! is_array( $links ) ) {
			return [];
		}

		$results = [];
		foreach ( $links as $link_meta ) {
			$results[] = new Link( $link_meta );
		}

		return $results;

	}


	public function layout() {

		if ( ! $this->meta->get( 'layout' ) ) {
			return 'default';
		}

		return sanitize_html_class( $this->meta->get( 'layout' ) ); // biolinks_body_class() relies on sanizitation

	}


}