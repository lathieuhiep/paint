<?php
$idProduct = $args['idProduct'] ?? '';
$productDetail = get_post($idProduct);
?>
<div class="info-product">
  <?php echo wpautop($productDetail->post_content) ?>
</div>