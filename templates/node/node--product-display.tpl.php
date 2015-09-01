<?php
/**
 * @file
 * Expressa's node template for the Product Display content type.
 */

?>
<?php if ($teaser): ?>
<div class="span3">
  <div class="store-item">
	  <div class="store--item-picture">
	    <?php print render($content['field_main_image']); ?>
	  </div>
	  
	  <div class="store-item-content">
	    <a href="<?php print $node_url; ?>"><?php echo $title; ?></a>
	  
	    <div class="clearfix"></div>
	    <div class="store-item-price-rating">
	    <div style="float:left;">
	      <?php print render($content['product:commerce_price']); ?>
	    </div>
	    <div style="float: right;">
	      <?php print render($content['field_rating']); ?>
	    </div>
	    </div>
	    <div class="clearfix"></div>
	    <?php print render($content['field_reference']); ?>
	  </div>
  </div>
</div>
<?php endif; ?>

<?php if (!$teaser): ?>
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
			
			<div class="product-display-content">  
			  <?php hide($content['comments']); hide($content['field_main_image']); print render($content); ?>
			</div> 
	     
			</div>
	  </div>
  </div>
	
	<?php  print render($content['comments']); ?>  

</article>
<?php endif; ?>