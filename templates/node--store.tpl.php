<div class="span3 store-item">
  <a href="<?php print $node_url; ?>"><?php echo $title; ?></a>

  <?php print render($content['product:field_image']); ?>

  <?php print render($content['product:commerce_price']); ?>
  
  <?php print render($content['field_reference']); ?>

</div>