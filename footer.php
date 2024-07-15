</div><!--End Sticky Footer-->

<?php if (!is_404()) : ?>
  <footer class="site-footer">
    <?php get_template_part('template-parts/footer/inc', 'multi-column'); ?>
  </footer>

<?php
endif;

get_template_part('template-parts/header/inc','menu-mobile');

wp_footer();
?>

</body>
</html>
