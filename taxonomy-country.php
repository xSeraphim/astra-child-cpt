<?php
get_header();
?>
<h1><?php echo single_term_title(); ?></h1>
<h2><?php echo term_description(); ?></h2>
<?php

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		the_title();
		echo '<br>';
	}
	the_posts_pagination();
} else {
	_e( 'No Software found', 'astra-child' );
}
?>
<?php
get_footer();
