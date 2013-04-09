<?php
/**
 * @file
 * Expressa's theme implementation to display a single Drupal node.
 */
?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2 class="node-title"<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  
  <?php if ($display_submitted): ?>
    <div class="submitted">
      Posted by <?php print $name; ?> on <?php print format_date($node->created, 'custom', 'M d, Y'); ?>
    </div>
  <?php endif; ?>
  
  <div class="flexslider">
    <ul class="slides">
    <?php print render($content['field_image']); ?>
    </ul>
  </div>  



  <div class="node-content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_image']);
      hide($content['field_tags']);
      print render($content);
    ?>
  </div>
  
  <?php if($teaser): ?>
  <div class="read-more"> 
  	<a class="btn" href="<?php print $node_url;?>"><?php echo t('Read More'); ?></a>
  </div>	
  <?php endif;?>
  
  <?php if($page && module_exists('prev_next')): ?>
  <ul>
    <li><?php print expressa_pagination($node, 'n'); ?></li>
    <li><?php print expressa_pagination($node, 'p'); ?></li>	
  </ul>
  <?php endif; ?>
  
  <?php if (render($content['field_tags'])): ?>  
  <div class="tags"><i class="icon-tags"></i><?php print render($content['field_tags']); ?></div>
  <?php endif; ?>
  
  <div class="comments-meta"><i class="icon-comment"></i> <a href="<?php print $node_url;?>/#comments"><?php print $comment_count; ?> comment<?php if ($comment_count != '1') { echo "s"; } ?></a></div>
  

  <?php print render($content['comments']); ?>

</article>
<hr class="post-hr">