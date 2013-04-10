<li>
  <div class="portfolio-item"> 
    <figure>
      <a class="enlarge" href="<?php echo file_create_url($node->field_portfolio_image['und'][0]['uri']); ?>" rel="prettyPhoto" title="<?php print $title; ?>"><?php print render($content['field_portfolio_image']); ?></a>
    </figure>
  </div>  
  <div class="carousel_item_description">
    <h3><a href="<?php print $node_url;?>"><?php print $title; ?></a></h3>
  </div>  
</li>