<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="product-display-node">
  
  <div class="row">
  
    <div class="span5">
      <div class="product-display-image">
        <?php print render($content['product:field_image']); ?>
      </div>
    </div>
    
    <div class="span4">
    
		  <h3><?php echo $title; ?></h3>  
		    
		  <?php print render($content['body']); ?>  
		  
		  <?php print render($content['product:commerce_price']); ?>  <?php print render($content['field_rating']); ?>
		  
		  <div class="product-display-cart-line">
		  
		  <?php print render($content['field_reference']); ?>		 
    </div>
		  
		 
		  
		   <?php hide($content['comments']); print render($content); ?>

		  
		</div>
  </div>
    </div>
	
	<?php  print render($content['comments']); ?>  

</article>