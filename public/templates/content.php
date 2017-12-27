<?php $bio = new Bio_Links_Plugin\Frontend\Biolinks_Meta( get_the_ID() ); ?>
<div class="biolinks">
	<div class="thumbnail"><?php $bio->the_thumbnail() ?></div>
	<div class="description">
		<?php $bio->the_description() ?>
	</div>

	<div class="links">
		<?php foreach ( $bio->links() as $link ) : ?>
			<div class="link">
				<a class="button" href="<?php $link->the_url() ?>"><?php $link->the_title(); ?></a>
			</div>
		<?php endforeach; ?>
	</div>
</div>