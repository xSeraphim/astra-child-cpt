<?php
get_header();
$license                  = get_field( 'license_validity_days' );
$price                    = get_field( 'software_price' );
$product_discount_fields  = get_option( 'wpr_option' );
$software_discount_period = $product_discount_fields['wpr_software_discount_period'];
$software_discount_value  = $product_discount_fields['wpr_software_discount'];
$software_date            = get_the_date( 'y-m-d' );
$max_discount_date        = date( 'y-m-d', strtotime( $software_date . ' +' . $software_discount_period . 'days' ) );?>
<div class="main-container">
	<h1><?php the_title(); ?></h1>
	<p class="fact"><?php the_content(); ?></p>
	<p class="fact">License validity: <?php echo $license; ?> days</p>
	<p class="fact">Price: 
	<?php
	if ( $software_date <= $max_discount_date ) {
		$price = $price - $software_discount_value;
		echo $price . ' RON' . '</p>';
	} else {
		echo $price . ' RON' . '</p>';
	}

	// Romaneasca OVER 9000
	$year      = date( 'y-m-d', strtotime( '-25 years' ) );
	$engineers = new WP_Query(
		array(
			'post_type'   => 'engineer',
			'post_status' => 'publish',
			'meta_query'  => array(
				'relation' => 'AND',
				array(
					'key'     => 'engineer_software',
					'value'   => '"' . get_the_ID() . '"',
					'compare' => 'LIKE',
				),
				array(
					'key'     => 'date_of_birth',
					'value'   => $year,
					// Change < with >= for less than 25 years old
					'compare' => '<',
					'type'    => 'DATE',
				),
			),
		)
	);
	if ( $engineers->have_posts() ) {
		?>
	<p class="fact">Engineers that worked on this software and are over 25 years:</p>
	<ul>
		<?php
		while ( $engineers->have_posts() ) {
			$engineers->the_post();
			?>
			<li><?php the_title(); ?><span><?php the_field( 'date_of_birth' ); ?></span></li>
			<?php
		}
		?>
	</ul>
		<?php
	}

	wp_reset_postdata();
	?>
</div>
<?php
get_footer();
