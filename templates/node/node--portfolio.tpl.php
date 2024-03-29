<?php
/**
 * @file
 * Expressa's theme implementation to display a single Drupal node.
 */
global $base_url; 
?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
<div class="row">
  <div class="span6">
    <?php print render($title_prefix); ?>
      <h2 class="node-title"<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php print render($title_suffix); ?>
  </div>
  <div class="portfolio-pagination span6">
  <?php if($page): ?>
    <ul class="portfolio-pagination-links">
      <?php if ( expressa_node_pagination($node, 'p') != NULL ) : ?>
        <li><a href="<?php print url('node/' . expressa_node_pagination($node, 'p'), array('absolute' => TRUE)); ?>"><i class="icon-caret-left"></i></a></li>
      <?php endif; ?>
        <li><a href="<?php echo $base_url; ?>/portfolio"><i class="icon-th"></i></a></li>
      <?php if ( expressa_node_pagination($node, 'n') != NULL ) : ?>
        <li><a href="<?php print url('node/' . expressa_node_pagination($node, 'n'), array('absolute' => TRUE)); ?>"><i class="icon-caret-right"></i></a></li>
      <?php endif; ?>
    </ul>
    <?php endif; ?>
  </div>
</div>  
<div class="row">
  <div class="span8">

	  <?php if (render($content['field_portfolio_slider'])): ?>  
	  <div class="flexslider">
	    <ul class="slides">
	    <?php print render($content['field_portfolio_slider']); ?>
	    </ul>
	  </div>  
	  <?php endif; ?>
	  
	  <?php if($teaser): ?>
	  <div class="read-more"> 
	  	<a class="btn" href="<?php print $node_url;?>">Read More</a>
	  </div>	
	  <?php endif;?>
	
	  </div>
	  <div class="span4">
	  
	  <div class="node-content"<?php print $content_attributes; ?>>
	    <?php
	      // We hide the comments and links now so that we can render them later.
	      hide($content['comments']);
	  
	      hide($content['field_portfolio_image']);
	      hide($content['field_portfolio_url']);
	      hide($content['field_tags']);
	      print render($content);
	      
	    ?>
	    
	    <?php if (render($content['field_portfolio_url'])): ?>  
	    <br /><br />
	    <a class="btn btn-large" href="<?php print render($content['field_portfolio_url']); ?>"><?php print t('Launch Project')?></a>
	    <?php endif; ?>
	    
	  </div>

  </div>
</div>
<div class="row">
  <div class="span12">
  <?php print render($content['comments']); ?>
  </div>
</div>  
</article>