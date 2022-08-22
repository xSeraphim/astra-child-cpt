<?php
get_header();
$args = array(
	'post_type'   => 'software',
	'post_status' => 'publish',
	'tax_query'   => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'country',
			'field'    => 'slug',
			'terms'    => 'usa',

		),
		array(
			'taxonomy' => 'country',
			'field'    => 'slug',
			'terms'    => 'romania',
		),
	),

);
$software = new WP_Query( $args );
?>
<h1>Test2</h1>
<?php
if ( $software->have_posts() ) {
	while ( $software->have_posts() ) {
		$software->the_post();

		the_title();
		echo '<br>';
	}
}
wp_reset_postdata();
?>
<hr>
<?php
get_footer();
