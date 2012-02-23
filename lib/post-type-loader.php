<?php 

/*
* @package eig
*/ 

register_post_type('eig_image',array( 
		'labels'    => eig_make_post_type_labels('image','images'),
		'public'    => true,
		'hierarchical'  => false, // Like Cats
		'show_ui'   => true,
		'rewrite'   => array('slug' => 'image'),
		'query_var' => 'image', 
		 'has_archive' => 'images',
		'supports'  => array(
			'title',
			'editor',
			'custom-fields',
			'comments',
			'thumbnail'
		),
	));

	register_taxonomy('eig_image_type', 'eig_image', array(
			'hierarchical'  => true, // Like Tags
			'labels'        => eig_make_post_type_labels('image Type', 'image Types'),
			'query_var'     => 'image_type',
			'rewrite'       => array('slug' => 'image-type' ),
			)
		); 
/* set up our function to make post type lables thanks @Mike Schinkel*/
function eig_make_post_type_labels($singular,$plural=false,$args=array()) {
	if ($plural===false)			$plural = $singular . 's'; 
	elseif ($plural===true)			$plural = $singular;
	$defaults = array(
		'name'			  	=>_x($plural,'post type general name'),
		'singular_name'		  	=>_x($singular,'post type singular name'), 
		'add_new'		  	=>_x('Add New',$singular),
		'add_new_item'		  	=>__("Add New $singular"),
		'edit_item'		  	=>__("Edit $singular"),
		'new_item'		  	=>__("New $singular"),
		'view_item'		  	=>__("View $singular"), 
		'search_items'		  	=>__("Search $plural"),
		'not_found'		  	=>__("No $plural Found"),
		'not_found_in_trash'		=>__("No $plural Found in Trash"),
		'parent_item_colon' 		=>'',
	); 
	return wp_parse_args($args,$defaults);

} // end make_post_type_lables
