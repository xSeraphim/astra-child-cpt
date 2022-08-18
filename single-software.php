<?php
get_header();
$license = get_field( 'license_validity_days' );
$price   = get_field( 'software_price' )?>
<div class="main-container">
	<h1><?php the_title(); ?></h1>
	<p class="fact"><?php the_content(); ?></p>
	<p class="fact">License validity: <?php echo $license; ?> days</p>
	<p class="fact">Price: <?php echo $price; ?> RON</p>
</div>
<?php
get_footer(); ?>
