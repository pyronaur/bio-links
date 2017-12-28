<div class="biolinks">
	<div class="thumbnail"><?php biolinks_current_meta()->the_thumbnail() ?></div>
	<div class="description">
		<?php biolinks_current_meta()->the_description() ?>
	</div>

	<div class="links">
		<?php foreach ( biolinks_current_meta()->links() as $link ) : ?>
			<div class="link">
				<a class="button" href="<?php $link->the_url() ?>"><?php $link->the_title(); ?></a>
			</div>
		<?php endforeach; ?>
	</div>
</div>