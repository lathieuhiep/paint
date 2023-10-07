<?php
global $current_user;

$first_name = get_user_meta($current_user->ID, 'first_name');
$last_name = get_user_meta($current_user->ID, 'last_name');
?>

<div class="heading grid-info mb-5">
  <div class="heading__left"></div>

  <div class="heading__right text-center">
    <div class="avatar">
      <?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
    </div>

    <h3 class="name mt-3 mb-0 fw-normal">
      <?php echo esc_html($first_name[0] . ' ' . $last_name[0]) ?>
    </h3>

    <?php if ( !empty( $args['title'] ) ) : ?>
      <h3 class="title mt-3">
        <?php echo esc_html( $args['title'] ); ?>
      </h3>
    <?php endif; ?>
  </div>
</div>
