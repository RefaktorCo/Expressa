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
    '#title' => t('General'),
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
    '#title' => t('Layout'),
  );
  
  // Background
    $form['options']['layout']['background'] = array(
      '#type' => 'fieldset',
      '#title' => '<div class="plus"></div><h3 class="options_heading">Background</h3>',
    );
    
      // Background Color
      $form['options']['layout']['background']['body_background_color'] =array(
        '#type' => 'jquery_colorpicker',
		    '#title' => t('Body Background Color'),
		    '#default_value' => theme_get_setting('body_background_color'),
      );    
      
     // Enable background pattern
      $form['options']['layout']['background']['enable_background_pattern'] = array(
        '#type' => 'checkbox',
        '#title' => 'Enable background pattern',
        '#default_value' => theme_get_setting('enable_background_pattern'),
      );
    
      // Background
    $form['options']['layout']['background']['background_select'] = array(
      '#type' => 'radios',
      '#title' => 'Select a background pattern:',
      '#default_value' => theme_get_setting('background_select'),
      '#options' => array(
        'retina_wood' => 'item',
        'debut_dark' => 'item',
        'noisy_grid' => 'item',
        'dark_wood' => 'item',
        'cartographer' => 'item',
        'bedge' => 'item',
        'illusion' => 'item',
        'nistri' => 'item',
      ),
      
      '#states' => array (
          'invisible' => array(
            'input[name="enable_background_pattern"]' => array('checked' => FALSE)
          )
        )

    );  
  
  
  // Color
  $form['options']['color'] = array(
    '#type' => 'fieldset',
    '#title' => t('Color'),
  );  
  
  // Colors
    $form['options']['color']['colors'] = array(
      '#type' => 'fieldset',
      '#title' => '<div class="plus"></div><h3 class="options_heading">Color Scheme</h3>',
    );
  
      // Color Scheme
      $form['options']['color']['colors']['color_scheme'] = array(
        '#type' => 'select',
        '#title' => 'Color Scheme',
        '#default_value' => theme_get_setting('color_scheme'),
        '#options' => array(
          'black' => t('Black'),
          'blue' => t('Blue (default)'),
          'teal' => t('Teal'),
          'green' => t('Green'),
          'yellow' => t('Yellow'),
          'purple' => t('Purple'),
          'orange' => t('Orange'),
          'red' => t('Red'),
          'custom' => t('Custom'),
        ),
      );
      
      $form['options']['color']['colors']['custom_color'] = array(
		    '#type' => 'jquery_colorpicker',
		    '#title' => t('Color'),
		    '#default_value' => theme_get_setting('custom_color'),
		    '#states' => array (
          'visible' => array(
            'select[name=color_scheme]' => array('value' => 'custom')
          )
        )
      );
      
  // Typography
  $form['options']['typography'] = array(
    '#type' => 'fieldset',
    '#title' => 'Typography',
  ); 
  
    //Headings
    $form['options']['typography']['headings'] = array(
      '#type' => 'fieldset',
      '#title' => '<div class="plus"></div><h3 class="options_heading">Headings</h3>',
    );
        
      //H1
      $form['options']['typography']['headings']['h1'] =array(
        '#type' => 'textfield',
        '#title' => t('h1 Size'),
        '#default_value' => theme_get_setting('h1'),
      );
      
      //H2
      $form['options']['typography']['headings']['h2'] =array(
        '#type' => 'textfield',
        '#title' => t('h2 Size'),
        '#default_value' => theme_get_setting('h2'),
      );
      
      //H3
      $form['options']['typography']['headings']['h3'] =array(
        '#type' => 'textfield',
        '#title' => t('h3 Size'),
        '#default_value' => theme_get_setting('h3'),
      );
      
      //H4
      $form['options']['typography']['headings']['h4'] =array(
        '#type' => 'textfield',
        '#title' => t('h4 Size'),
        '#default_value' => theme_get_setting('h4'),
      );
      
      //H5
      $form['options']['typography']['headings']['h5'] =array(
        '#type' => 'textfield',
        '#title' => t('h5 Size'),
        '#default_value' => theme_get_setting('h5'),
      );
      
      //H6
      $form['options']['typography']['headings']['h6'] =array(
        '#type' => 'textfield',
        '#title' => t('h6 Size'),
        '#default_value' => theme_get_setting('h6'),
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
}

?>