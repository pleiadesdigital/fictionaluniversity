<?php

if (!is_user_logged_in()) {
  wp_redirect(esc_url(site_url('/')));
  exit;
}

get_header();



?>

<?php while (have_posts()) : the_post(); page_banner(); ?>

  <div class="container container--narrow page-section">

    <div class="create-note">
      <h2 class="headline headline--medium">Create New Note</h2>
      <input class="new-note-title" placeholder="title">
      <textarea class="new-note-body" placeholder="Your note here"></textarea>
      <span class="submit-note">Create Note</span>
      <span class="note-limit-message">Note limit reached: Delete an existing note to make room for a new one.</span>
    </div><!-- class="create-note" -->

    <?php
      $args = array(
        'post_type'       => 'note',
        'posts_per_page'  => -1,
        'author'          => get_current_user_id()
      );
      $userNotes = new WP_Query($args);
    ?>
    <ul class="min-list link-list" id="my-notes">
      <?php while ($userNotes->have_posts()) : $userNotes->the_post(); ?>
        <li data-id="<?php the_ID(); ?>">
          <input readonly class="note-title-field" value="<?php echo str_replace('Private: ', '', esc_attr(get_the_title())); ?>">
          <span class="edit-note"><i class="fa fa-pencil" area-hidden="true"></i> Edit</span>
          <span class="delete-note"><i class="fa fa-trash-o" area-hidden="true"></i> Delete</span>
          <textarea readonly class="note-body-field"><?php echo esc_textarea(get_the_content()); ?></textarea>
          <span class="update-note btn btn--blue btn--small"><i class="fa fa-floppy-o" area-hidden="true"></i> Save</span>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>

<?php endwhile ?>

<?php get_footer(); ?>







149
