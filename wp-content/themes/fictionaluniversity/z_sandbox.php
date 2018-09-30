<?php
/*   function myFirstFunction() {
    echo "<p>Hello, this is my first function!</p>";
  }
  myFirstFunction();
  myFirstFunction();
  myFirstFunction(); */

/*  function greet($name, $color) {
    echo "<p>Hi, my name is $name, and my favorite color is $color.</p>";
  }

  greet("John", "blue");
  greet("Jane", "yellow");*/
?>

<!-- <h1><?php bloginfo('name'); ?></h1>
<p><?php bloginfo('description'); ?></p> -->

<?php

/*$myName = "Brad";
$names = array('Brad', 'Rony', 'Jane', 'Scarlett');*/

?>
<!-- <p>Hi my name is <?php //echo $myName; ?></p> -->
<!-- <p>Hi, my name is <?php //echo $names[0]; ?></p> -->

<?php
/*	$count = 1;
	while ($count <= 100) {
		echo "<ul><li>" . $count . "</li></ul>";
		$count++;
	}*/

/*	$count = 0;
	while($count < count($names)) {
		echo "<p>Hi, my name is " . $names[$count] . "</p>";
		$count++;
	}*/

?>


<?php get_header(); ?>

<?php while(have_posts()) : the_post(); ?>
  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  <?php the_content(); ?>
  <hr>

<?php endwhile; ?>

<?php get_footer(); ?>


<!DOCTYPE html>
<html>
<head>
  <title></title>
  <?php wp_head(); ?>
</head>
<body>
  <header>
    <h1><?php bloginfo('the_title'); ?></h1>
  </header>




    <footer>
      <p>Greetings from the Footer!</p>
    </footer>

    <?php wp_footer(); ?>
    </body>
  </html>


  <?php get_header(); ?>

  <?php while(have_posts()) : the_post(); ?>
    <h5>THIS IS A PAGE</h5>
    <h2><?php the_title(); ?></h2>
    <?php the_content(); ?>

  <?php endwhile; ?>

  <?php get_footer(); ?>


  <?php get_header(); ?>

  <?php while(have_posts()) : the_post(); ?>
    <h2><?php the_title(); ?></h2>
    <?php the_content(); ?>

  <?php endwhile; ?>

  <?php get_footer(); ?>


  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


  <!-- Breadcrumb Box -->
  <?php if (condition) : ?>
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="#"><i class="fa fa-home" aria-hidden="true"></i> Back to About Us</a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>
  <?php endif; ?>

<?php

  $labels = array(
    'name'               => __( 'Events', 'fictionaluniversity' ),
    'singular_name'      => __( 'Event', 'fictionaluniversity' ),
    'add_new'            => _x( 'Add New Event', 'fictionaluniversity', 'fictionaluniversity' ),
    'add_new_item'       => __( 'Add New Event', 'fictionaluniversity' ),
    'edit_item'          => __( 'Edit Event', 'fictionaluniversity' ),
    'new_item'           => __( 'New Event', 'fictionaluniversity' ),
    'view_item'          => __( 'View Event', 'fictionaluniversity' ),
    'search_items'       => __( 'Search Events', 'fictionaluniversity' ),
    'not_found'          => __( 'No Events found', 'fictionaluniversity' ),
    'not_found_in_trash' => __( 'No Events found in Trash', 'fictionaluniversity' ),
    'parent_item_colon'  => __( 'Parent Event:', 'fictionaluniversity' ),
    'menu_name'          => __( 'Events', 'fictionaluniversity' )
  );
  $args = array(
    'labels'              => $labels,
    'hierarchical'        => false,
    'description'         => 'description',
    'taxonomies'          => array(),
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => null,
    'menu_icon'           => null,
    'show_in_nav_menus'   => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'has_archive'         => true,
    'query_var'           => true,
    'can_export'          => true,
    'rewrite'             => true,
    'capability_type'     => 'post',
    'supports'            => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'excerpt',
      'custom-fields',
      'trackbacks',
      'comments',
      'revisions',
      'page-attributes',
      'post-formats',
    )
  );

?>

<!-- GOOGLE MAPS GATHER INFO from ACF -->
<?php while(have_posts()) : the_post(); ?>
    <li><a href="<?php the_permalink(); ?>">
      <?php
        the_title();
        $mapLocation = get_field('map_location');
        echo $mapLocation['lat'];
        echo '<br>';
        echo $mapLocation['lng'];
      ?>
    </a></li>
<?php endwhile; ?>





