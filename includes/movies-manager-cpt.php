<?php
//function of custom post type
if(!function_exists('mm_movies_custom_post_type')){
	function mm_movies_custom_post_type(){
		$labels = array(
			'name' =>  __('Movies','mm'),
			'singular_name' => __('Movie','mm'),
			'add_new' => __('Add New Movies','mm'),
			'all_items'=>  __('All','mm'),
		);
		$args = array(
			 'labels' => $labels,
			 'public' =>  true,
			 'show_ui'=> true,
			 'menu_icon' =>'dashicons-format-chat',
			 'supports' => array('title','editor','thumbnail'),
		);
		register_post_type('movie',$args);
	}
}
