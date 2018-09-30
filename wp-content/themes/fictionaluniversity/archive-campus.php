<?php get_header(); ?>

<?php
  page_banner(array(
    'title'     => 'Our Campuses',
    'subtitle'  => 'We have several convenient located campuses',
  ));
?>

<div class="container container--narrow page-section">
  <div class="acf-map">
    <!-- LOOP -->
    <?php while(have_posts()) : the_post(); ?>

      <?php $mapLocation = get_field('map_location'); ?>
      <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo $mapLocation['address']; ?></p>
      </div><!-- class="marker" -->
    <?php endwhile; ?>
  </div><!-- class="acf-map" -->

</div>


<?php get_footer(); ?>
