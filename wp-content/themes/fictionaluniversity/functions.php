<?php

require get_theme_file_path('/inc/like-route.php');
require get_theme_file_path('/inc/search-route.php');

function university_custom_rest() {

	register_rest_field('post', 'authorName', array(
		'get_callback'		=> function() { return get_the_author(); }
	));

	register_rest_field('note', 'userNoteCount', array(
		'get_callback'		=> function() { return count_user_posts(get_current_user_id(), 'note'); }
	));

}
add_action('rest_api_init', 'university_custom_rest');

// Banner Pic
function page_banner($args = NULL) {
	if (!$args['title']) {
		$args['title'] = get_the_title();
	}
	if (!$args['subtitle']) {
		$args['subtitle']	= get_field('page_banner_subtitle');
	}
	if (!$args['photo']) {
		if (get_field('page_banner_background_image')) {
			$args['photo'] = get_field('page_banner_background_image')['sizes']['page-banner'];
		} else {
			$args['photo'] = get_theme_file_uri('/images/ocean.jpg');
		}
	}
?>
	<div class="page-banner">
	 <div class="page-banner__bg-image" style="background-image: url(<?php //echo get_theme_file_uri('images/ocean.jpg'); ?><?php //$pageBannerImage = get_field('page_banner_background_image'); echo $pageBannerImage['sizes']['page-banner']; ?><?php echo $args['photo']; ?>"></div>
	 <div class="page-banner__content container container--narrow">
	 	<pre><?php //var_dump($pageBannerImage); ?></pre>
	   <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
	   <div class="page-banner__intro">
	     <p><?php echo $args['subtitle']; ?></p>
	   </div>
	 </div>
	</div>
<?php
}


function university_files() {
	wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyCgujvjnSmzwf0npSZLw4Gz698VC5kPOPg', NULL, '1.0', true);
	wp_enqueue_script('site-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('main-styles', get_stylesheet_uri(), NULL, microtime());
	//ANCIENT GOOGLE MAPS SCRIPT
	// wp_enqueue_script('pleiades17-googlemaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDjEcnBmAHgm_LfegO9o84NLPAfBLwVjSY', array(), '20161130', true);
	// locate URL for JASON
	wp_localize_script('site-js', 'universityData', array(
		'root_url'			=> get_site_url(),
		'nonce'					=> wp_create_nonce('wp_rest')
	));
}
add_action('wp_enqueue_scripts', 'university_files');


function university_features() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	// add_image_size('professor-landscape', 400, 260, array('left', 'top'));
	add_image_size('professor-landscape', 400, 260, true);
	add_image_size('professor-portrait', 480	, 650, true);
	add_image_size('page-banner', 1500, 350, true);
	/*register_nav_menu('header-menu', 'Header Menu');
	register_nav_menu('footer-menu-one', 'Footer Menu One');
	register_nav_menu('footer-menu-two', 'Footer Menu Two');*/
}
add_action('after_setup_theme', 'university_features');

// CUSTOM POST TYPE

function university_cpts() {

	// CAMPUS POST TYPE
	$labels = array(
		'name'						=> 'Campuses',
		'add_new_item'		=> 'Add New Campus',
		'edit_item'				=> 'Edit Campus',
		'all_items'				=> 'All Campuses',
		'singular_name'		=> 'Campus'
	);
	$args = array(
		'capability_type'	=> 'campus',
		'map_meta_cap'		=> true,
		'supports'				=> array('title', 'editor', 'excerpt'),
		'rewrite'					=> array('slug' => 'campuses'),
		'has_archive'			=> true,
		'public'					=> true,
		'menu_icon'				=> 'dashicons-building',
		'labels'					=> $labels,
	);
	register_post_type('campus', $args);

	// EVENTS POST TYPE
	$labels = array(
		'name'						=> 'Events',
		'add_new_item'		=> 'Add New Event',
		'edit_item'				=> 'Edit Event',
		'all_items'				=> 'All Events',
		'singular_name'		=> 'Event'
	);
	$args = array(
		'capability_type'	=> 'event',
		'map_meta_cap'		=> 'Edit Event',
		'supports'				=> array('title', 'editor', 'excerpt'),
		'rewrite'					=> array('slug' => 'events'),
		'has_archive'			=> true,
		'public'					=> true,
		'menu_icon'				=> 'dashicons-calendar',
		'labels'					=> $labels,
	);
	register_post_type('event', $args);

	// PROGRAMS POST TYPE
	$labels = array(
		'name'						=> 'Programs',
		'add_new_item'		=> 'Add New Program',
		'edit_item'				=> 'Edit Program',
		'all_items'				=> 'All Programs',
		'singular_name'		=> 'Program'
	);
	$args = array(
		'supports'			=> array('title'),
		'rewrite'				=> array('slug' => 'programs'),
		'has_archive'		=> true,
		'public'				=> true,
		'menu_icon'			=> 'dashicons-welcome-learn-more',
		'labels'				=> $labels,
	);
	register_post_type('program', $args);


	// PROFESSORS POST TYPE
	$labels = array(
		'name'						=> 'Professors',
		'add_new_item'		=> 'Add New Professor',
		'edit_item'				=> 'Edit Professor',
		'all_items'				=> 'All Professors',
		'singular_name'		=> 'Professor'
	);
	$args = array(
		'show_in_rest'	=> true,
		'supports'			=> array('title', 'editor', 'thumbnail'),
		'has_archive'		=> false,
		'public'				=> true,
		'menu_icon'			=> 'dashicons-nametag',
		'labels'				=> $labels,
	);
	register_post_type('professor', $args);

	// NOTE POST TYPE
 	$labels = array(
		'name'						=> 'Notes',
		'add_new_item'		=> 'Add New Note',
		'edit_item'				=> 'Edit Note',
		'all_items'				=> 'All Notes',
		'singular_name'		=> 'Note'
	);
	$args = array(
		'capability_type'	=> 'note',
		'map_meta_cap'		=> true,
		'show_in_rest'		=> true,
		'supports'				=> array('title', 'editor'),
		'public'					=> false,
		'show_ui'					=> true,
		'menu_icon'				=> 'dashicons-welcome-write-blog',
		'labels'					=> $labels,
	);
	register_post_type('note', $args);

	// LIKE POST TYPE
 	$labels = array(
		'name'						=> 'Likes',
		'add_new_item'		=> 'Add New Like',
		'edit_item'				=> 'Edit Like',
		'all_items'				=> 'All Likes',
		'singular_name'		=> 'Like'
	);
	$args = array(
		'supports'				=> array('title'),
		'public'					=> false,
		'show_ui'					=> true,
		'menu_icon'				=> 'dashicons-heart',
		'labels'					=> $labels,
	);
	register_post_type('like', $args);

}
add_action('init', 'university_cpts');

function university_adjust_queries($query) {
	// Manipulating the Campus query
	if (!is_admin() && is_post_type_archive('campus') && $query->is_main_query()) {
		$query->set('posts_per_page', -1);
	}

	// Manipulating the Programs query
	if (!is_admin() && is_post_type_archive('program') && $query->is_main_query()) {
		$query->set('orderby', 'title');
		$query->set('order', 'ASC');
		$query->set('posts_per_page', -1);
	}

	// Manipulating the Events query
	if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
		$today = date('Ymd');
		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array(array(
                'key'             => 'event_date',
                'compare'         => '>=',
                'value'           => $today,
                'type'            => 'numeric'
              	)
            	));
	}
}
add_action('pre_get_posts', 'university_adjust_queries');

// Enabling Google Maps API

function universityMapKey($api) {
	$api['key'] = 'AIzaSyCgujvjnSmzwf0npSZLw4Gz698VC5kPOPg';
	// $api['key'] = 'AIzaSyDjEcnBmAHgm_LfegO9o84NLPAfBLwVjSY';
	return $api;
}
add_filter('acf/fields/google_map/api', 'universityMapKey');

// Redirect subscriber accounts out of admin and onto homepage

function redirectSubsToFrontEnd() {
	$ourCurrentUser = wp_get_current_user();
	if (count($ourCurrentUser->roles) == 1 && $ourCurrentUser->roles[0] == 'subscriber') {
		wp_redirect(site_url('/'));
		exit;
	}
}
add_action('admin_init', 'redirectSubsToFrontEnd');

function noSubsAdminBar() {
	$ourCurrentUser = wp_get_current_user();
	if (count($ourCurrentUser->roles) == 1 && $ourCurrentUser->roles[0] == 'subscriber') {
		show_admin_bar(false);
	}
}
add_action('wp_loaded', 'noSubsAdminBar');

// Customize Login Screen (URL)
function ourHeaderUrl() {
	return esc_url(site_url('/'));
}
add_filter('login_headerurl', 'ourHeaderUrl');


function ourLoginCSS() {
	wp_enqueue_style('login-styles', get_stylesheet_uri(), NULL, microtime());
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}
add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginTitle() {
	return get_bloginfo('name');
}
add_filter('login_headertitle', 'ourLoginTitle');

// Force note posts to be private
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);

function makeNotePrivate($data, $postarr) {

	if ($data['post_type'] == 'note') {
		if (count_user_posts(get_current_user_id(), 'note') > 4 && !$postarr['ID']) {
			die("You have reached your note limit.");
		}

		$data['post_content'] = sanitize_textarea_field($data['post_content']);
		$data['post_title'] = sanitize_text_field($data['post_title']);
	}

	if ($data['post_type'] == 'note' && $data['post_status'] != 'trash') {
		$data['post_status'] = 'private';
	}
	return $data;
}
