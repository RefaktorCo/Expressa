<?php
/**
 * Implements hook_form_system_theme_settings_alter()
 */
function expressa_form_system_theme_settings_alter(&$form, &$form_state) {

drupal_add_js(drupal_get_path('theme', 'expressa') .'/js/theme_settings.js'); 

   // Default path for image
  $bg_path = theme_get_setting('bg_path');
  if (file_uri_scheme($bg_path) == 'public') {
    $bg_path = file_uri_target($bg_path);
  }
  
  // Main settings wrapper
  $form['options'] = array(
    '#type' => 'vertical_tabs',
    '#default_tab' => 'defaults',
    '#weight' => '-10',
    '#attached' => array(
      'css' => array(drupal_get_path('theme', 'expressa') . '/css/theme-settings.css'),
    ),
  );
  
  // General
  $form['options']['general'] = array(
    '#type' => 'fieldset',
    '#title' => 'General',
  );
  
    $form['options']['general']['test_color'] = array(
		  '#type' => 'jquery_colorpicker',
		  '#title' => t('Color'),
		  '#default_value' => theme_get_setting('test_color'),
    );
        
     $form['options']['general']['image_1'] = array(
			  '#title' => t('Image'),
			  '#type' => 'managed_file',
			  '#description' => t('The uploaded image will be displayed on this page using the image style chosen below.'),
			  '#default_value' => theme_get_setting('image_1'),
			  '#upload_location' => 'public://image_example_images/',
			  '#upload_validators' => array(
	        'file_validate_extensions' => array('gif png jpg jpeg'),
	      ),
      );
  
    // Breadcrumbs
    $form['options']['general']['breadcrumbs'] = array(
      '#type' => 'checkbox',
      '#title' => t('Breadcrumbs'),
      '#default_value' => theme_get_setting('breadcrumbs'),
    );
    
    // Scroll Menu
    $form['options']['general']['scroll_menu'] = array(
      '#type' => 'checkbox',
      '#title' => t('Scroll Menu'),
      '#default_value' => theme_get_setting('scroll_menu'),
    );
                  
  // Layout
  $form['options']['layout'] = array(
    '#type' => 'fieldset',
    '#title' => 'Layout',
  );  
  
  // Typography
  $form['options']['typography'] = array(
    '#type' => 'fieldset',
    '#title' => 'Typography',
  ); 
  
  // SEO
  $form['options']['seo'] = array(
    '#type' => 'fieldset',
    '#title' => 'SEO',
  ); 
  
    // SEO Title
    $form['options']['seo']['seo_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => theme_get_setting('seo_title'),
    );
    
     // SEO Description
    $form['options']['seo']['seo_description'] = array(
      '#type' => 'textarea',
      '#title' => t('Description'),
      '#default_value' => theme_get_setting('seo_description'),
    );
    
     // SEO Keywords
    $form['options']['seo']['seo_keywords'] = array(
      '#type' => 'textarea',
      '#title' => t('Keywords'),
      '#default_value' => theme_get_setting('seo_keywords'),
    );
  
   // Tracking
  $form['options']['tracking'] = array(
    '#type' => 'fieldset',
    '#title' => t('Tracking'),
  ); 
  
    // Tracking Code
    $form['options']['tracking']['tracking_code'] = array(
      '#type' => 'textarea',
      '#title' => t('Tracking Code'),
      '#description' => t('Add any tracking code such as Google Analytics.'),
      '#default_value' => theme_get_setting('tracking_code'),
    );

  
  // Submit Button
  // $form['#submit'][] = 'blocks_settings_submit';

}

function expressa_settings_submit($form, &$form_state) {
  // Get the previous value
  $previous = 'public://' . $form['options']['header']['branding']['bg_path']['#default_value'] ;
  
  $file = file_save_upload('bg_upload');
  if ($file) {
    $parts = pathinfo($file->filename);
    $destination = 'public://' . $parts['basename'];
    $file->status = FILE_STATUS_PERMANENT;
    
    if(file_copy($file, $destination, FILE_EXISTS_REPLACE)) {
      $_POST['bg_path'] = $form_state['values']['bg_path'] = $destination;
      if ($destination != $previous) {
        return;
      }
    }
  } else {
    // Avoid error when the form is submitted without specifying a new image
    $_POST['bg_path'] = $form_state['values']['bg_path'] = $previous;
  }
  
}


?>