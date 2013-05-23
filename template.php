<?php 
/**
 * Define $root global variable.
 */
global $root, $theme_path;
$root = base_path() . drupal_get_path('theme', 'expressa');

include_once(drupal_get_path('theme', 'expressa').'/includes/switch.php');

/**
 * Assign theme hook suggestions for custom templates.
 */  
function expressa_preprocess_page(&$vars, $hook) {
  if (isset($vars['node'])) {
    $suggest = "page__node__{$vars['node']->type}";
    $vars['theme_hook_suggestions'][] = $suggest;
  }
  
  $status = drupal_get_http_header("status");  
  if($status == "404 Not Found") {      
    $vars['theme_hook_suggestions'][] = 'page__404';
  }
}

function expressa_preprocess_node(&$vars) {
  if (request_path() == 'store') {
    $vars['theme_hook_suggestions'][] = 'node__store';
  }
}

/**
 * Define some variables for use in theme templates.
 */
function expressa_process_page(&$variables) {	
  // Assign site name and slogan toggle theme settings to variables.
  $variables['disable_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['disable_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
   // Assign site name/slogan defaults if there is no value.
  if ($variables['disable_site_name']) {
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['disable_site_slogan']) {
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
}	

/**
 * Preprocess variables for the username.
 */
function expressa_preprocess_username(&$vars) {
  global $theme_key;
  $theme_name = $theme_key;
  
  // Add rel=author for SEO and supporting search engines
  if (isset($vars['link_path'])) {
    $vars['link_attributes']['rel'][] = 'author';
  }
  else {
    $vars['attributes_array']['rel'][] = 'author';
  }
}

/**
 * Add a comma delimiter between several field types.
 */
function expressa_field($variables) {
 
  $output = '';
 
  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</div>';  
  }
  
  if ($variables['element']['#field_name'] == 'field_portfolio_category') {
    // For tags, concatenate into a single, comma-delimitated string.
    foreach ($variables['items'] as $delta => $item) {
      $rendered_tags[] = drupal_render($item);
    }
    $output .= implode(' ',$rendered_tags);
  }
  
  elseif ($variables['element']['#field_name'] == 'field_portfolio_url') {
    // For tags, concatenate into a single, comma-delimitated string.
    foreach ($variables['items'] as $delta => $item) {
      $rendered_tags[] = drupal_render($item);
    }
    $output .= implode(' ',$rendered_tags);
  }
  
  elseif ($variables['element']['#field_name'] == 'field_tags') {
    // For tags, concatenate into a single, comma-delimitated string.
    foreach ($variables['items'] as $delta => $item) {
      $rendered_tags[] = drupal_render($item);
    }
    $output .= implode(', ', $rendered_tags);
  }
     
  else {
    $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
    // Default rendering taken from theme_field().
    foreach ($variables['items'] as $delta => $item) {
      $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
      $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
    }
    $output .= '</div>';
    // Render the top-level DIV.
    $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';
  }
  
  // Render the top-level DIV.
  return $output;
}

/**
* Override breadcrumb because Facet API adds a [all items] in the breadcrumb
*/
function expressa_preprocess_breadcrumb(&$variables) {
  $new_breadcrumb = '';
  
  foreach ($variables['breadcrumb'] as $key => $breadcrumb) {
    $pos = strpos($breadcrumb, '[all items]');
    if ($pos !== false) {
     break;
    }
    $new_breadcrumb[] = $breadcrumb;
  }
  $variables['breadcrumb'] = $new_breadcrumb;
}

/**
 * Put Breadcrumbs in a ul li structure and add descending z-index style to each <a href> tag.
 */
function expressa_breadcrumb($variables) {
 $breadcrumb = $variables['breadcrumb'];
 $title = drupal_get_title();
 $crumbs = '';
 
 if (!empty($breadcrumb)) {
   $crumbs = '<ul class="breadcrumbs">';
   foreach($breadcrumb as $value) {
     $crumbs .= '<li>'.$value.'</li>';
   }
   $crumbs .= '<li><a href="#" class="current">'. $title.'</a></li>';
   $crumbs .= '</ul>';
    
 }
 return $crumbs;
}


/**
 * remove [all items] from the current search block
 */
function expressa_block_view_alter(&$data, $block) {
  if ($block->delta != 'standard' || $block->module != 'current_search') return;
  if ( isset($data['content']['active_items']['#items']) ) {
    foreach($data['content']['active_items']['#items'] as $key => $item) {
      if ($item == '['.t('all items').']') unset($data['content']['active_items']['#items'][$key]);
    }
  }
}

/**
 * Alter the default Drupal search form.
 */  
function expressa_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    $form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
    $form['search_block_form']['#size'] = 40;  // define size of the textfield
    $form['search_block_form']['#default_value'] = t(''); // Set a default value for the textfield
    $form['actions']['submit']['#value'] = t(''); // Change the text on the submit button
   

    // Add extra attributes to the text box
    $form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Search';}";
    $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Search') {this.value = '';}";
    // Prevent user from searching the default text
    $form['#attributes']['onsubmit'] = "if(this.search_block_form.value=='Search'){ alert('Please enter a search'); return false; }";

    // Alternative (HTML5) placeholder attribute instead of using the javascript
    $form['search_block_form']['#attributes']['placeholder'] = t('Search');
  }
} 


function expressa_pagination($node, $mode = 'n') {
  if (!function_exists('prev_next_nid')) {
    return NULL;
  }
 
  switch($mode) {
    case 'p':
      $n_nid = prev_next_nid($node->nid, 'prev');
      $link_text = "Previous post";
    break;
		
    case 'n':
      $n_nid = prev_next_nid($node->nid, 'next');
      $link_text = "Next post";
    break;
		
    default:
    return NULL;
  }
 
  if ($n_nid) {
    $n_node = '';
    $n_node = node_load($n_nid);
		
    switch($n_node->type) {	
      case 'portfolio': 
        $id =  $n_node->nid; 
      return $id; 
      
      case 'article': 
        $html = l($link_text, 'node/'.$n_node->nid); 
      return $html;
    }
  }
}

/**
 * User CSS function. Separate from blocks_preprocess_html so function can be called directly before </head> tag.
 */
function expressa_user_css() {
  echo "<!-- User defined CSS -->";
  echo "<style type='text/css'>";
  echo theme_get_setting('user_css');
  echo "</style>";
  echo "<!-- End user defined CSS -->";	
}

/**
 * Add various META tags to HTML head..
 */
function expressa_preprocess_html(&$vars){
  global $root;
  
  $viewport = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' =>  'width=device-width, initial-scale=1, maximum-scale=1',
    )
  );

  $meta_title = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#weight' => 1,
    '#attributes' => array(
      'name' => 'title',
      'content' => theme_get_setting('seo_title')
    )
  );
  $meta_description = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#weight' => 2,
    '#attributes' => array(
      'name' => 'description',
      'content' => theme_get_setting('seo_description')
    )
  );
  $meta_keywords = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#weight' => 3,
    '#attributes' => array(
      'name' => 'keywords',
      'content' => theme_get_setting('seo_keywords')
    )
  );

  $headings = array(
    '#type' => 'markup',
    '#markup' => "<style type='text/css'>h1 {font-size:" .theme_get_setting('h1')." ;} h2 {font-size:".theme_get_setting('h2').";} h3 {font-size:".theme_get_setting('h3').";} h4 {font-size:".theme_get_setting('h4').";} h5 {font-size:".theme_get_setting('h5').";} h6 {font-size:".theme_get_setting('h6').";}</style> ",
    '#weight' => 4,
  );
  
  $box_layout = array(
    '#type' => 'markup',
    '#markup' => "<style type='text/css'>#content-wrap { max-width: 1200px; margin: 0 auto; margin-top: 20px; padding: 20px 20px 0px 20px; } #footer-wrap {max-width: 1240px;} </style> ",
    '#weight' => 5,
  );
  
  $wide_layout = array(
    '#type' => 'markup',
    '#markup' => "<style type='text/css'>#content-wrap { max-width: 100%; margin: 0 auto; margin-top: 0px; padding: 20px 0px 0px 0px; } #footer-wrap {max-width: 100%; margin-bottom: 0px;}</style> ",
    '#weight' => 6,
  );

  $background_image = array(
    '#type' => 'markup',
    '#markup' => "<style type='text/css'>body {background-image:url(".$root."/images/backgrounds/".theme_get_setting('background_select').".png);}</style> ",
    '#weight' => 7,
  );
  
  $background_color = array(
    '#type' => 'markup',
    '#markup' => "<style type='text/css'>body {background-color: #".theme_get_setting('body_background_color')." !important;}</style> ",
    '#weight' => 8,
  );
  
  $color = array(
    '#tag' => 'link', 
    '#weight' => 9,
    '#attributes' => array( 
      'href' => ''.$root.'/css/colors/'.theme_get_setting('color_scheme').'.css', 
      'rel' => 'stylesheet',
      'type' => 'text/css',
      'media' => 'screen',
    ),
  );
  
  $custom_color = array(
    '#type' => 'markup',
    '#markup' => "<style type='text/css'>.menu-wrap, #menu, #highlight, #scroll-menu, .view-popular-tags a:hover, .store-carousel-navigation a, .portfolio-carousel-navigation a, #menu .menu ul li:hover, .portfolio-project-button, .store-item input[type='submit'], .ei-title h2 {background: #".theme_get_setting('custom_color')." !important;}</style> ",
    '#weight' => 10,
  );
  
  $tracking_code = array(
    '#type' => 'markup',
    '#markup' => "".theme_get_setting('tracking_code')."",
    '#weight' => 11,
  );
  
  if (theme_get_setting('seo_title') != "") {
    drupal_add_html_head( $meta_title, 'meta_title' );
  }
  
   if (theme_get_setting('seo_description') != "") {
    drupal_add_html_head( $meta_description, 'meta_description' );
  }
  
  if (theme_get_setting('seo_keywords') != "") {
    drupal_add_html_head( $meta_keywords, 'meta_keywords' );
  }
  
  if (theme_get_setting('tracking_code') != "") {
    drupal_add_html_head( $tracking_code, 'tracking_code' );
  }
  
  if (theme_get_setting('site_layout') == "boxed") {
    drupal_add_html_head( $box_layout, 'box_layout' );
  }
  
  if (theme_get_setting('site_layout') == "wide") {
    drupal_add_html_head( $wide_layout, 'wide_layout' );
  }
  
  if (theme_get_setting('body_background') == "expressa_backgrounds") {
    drupal_add_html_head( $background_image, 'background_image');
  } 
  
  drupal_add_html_head( $viewport, 'viewport');
  drupal_add_html_head( $headings, 'headings');
  
  if (theme_get_setting('body_background') == "custom_background_color") {
    drupal_add_html_head( $background_color, 'background_color');
  }
  
  drupal_add_html_head( $color, 'color_style' );
  
  if (theme_get_setting('color_scheme') == "custom") {
    drupal_add_html_head( $custom_color, 'custom_color' );
  }

}

?>