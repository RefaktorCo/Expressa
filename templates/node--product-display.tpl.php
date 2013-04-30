<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  
  <div class="row">
    <div class="span5">

  <a href="<?php print $node_url; ?>"><?php echo $title; ?></a>

  <?php print render($content['product:field_image']); ?>
  
    </div>
    <div class="span4">
  
  <?php print render($content['product:commerce_price']); ?>
  
  <?php print render($content['field_reference']); ?>
  
  <?php print render($content); ?>
    </div>

</article>