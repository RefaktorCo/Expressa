<?php
/**
 * @file
 * Expressa's theme implementation to display a single Drupal node.
 */
?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
<div class="row">
  <div class="span8">

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2 class="node-title"<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  
    
  <div class="flexslider">
    <ul class="slides">
    <?php print render($content['field_portfolio_image']); ?>
    </ul>
  </div>  


  
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
      hide($content['links']);
      hide($content['field_portfolio_image']);
      hide($content['field_tags']);
      print render($content);
    ?>
  </div>

  </div>
</div>
</article>