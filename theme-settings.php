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
		  '#title' => 'Color',
		  '#default_value' => theme_get_setting('test_color'),
    );
        
     $form['options']['general']['image_1'] = array(
		  '#title' => t('Image'),
		  '#type' => 'managed_file',
		  '#description' => t('The uploaded image will be displayed on this page using the image style choosen below.'),
		  '#default_value' => theme_get_setting('image_1'),
		  '#upload_location' => 'public://image_example_images/',
    );
    
       $form['options']['general']['image_2'] = array(
		  '#title' => t('Image'),
		  '#type' => 'managed_file',
		  '#description' => t('The uploaded image will be displayed on this page using the image style choosen below.'),
		  '#default_value' => theme_get_setting('image_2'),
		  '#upload_location' => 'public://image_example_images/',
    );
    
       $form['options']['general']['image_3'] = array(
		  '#title' => t('Image'),
		  '#type' => 'managed_file',
		  '#description' => t('The uploaded image will be displayed on this page using the image style choosen below.'),
		  '#default_value' => theme_get_setting('image_3'),
		  '#upload_location' => 'public://image_example_images/',
    );
  
    // Breadcrumbs
    $form['options']['general']['breadcrumbs'] = array(
      '#type' => 'checkbox',
      '#title' => 'Breadcrumbs',
      '#default_value' => theme_get_setting('breadcrumbs'),
    );
    
    // Scroll Menu
    $form['options']['general']['scroll_menu'] = array(
      '#type' => 'checkbox',
      '#title' => 'Scroll Menu',
      '#default_value' => theme_get_setting('scroll_menu'),
    );
        
    // SEO
    $form['options']['general']['seo'] = array(
      '#type' => 'fieldset',
      '#title' => '<div class="plus"></div><h3 class="options_heading">SEO</h3>',
    );
    
      // SEO Title
      $form['options']['general']['seo']['seo_title'] = array(
        '#type' => 'textfield',
        '#title' => 'Title',
        '#default_value' => theme_get_setting('seo_title'),
      );
      
       // SEO Description
      $form['options']['general']['seo']['seo_description'] = array(
        '#type' => 'textarea',
        '#title' => 'Description',
        '#default_value' => theme_get_setting('seo_description'),
      );
      
       // SEO Keywords
      $form['options']['general']['seo']['seo_keywords'] = array(
        '#type' => 'textarea',
        '#title' => 'Keywords',
        '#default_value' => theme_get_setting('seo_keywords'),
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