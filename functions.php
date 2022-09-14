<?php


function wpr_add_style() {
    wp_enqueue_style('wpr-academy-style', get_stylesheet_directory_uri() . '/style.css');
	
}
add_action('wp_enqueue_scripts', 'wpr_add_style');

function wpr_add_nav_sticky() {
    echo '
    <div class="sticky-nav">
	    <a href="tel:+40743078300" class="cta">Contact US NOW</a>
    </div>';
}
add_action('astra_head_top', 'wpr_add_nav_sticky');

//Engineer CPT
function register_engineer_cpt() {
	$taxargs = array(
		'labels' =>	array(
		'name'              => __( 'Role', '' ),
		'singular_name'     => __( 'Role', '' ),
		'search_items'      => __( 'Search Roles', '' ),
		'all_items'         => __( 'All Roles', '' ),
		'parent_item'       => __( 'Parent Role', '' ),
		'parent_item_colon' => __( 'Parent Role:', '' ),
		'edit_item'         => __( 'Edit Role', '' ),
		'update_item'       => __( 'Update Role', '' ),
		'add_new_item'      => __( 'Add new Role', '' ),
		'new_item_name'     => __( 'New Role', '' ),
		),
		'hierarchical'	=> true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'rewrite' => array(
			'slug' => 'role',
		)

	);
	register_taxonomy('role', array('role'), $taxargs);

	$args = array(
		'label'               => __( 'Engineers', '' ),
		'labels'              => array(
			'name'                  => __( 'Engineers', '' ),
			'singular_name'         => __( 'Engineer', '' ),
			'featured_image'        => __( 'Engineer Image', '' ),
			'set_featured_image'    => __( 'Set Engineer Image', '' ),
			'remove_featured_image' => __( 'Remove Engineer Image', '' ),
			'use_featured_image'    => __( 'Use Engineer Image', '' ),
			'add_new_item'          => 'Add new Engineer',
			'add_new'               => 'Add Engineer',
			'edit_item'             => 'Edit Engineer',
			'view_item'             => 'View Engineer',
			'view_items'            => 'View Engineers',
		),
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'has_archive'         => true,
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'map_meta_cap'        => true,
		'hierarchical'        => true,
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'taxonomies'          => array( 'role' ),
		'menu_position'       => 4,
		'menu_icon'           => 'dashicons-groups',
	);
	register_post_type( 'engineer', $args );

	add_theme_support( 'post-thumbnails', array( 'engineer' ) );

}
add_action( 'init', 'register_engineer_cpt' );

// Software CPT
function register_software_cpt() {
	$taxargs = array(
		'labels' =>	array(
		'name'              => __( 'Country', '' ),
		'singular_name'     => __( 'Country', '' ),
		'search_items'      => __( 'Search Country', '' ),
		'all_items'         => __( 'All Countries', '' ),
		'parent_item'       => __( 'Parent Country', '' ),
		'parent_item_colon' => __( 'Parent Country:', '' ),
		'edit_item'         => __( 'Edit Country', '' ),
		'update_item'       => __( 'Update Country', '' ),
		'add_new_item'      => __( 'Add new Country', '' ),
		'new_item_name'     => __( 'New Country', '' ),
		),
		'hierarchical'	=> true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'rewrite' => array(
			'slug' => 'country',
		)

	);
	register_taxonomy('country', array('country'), $taxargs);

	$args = array(
		'label'               => __( 'Software', '' ),
		'labels'              => array(
			'name'                  => __( 'Software', '' ),
			'singular_name'         => __( 'Software', '' ),
			'featured_image'        => __( 'Software Image', '' ),
			'set_featured_image'    => __( 'Set Software Image', '' ),
			'remove_featured_image' => __( 'Remove Software Image', '' ),
			'use_featured_image'    => __( 'Use Software Image', '' ),
			'add_new_item'          => 'Add new Software',
			'add_new'               => 'Add Software',
			'edit_item'             => 'Edit Software',
			'view_item'             => 'View Software',
			'view_items'            => 'View all Software',
		),
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'has_archive'         => true,
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'map_meta_cap'        => true,
		'hierarchical'        => true,
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'custom-fields' ),
		'taxonomies'          => array( 'country' ),
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-shield',
	);
	register_post_type( 'software', $args );


}
add_action( 'init', 'register_software_cpt' );
// PRODUCT FIELDS CALLBACK
function api_fields_callback($args) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Edit WPR API SETTINGS.', 'wpr' ); ?></p>
	<?php
}

// API SETTINGS
function product_fields_callback($args) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Edit Product Discount SETTINGS.', 'wpr' ); ?></p>
	<?php
}

add_action(
	'admin_init',
	function(){
		register_setting('wpr_academy','wpr_option' );
		// API SECTION AND FIELDS
		add_settings_section(
			'api_fields',
			'API Fields',
			'api_fields_callback',
			'wpr_academy' 
		);
		add_settings_field(
			'wpr_api_token',
			'Api Token',
			'api_field_callback',
			'wpr_academy',
			'api_fields',
			array(
				'label_for'       => 'wpr_api_token',
				'class'           => 'wpr_row',
				'wpr_custom_data' => 'custom',
			)
		);
		add_settings_field(
			'wpr_api_client_id',
			'Api Client ID',
			'api_field_callback',
			'wpr_academy',
			'api_fields',
			array(
				'label_for'       => 'wpr_api_client_id',
				'class'           => 'wpr_row',
				'wpr_custom_data' => 'custom',
			)
		);
		// PRODUCT DISCOUNT SECTION AND FIELDS
		add_settings_section(
			'product_fields_discount',
			'Product Discount Fields',
			'product_fields_callback',
			'wpr_academy' 
		);

		add_settings_field(
			'wpr_software_discount',
			'Software Discount',
			'product_field_callback',
			'wpr_academy',
			'product_fields_discount',
			array(
				'label_for'       => 'wpr_software_discount',
				'class'           => 'wpr_row',
				'wpr_custom_data' => 'custom',
			)
		);

		add_settings_field(
			'wpr_software_discount_period',
			'Discount Period',
			'product_field_callback',
			'wpr_academy',
			'product_fields_discount',
			array(
				'label_for'       => 'wpr_software_discount_period',
				'class'           => 'wpr_row',
				'wpr_custom_data' => 'custom',
			)
		);
	}
);
add_action('admin_menu',function(){
	add_menu_page(
		'API Settings',
		'API Options',
		'manage_options',
		'wpr-api-settings',
		'wpr_api_page_html',
		'dashicons-database',
		65 
	);		
} );

function wpr_api_page_html(){
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	// check if the user have submitted the settings
	// WordPress will add the "settings-updated" $_GET parameter to the url
	if ( isset( $_GET['settings-updated'] ) ) {
		// add settings saved message with the class of "updated"
		add_settings_error( 'wpr_messages', 'wpr_message', __( 'Settings Saved', 'wpr' ), 'updated' );
	}

	// show error/update messages
	settings_errors( 'wpr_messages' );
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			// output security fields for the registered setting "wpr_academy"
			settings_fields( 'wpr_academy' );

			// output setting sections and their fields
			// (sections are registered for "wpr_academy", each field is registered to a specific section)
			do_settings_sections( 'wpr_academy' );
			// output save settings button
			submit_button( 'Save Settings' );
			?>
		</form>
	</div>
	<?php
}
function api_field_callback( $args ) {
	// Get the value of the setting we've registered with register_setting()
	$options = get_option( 'wpr_option' );
	?>
	
<input
		value="<?php echo $options[$args['label_for']]; ?>"
		id="<?php echo esc_attr( $args['label_for'] ); ?>"
		data-custom="<?php echo esc_attr( $args['wpr_custom_data'] ); ?>"
		name="wpr_option[<?php echo esc_attr( $args['label_for'] ); ?>]"
		type="text">
	<?php
}
function product_field_callback( $args ) {
	// Get the value of the setting we've registered with register_setting()
	$options = get_option( 'wpr_option' );
	?>
	
<input
		value="<?php echo $options[$args['label_for']]; ?>"
		id="<?php echo esc_attr( $args['label_for'] ); ?>"
		data-custom="<?php echo esc_attr( $args['wpr_custom_data'] ); ?>"
		name="wpr_option[<?php echo esc_attr( $args['label_for'] ); ?>]"
		type="number">
	<?php
}



// function add_text_after_addtocart() {
	
// 	$product = wc_get_product(get_the_ID());
// 	$product_price = intval($product->get_price());
// 	if (50 > $product_price) {
// 		echo '<p>E mai mic!</p>';
// 	}
	
// }

// add_action('woocommerce_after_add_to_cart_form', 'add_text_after_addtocart');
// add_action('woocommerce_after_shop_loop_item_title', 'add_text_after_addtocart', 11);


// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
// add_action('woocommerce_single_product_summary', function(){
// 	echo 'title';
// }, 5);
// add_action('wpr_single_product_title', function(){
// 	echo 'Avion !';


// });
function modal() { 
	wp_enqueue_script('wpr-academy-script', get_stylesheet_directory_uri() . '/assets/quickview.js', array('jquery'), '1.0.0', true);
	wp_localize_script(
		'wpr-academy-script',
		'WPR',
		array(
			'ajax_url'   => admin_url( 'admin-ajax.php' ),
			'ajax_nonce' => wp_create_nonce( 'wpr-academy-script' ),
		)
	);
	
	?>
	

	<div id="myModal" class="modal">
	<div class="modal-content">
	  <div class="modal-header">
		<span class="close">&times;</span>
		<h2>Quick View Product</h2>
	  </div>
	  <div class="modal-body" id="modal-body">
	  </div>
	  <div class="modal-footer">
		<h3>Modal Footer</h3>
	  </div>
	</div>
  
  </div>

<?php
}



function show_product() { 
	global $product;
	// error_log(print_r($product, true));
	$product_id = $_GET['item']; 
	$product = wc_get_product( $product_id );
	
	// error_log(print_r($product, true));

	// $product = wc_get_product( $product_id );
	$url = $product->get_permalink();
	$type = $product->get_type();
	
	if ($product->is_type('variable')) {
		ob_start();
		woocommerce_variable_add_to_cart();
		$my_var = ob_get_clean();
	}else {
		ob_start();
		woocommerce_simple_add_to_cart();
		$my_var = ob_get_clean();
	}

	$content = array(
		'title' =>$product->get_name(),
		'price' => $product->get_price_html(),
		'image' => $product->get_image(),
		'short_description' => $product->get_short_description(),
		'url' => $product->get_permalink(),
		'summary' => $my_var,
		'categories' => $product->get_categories(),
		
		
	);

	echo wp_json_encode( $content );
	wp_die();
	
}
// LOAD THE MODAL ON BOTTOM OF THE PAGE AND DISPLAY NONE
add_action('woocommerce_after_main_content', 'modal');
add_action('wp_ajax_show_product', 'show_product');
add_action( 'wp_ajax_nopriv_show_product', 'show_product' );



// ADD CUSTOM PRODUCT FIELDS ONLY IF CATEGORY T-SHIRT
function wpr_add_custom_fields() {

	global $product;
	$product_id = $product->get_id();
	$product_cat = wc_get_product_category_list($product_id);
	$goodCategory = '/product-category/t-shirt';
	if (strpos($product_cat, $goodCategory)) {
		ob_start(); ?>
		
		<div class="wpr-custom-fields">

				<p>Please select option where to print</p>
				<select id="select" class="wpr-custom-field" name="wpr_data">
					<option selected="selected"  value="none">None</option>
					<option value="fata">Fata</option>
					<option value="spate">Spate</option>
					<option value="fata-spate">Fata+Spate</option>
					<option value="nepersonalizat">Nepersonalizat</option>
				</select>
					<div id="input">
					<p>Please enter text</p>
					<input  type="text" class="wpr-custom-field" maxlength="75" name="wpr_data2"></input>
					</div>
		</div>
		<script type="text/javascript">
			jQuery("select").click(function() {
			var selectBox = document.getElementById("select");
			var input = document.getElementById("input");
			var selectedValue = selectBox.value;
			
			if (selectedValue=="none"){
				input.style.display = "none";
			}else {
			input.style.display = "block";
			}
		});
		</script>
	<?php
	$content = ob_get_contents();
    ob_end_flush();

    return $content;
	}
	// var_dump($product_cat);
}
add_action('woocommerce_before_add_to_cart_button', 'wpr_add_custom_fields');


// ADD ENTERED DATA INTO WOOCOMMERCE
function wpr_add_item_data($cart_item_data, $product_id, $variation_id) {
	if(isset($_REQUEST['wpr_data']))
    {
        $cart_item_data['wpr_data'] = sanitize_text_field($_REQUEST['wpr_data']);
    }
	if(isset($_REQUEST['wpr_data2']))
    {
		$cart_item_data['wpr_data2'] = sanitize_text_field($_REQUEST['wpr_data2']);
    }

    return $cart_item_data;
}
add_filter('woocommerce_add_cart_item_data','wpr_add_item_data',10,3);

// CHANGE THE GOD DAMN PRICE
function value_based_pricing( $cart ) {

    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) 
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ) 
        return;

    // Define the variables
    $fata = 'fata';
	$spate = 'spate';
	$fata_spate = 'fata-spate';

    // Loop through cart items
    foreach( $cart->get_cart() as $cart_item_key => $cart_item ) {
        // Get the product price
        $price = $cart_item['data']->get_price();
		

        // Check if  variables are present and change the price
        if( $cart_item['wpr_data'] == $fata || $cart_item['wpr_data'] == $spate) {
            $bulk_price = $price + 50;
            $cart_item['data']->set_price( $bulk_price );
        }
		if( $cart_item['wpr_data'] == $fata_spate) {
            $bulk_price = $price + 85;
            $cart_item['data']->set_price( $bulk_price );
        }
    }
}
add_action('woocommerce_before_calculate_totals', 'value_based_pricing', 99);
// ADD DETAILS AS META

function wpr_add_item_meta($item_data, $cart_item){

	if(array_key_exists('wpr_data', $cart_item))
    {
        $custom_details = $cart_item['wpr_data'];

        $item_data[] = array(
            'key'   => 'Where to print',
            'value' => $custom_details
        );
	}
	if(array_key_exists('wpr_data2', $cart_item))
	{
		$custom_details = $cart_item['wpr_data2'];
	
		$item_data[] = array(
			'key'   => 'Your custom text',
			'value' => $custom_details
		);
    }

    return $item_data;
}
add_filter('woocommerce_get_item_data','wpr_add_item_meta',10,2);

// ADD TO THE ORDER LINE
function wpr_add_custom_order_line_item_meta($item, $cart_item_key, $values, $order)
{

    if(array_key_exists('wpr_data', $values))
    {
        $item->add_meta_data('Where to print',$values['wpr_data']);
    }
	if(array_key_exists('wpr_data2', $values))
    {
        $item->add_meta_data('Your Custom text',$values['wpr_data2']);
    }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'wpr_add_custom_order_line_item_meta',10,4 );
