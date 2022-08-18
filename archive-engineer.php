<?php
get_header();
// How to sort engineers
$args = array(
	'post_type' => 'engineer',
	'order'     => 'ASC',
);
// Loop for engineer posts
$loop = new WP_Query( $args );
if ( have_posts() ) {
	while ( $loop->have_posts() ) :
		$loop->the_post();
		?>
<section class="content">	
	<div class="column-1">
		<img src=<?php echo get_the_post_thumbnail_url(); ?> class="image">
	</div>
	<div class="column-2">
		<h2 class="heading"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
		<!-- <p class="author">by Tim Buchalka</p>
		<p class="details">This Python For Beginners Course Teaches You The Python Language Fast. Includes Python Online Training With Python 3</p> -->
	</div>
	<div class="column-3">
		<!-- <ul>
			<li class="first"><b>42</b> hours</li>
			<li class="second"><b>31</b> lessons</li>
			<li class="third"><b>Medium</b> level</li>
		</ul> -->
	</div>		
</section>
		<?php
endwhile;
}
get_footer(); ?>
