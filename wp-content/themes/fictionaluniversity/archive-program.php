<?php get_header(); ?>

<?php
  page_banner(array(
    'title'     => 'All Programs',
    'subtitle'  => 'There is something for everyone. Have a look around!',
  ));
?>

<div class="container container--narrow page-section">
  <ul class="link-list min-list">
  <?php while(have_posts()) : the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
  <?php endwhile; ?>
  </ul>
  <!-- PAGINATION -->
  <?php
    echo paginate_links(array(
      'prev_text'     => __('<< Previo'),
      'next_text'     => __('Siguiente >>'),
      'type'          => 'plain'
    )); ?>
</div>


<?php get_footer(); ?>

