<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php do_action( 'biolinks/header' ) ?>

	<?php /** @TODO: Move this to the `biolinks/header` action and utilize WP_Styles and WP_Dependencies classes */ ?>
	<link rel="stylesheet" href="<?php echo BIOLINKS_PLUGIN_DIR_URL ?>public/build/biolinks.css"/>
</head>
<body <?php body_class( biolinks_current_meta()->layout() ); ?>>