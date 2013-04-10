<?php
/**
 * @file
 * Expressa's theme implementation to display a single Drupal node.
 */
 
$next = expressa_pagination($node, 'n');
$prev = expressa_pagination($node, 'p');

if ($next != NULL) { 
  $next_url = url('node/' . $next, array('absolute' => TRUE));
}

if ($prev != NULL) { 
  $prev_url = url('node/' . $prev, array('absolute' => TRUE));
}

?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
<div class="row">
  <div class="span12">
    <?php print render($title_prefix); ?>
      <h2 class="node-title"<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php print render($title_suffix); ?>
  </div>
</div>
<div class="row">
  <div class="span8">

  <div class="flexslider">
    <ul class="slides">
    <?php print render($content['field_portfolio_slider']); ?>
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
  
      hide($content['field_portfolio_image']);
      hide($content['field_tags']);
      print render($content);
      
    ?>
    
    <?php if($page && module_exists('prev_next')): ?>
    <ul>
      <?php if ($prev != NULL): ?>
        <li><a href="<?php echo $prev_url; ?>"><i class="icon-circle-arrow-left"></i></a></li>
      <?php endif; ?>
      <?php if ($next != NULL): ?>
        <li><a href="<?php echo $next_url; ?>"><i class="icon-circle-arrow-right"></i></a></li>
      <?php endif; ?>
    </ul>
    <?php endif; ?>
   
  </div>

  </div>
</div>
</article>