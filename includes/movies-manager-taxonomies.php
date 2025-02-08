<?php
//-Director -Producer Genre (Herarichal)
if(!function_exists('mm_movies_taxonomies')){
	function mm_movies_taxonomies(){
		
		$labels = array(
			'name'              => 		_x('Director','taxonomy general name', 'textdomain'),
			'singular_name'     => 		_x('Director','taxonomy singular name', 'textdomain'),
			'search_items'      => 		__('Search Director','textdomain'),
			'all_items'         => 		__('All Director','textdomain'),
			'parent_item'       => 		__('Parent Director','textdomain'),
			'parent_item_colon' =>		__('Parent Director:','textdomain'),
			'edit_item'         => 		__('Edit Director','textdomain'),
			'update_item'       => 		__('Update Director','textdomain'),
			'add_new_item'      => 		__('Add New Director','textdomain'),
			'new_item_name'     => 		__('New Director Name','textdomain'),
			'menu_name'         =>	 	__('Director','textdomain'),
		);

		$args = array(
			'hierarchical'  	=> 		true,
			'labels'        	=> 		$labels,
			'show_ui'           => 		true,
			'show_admin_column' => 		true,
			'query_var'         => 		true,
			'rewrite'           => 		array( 'slug' => 'director' ),

		);
		register_taxonomy( 'director', array( 'movie' ), $args );
		unset( $args );
		unset( $labels );



		$labels = array(
			'name' => _x('Producer','taxonomy general name', 'textdomain'),
			'singular_name' => _x('Producer','taxonomy singular name', 'textdomain'),
			'search_items' => __('Search Producer','textdomain'),
			'all_items' => __('All Producer','textdomain'),
			'parent_item' => __('Parent Producer','textdomain'),
			'parent_item_colon'=>__('Parent Producer:','textdomain'),
			'edit_item' => __('Edit Producer','textdomain'),
			'update_item'=> __('Update Producer','textdomain'),
			'add_new_item'=> __('Add New Producer','textdomain'),
			'new_item_name' => __('New Producer Name','textdomain'),
			'menu_name' => __('Producer','textdomain'),
		);

		$args = array(
			'hierarchical'  	=> 		true,
			'labels'        	=> 		$labels,
			'show_ui'           => 		true,
			'show_admin_column' => 		true,
			'query_var'         => 		true,
			'rewrite'           => 		array( 'slug' => 'producer' ),

		);
		register_taxonomy( 'producer', array( 'movie' ), $args );
		unset( $args );
		unset( $labels );


		// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Joner', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Joner', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Joner', 'textdomain' ),
		'popular_items'              => __( 'Popular Joner', 'textdomain' ),
		'all_items'                  => __( 'All Joner', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Joner', 'textdomain' ),
		'update_item'                => __( 'Update Joner', 'textdomain' ),
		'add_new_item'               => __( 'Add New Joner', 'textdomain' ),
		'new_item_name'              => __( 'New Joner Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate joner with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove joner', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used joner', 'textdomain' ),
		'not_found'                  => __( 'No joner found.', 'textdomain' ),
		'menu_name'                  => __( 'Joner', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'joner' ),
	);

	register_taxonomy( 'joner', 'movie', $args );
	}

}

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'mm_movies_taxonomies', 0 );