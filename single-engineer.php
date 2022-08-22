<?php
get_header();
if ( have_posts() ) {
	while ( have_posts() ) :
		the_post();
		// Best way of calculating Age of the engineer
		$date_of_birth = date_create( get_field( 'date_of_birth' ) );
		// $date_of_birth_year = gmdate( 'Y', strtotime( $date_of_birth ) );
		// $currentyear        = gmdate( 'Y' );
		$today            = date_create( date( 'Ymd' ) );
		$age              = date_diff( $today, $date_of_birth );
		$software_objects = get_field( 'engineer_software' );
		?>
<section class="content">       
	<div class="column-1">
		<img src=<?php echo get_the_post_thumbnail_url(); ?> class="image">
	</div>
	<div class="column-2">
		<h2 class="heading"><?php the_title(); ?></h2>
		<p class="author">Born on: <?php the_field( 'date_of_birth' ); ?></p>
		<p class="author">Age: <?php echo $age->y; ?></p>
		<p class="details"><?php echo get_the_content(); ?></p>
	</div>
	<div class="column-3">
		<?php if ( $software_objects ) : ?>
		<ul>
			<?php foreach ( $software_objects as $software_object ) : ?>
			<li class="second">
				<b><?php echo $software_object->post_title; ?></b>
			</li>
			<?php endforeach; ?> 
		</ul>
		<?php endif; ?>
	</div>
</section>   
		<?php
endwhile;
}
get_footer(); ?>
