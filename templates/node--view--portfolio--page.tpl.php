  <div class="span3 portfolio-item switch <?php print render($content['field_portfolio_category']); ?>" style="margin-bottom: 20px;">
    <figure>
    <a class="enlarge" href="<?php print $node_url; ?>">
      <?php print render($content['field_portfolio_image']); ?>
    </a>
    </figure>
     <h4 <?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h4>
  </div>