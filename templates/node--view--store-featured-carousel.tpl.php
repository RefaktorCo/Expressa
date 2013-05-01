<li>
  <div class="store-item">
  
	  <div class="store-item-picture">
	    <?php print render($content['product:field_image']); ?>
	  </div>
  
	  <div class="store-item-content">
	    <a href="<?php print $node_url; ?>"><?php echo $title; ?></a>
	  
	    <div class="clearfix"></div>
	  	<?php print render($content['product:commerce_price']); ?>
	   	
	   	<div class="clearfix"></div>
	    <?php print render($content['field_reference']); ?>
	  </div>
	  
  </div> 
</li>