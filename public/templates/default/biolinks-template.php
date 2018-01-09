<?php biolinks_get_template( 'header' ) ?>
<?php if ( have_posts() ): ?>
	<?php while ( have_posts() ): the_post(); ?>
		<?php biolinks_get_template( 'content' ) ?>
	<?php endwhile; ?>
<?php endif; ?>
<?php biolinks_get_template( 'footer' ) ?>