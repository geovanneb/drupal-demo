<?php
use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\ThemeSettingsForm;
use Drupal\file\Entity\File;
use Drupal\Core\Url;

function epros_form_system_theme_settings_alter(&$form, \Drupal\Core\Form\FormStateInterface &$form_state) {
    
    $form['settings'] = array(
        '#type' => 'details',
        '#title' => t('Theme settings'),
        '#open' => TRUE,
    );
    $form['settings']['wrap_direction'] = array(
        '#type' => 'details',
        '#title' => t('Direction'),
        '#open' => FALSE,
    );
    $form['settings']['wrap_direction']['direction'] = array(
      '#type' => 'select',
      '#options' => array(
        'ltr' => t('LTR (Default)'),
        'rtl' => t('RTL'),
        ),
      '#required' => FALSE,
      '#title' => t('Direction'),
      '#default_value' => theme_get_setting('direction', 'epros'),
    );
    $form['settings']['wrap_direction']['direction_demo'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable direction demo'),
      '#description' => t('Use <em>?direction=ltr or ?direction=rtl</em> on URL'),
      '#default_value' => theme_get_setting('direction_demo', 'epros'),
    );
    $form['settings']['header'] = array(
        '#type' => 'details',
        '#title' => t('Header settings'),
        '#open' => FALSE,
    ); 
    $form['settings']['header']['header_logo'] = array(
        '#type' => 'details',
        '#title' => t('Header logo'),
        '#open' => FALSE,
    );
    $form['settings']['header']['header_style'] = array(
      '#type' => 'select',
      '#options' => array(
        'style1' => t('Style 1 (Default)'),
        'style2' => t('Style 2'),
        'style3' => t('Style 3'),
        'style4' => t('Style 4'),
        'style5' => t('Style 5'),
        'style6' => t('Style 6'),
        'style7' => t('Style 7'),
        'style8' => t('Style 8'),
        ),
      '#required' => FALSE,
      '#title' => t('Header style'),
      '#default_value' => theme_get_setting('header_style', 'epros'),
    );
    $form['settings']['header']['header_logo']['header_logo_style'] = array(
      '#type' => 'select',
      '#options' => array(
        'font_logo' => t('Font logo'),
        'image_logo' => t('Image logo'),
        ),
      '#required' => FALSE,
      '#title' => t('Header logo style'),
      '#default_value' => theme_get_setting('header_logo_style', 'epros'),
    );

    $form['settings']['header']['header_logo']['text'] = array(
      '#type' => 'textfield',
      '#title' => t('Text'),
      '#default_value' => theme_get_setting('text', 'epros'),
    );
    $form['settings']['header']['header_logo']['header_logo_bg_wp'] = array(
      '#type' => 'details',
      '#title' => t('Header background'),
      '#open' => FALSE,
    );
    $form['settings']['header']['header_logo']['header_logo_bg_wp']['header_logo_image_bg'] = array(
      '#type' => 'textfield',
      '#title' => t('URL of the header background image'),
      '#default_value' => theme_get_setting('header_logo_image_bg'),
      '#description' => t('Enter a URL background image.'),
      '#size' => 40,
      '#maxlength' => 512,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['settings']['header']['header_logo']['header_logo_bg_wp']['header_logo_image_bg_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload header background image'),
      '#size' => 40,
      '#attributes' => array('enctype' => 'multipart/form-data'),
      '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
      '#element_validate' => array('header_logo_image_bg_validate'),
    );
    $form['settings']['header']['header_slogan'] = array(
      '#type' => 'textfield',
      '#title' => t('Header slogan'),
      '#default_value' => theme_get_setting('header_slogan', 'epros'),
    );

    //print_r($form['settings']['header']['second_logo']);
    $form['settings']['general_setting'] = array(
        '#type' => 'details',
        '#title' => t('General Settings'),
        '#open' => FALSE,
    );

    $form['settings']['general_setting']['general_setting_tracking_code'] = array(
        '#type' => 'textarea',
        '#title' => t('Tracking Code'),
        '#default_value' => theme_get_setting('general_setting_tracking_code', 'epros'),
    );
   
  // Blog settings
    $form['settings']['blog'] = array(
      '#type' => 'details',
      '#title' => t('Blog settings'),
      '#open' => FALSE,
    );
    $form['settings']['blog']['blog_listing'] = array(
      '#type' => 'details',
      '#title' => t('Blog listing'),
      '#open' => FALSE,
    );
    $form['settings']['blog']['blog_listing']['blog_layout'] = array(
      '#type' => 'select',
      '#title' => t('Default layout'),
      '#options' => array(
          'standard' => t('Standard'),
          'grid' => t('Grid'),
          'small' => t('Small'),
          'masonry' => t('Masonry'),
      ),
      '#default_value' => theme_get_setting('blog_layout', 'epros'),
    );
    $form['settings']['blog']['blog_listing']['blog_layout_demo'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable blog layout demo'),
      '#description' => t('Use <em>?blog_layout=grid or ?blog_layout=list</em> on URL'),
      '#default_value' => theme_get_setting('blog_layout_demo', 'epros'),
    );
    $form['settings']['blog']['blog_listing']['blog_sidebar'] = array(
      '#type' => 'select',
      '#title' => t('Default sidebar'),
      '#options' => array(
          'left' => t('Left'),
          'right' => t('Right'),
        ),
      '#default_value' => theme_get_setting('blog_sidebar', 'epros'),
    );
   
    $form['settings']['blog']['blog_listing']['bg_wp'] = array(
      '#type' => 'details',
      '#title' => t('Header background'),
      '#open' => FALSE,
    );
    $form['settings']['blog']['blog_listing']['bg_wp']['blog_page_header_bg'] = array(
      '#type' => 'textfield',
      '#title' => t('URL of the header background image'),
      '#default_value' => theme_get_setting('blog_page_header_bg'),
      '#description' => t('Enter a URL background image.'),
      '#size' => 40,
      '#maxlength' => 512,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['settings']['blog']['blog_listing']['bg_wp']['blog_page_header_bg_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload header background image'),
      '#size' => 40,
      '#attributes' => array('enctype' => 'multipart/form-data'),
      '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
      '#element_validate' => array('blog_page_header_bg_validate'),
    );
    $form['settings']['blog']['blog_tags'] = array(
      '#type' => 'details',
      '#title' => t('Blog tags'),
      '#open' => FALSE,
    );
     $form['settings']['blog']['blog_tags']['tag_bg_wp'] = array(
      '#type' => 'details',
      '#title' => t('Header background'),
      '#open' => FALSE,
    );
    $form['settings']['blog']['blog_tags']['tag_bg_wp']['blog_tags_page_header_bg'] = array(
      '#type' => 'textfield',
      '#title' => t('URL of the header background image'),
      '#default_value' => theme_get_setting('blog_tags_page_header_bg'),
      '#description' => t('Enter a URL background image.'),
      '#size' => 40,
      '#maxlength' => 512,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['settings']['blog']['blog_tags']['tag_bg_wp']['blog_tags_page_header_bg_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload header background image'),
      '#size' => 40,
      '#attributes' => array('enctype' => 'multipart/form-data'),
      '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
      '#element_validate' => array('blog_tags_page_header_bg_validate'),
    );
    //shop
    $form['settings']['shop'] = array(
      '#type' => 'details',
      '#title' => t('Shop settings'),
      '#open' => FALSE,
    );
    $form['settings']['shop']['shop_catalog'] = array(
      '#type' => 'details',
      '#title' => t('Shop page'),
      '#open' => FALSE,
    );
    $form['settings']['shop']['shop_catalog']['shop_listing'] = array(
      '#type' => 'details',
      '#title' => t('Shop listing'),
      '#open' => FALSE,
    );
    
    $form['settings']['shop']['shop_catalog']['shop_product'] = array(
      '#type' => 'details',
      '#title' => t('Shop product'),
      '#open' => FALSE,
    );
    
    $form['settings']['shop']['shop_catalog']['shop_product']['shop_sidebar'] = array(
      '#type' => 'select',
      '#title' => t('Default layout sidebar'),
      '#options' => array(
          'left' => t('Left'),
          'right' => t('Right'),
        ),
      '#default_value' => theme_get_setting('shop_sidebar', 'epros'),
    );
    $form['settings']['shop']['shop_catalog']['shop_listing']['shop_listing_sidebar'] = array(
      '#type' => 'select',
      '#title' => t('Default listing sidebar'),
      '#options' => array(
          'none' => t('None'),
          'left' => t('Left'),
          'right' => t('Right'),
        ),
      '#default_value' => theme_get_setting('shop_listing_sidebar', 'epros'),
    );
    $form['settings']['shop']['shop_catalog']['shop_listing']['shop_listing_sidebar_demo'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable shop listing sidebar demo'),
      '#description' => t('Use <em>?shop_listing_sidebar=left or ?shop_listing_sidebar=right</em> on URL'),
      '#default_value' => theme_get_setting('shop_listing_sidebar_demo', 'epros'),
    );
    $form['settings']['shop']['shop_catalog']['shop_listing']['shop_listing_layout'] = array(
      '#type' => 'select',
      '#title' => t('Shop listing layout'),
      '#options' => array(
          'list' => t('List'),
          'grid' => t('Grid'),
        ),
      '#default_value' => theme_get_setting('shop_listing_layout', 'epros'),
    );
    $form['settings']['shop']['shop_catalog']['shop_listing']['shop_listing_demo'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable shop listing demo'),
      '#description' => t('Use <em>?shop_listing_layout=list or ?shop_listing_layout=grid</em> on URL'),
      '#default_value' => theme_get_setting('shop_listing_demo', 'epros'),
    );
    $form['settings']['shop']['shop_catalog']['shop_product']['product_layout'] = array(
      '#type' => 'select',
      '#title' => t('Product layout'),
      '#options' => array(
          'layout1' => t('Layout 1'),
          'layout2' => t('Layout 2'),
          'layout3' => t('Layout 3'),
          'layout4' => t('Layout 4'),
        ),
      '#default_value' => theme_get_setting('product_layout', 'epros'),
    );
    $form['settings']['shop']['shop_catalog']['shop_product']['shop_product_demo'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable shop product layout demo'),
      '#description' => t('Use <em>?product_layout=layout1 or ?product_layout=layout2</em> on URL'),
      '#default_value' => theme_get_setting('shop_product_demo', 'epros'),
    );
    $form['settings']['shop']['shop_catalog']['header_bg'] = array(
      '#type' => 'details',
      '#title' => t('Header background'),
      '#open' => FALSE,
    );
    $form['settings']['shop']['shop_catalog']['header_bg']['shop_page_header_bg'] = array(
      '#type' => 'textfield',
      '#title' => t('URL of the header background image'),
      '#default_value' => theme_get_setting('shop_page_header_bg'),
      '#description' => t('Enter a URL background image.'),
      '#size' => 40,
      '#maxlength' => 512,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['settings']['shop']['shop_catalog']['header_bg']['shop_page_header_bg_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload header background image'),
      '#size' => 40,
      '#attributes' => array('enctype' => 'multipart/form-data'),
      '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
      '#element_validate' => array('shop_page_header_bg_validate'),
    );

    //
    //cart
    $form['settings']['shop']['shop_cart'] = array(
      '#type' => 'details',
      '#title' => t('Cart page'),
      '#open' => FALSE,
    );
    $form['settings']['shop']['shop_cart']['cart_page_header_bg'] = array(
      '#type' => 'textfield',
      '#title' => t('URL of the header background image'),
      '#default_value' => theme_get_setting('cart_page_header_bg'),
      '#description' => t('Enter a URL background image.'),
      '#size' => 40,
      '#maxlength' => 512,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['settings']['shop']['shop_cart']['cart_page_header_bg_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload header background image'),
      '#size' => 40,
      '#attributes' => array('enctype' => 'multipart/form-data'),
      '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
      '#element_validate' => array('cart_page_header_bg_validate'),
    );
    //checkout
    $form['settings']['shop']['shop_checkout'] = array(
      '#type' => 'details',
      '#title' => t('Checkout page'),
      '#open' => FALSE,
    );
    $form['settings']['shop']['shop_checkout']['checkout_page_header_bg'] = array(
      '#type' => 'textfield',
      '#title' => t('URL of the header background image'),
      '#default_value' => theme_get_setting('checkout_page_header_bg'),
      '#description' => t('Enter a URL background image.'),
      '#size' => 40,
      '#maxlength' => 512,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['settings']['shop']['shop_checkout']['checkout_page_header_bg_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload header background image'),
      '#size' => 40,
      '#attributes' => array('enctype' => 'multipart/form-data'),
      '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
      '#element_validate' => array('checkout_page_header_bg_validate'),
    );
    //review order
    $form['settings']['shop']['shop_review'] = array(
      '#type' => 'details',
      '#title' => t('Review order page'),
      '#open' => FALSE,
    );
    $form['settings']['shop']['shop_review']['review_page_header_bg'] = array(
      '#type' => 'textfield',
      '#title' => t('URL of the header background image'),
      '#default_value' => theme_get_setting('review_page_header_bg'),
      '#description' => t('Enter a URL background image.'),
      '#size' => 40,
      '#maxlength' => 512,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['settings']['shop']['shop_review']['review_page_header_bg_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload header background image'),
      '#size' => 40,
      '#attributes' => array('enctype' => 'multipart/form-data'),
      '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
      '#element_validate' => array('review_page_header_bg_validate'),
    );
    //complete
    $form['settings']['shop']['shop_complete'] = array(
      '#type' => 'details',
      '#title' => t('Complete order page'),
      '#open' => FALSE,
    );
    $form['settings']['shop']['shop_complete']['complete_page_header_bg'] = array(
      '#type' => 'textfield',
      '#title' => t('URL of the header background image'),
      '#default_value' => theme_get_setting('complete_page_header_bg'),
      '#description' => t('Enter a URL background image.'),
      '#size' => 40,
      '#maxlength' => 512,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['settings']['shop']['shop_complete']['complete_page_header_bg_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload header background image'),
      '#size' => 40,
      '#attributes' => array('enctype' => 'multipart/form-data'),
      '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
      '#element_validate' => array('complete_page_header_bg_validate'),
    );
    //page contact
    $form['settings']['contact_page'] = array(
      '#type' => 'details',
      '#title' => t('Contact page'),
      '#open' => FALSE,
    );
    $form['settings']['contact_page']['contact_layout'] = array(
      '#type' => 'select',
      '#title' => t('Contac layout'),
      '#options' => array(
          'contact_layout_1' => t('Contact layout 1'),
          'contact_layout_2' => t('Contact layout 2'),
        ),
      '#default_value' => theme_get_setting('contact_layout', 'epros'),
    );
    $form['settings']['contact_page']['contact_layout_demo'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable layout demo'),
      '#description' => t('Use <em>?contact_layout=contact_layout_1 or ?contact_layout=contact_layout_1</em> on URL'),
      '#default_value' => theme_get_setting('contact_layout_demo', 'epros'),
    );
    $form['settings']['contact_page']['contact_page_header_bg'] = array(
      '#type' => 'textfield',
      '#title' => t('URL of the header background image'),
      '#default_value' => theme_get_setting('contact_page_header_bg'),
      '#description' => t('Enter a URL background image.'),
      '#size' => 40,
      '#maxlength' => 512,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['settings']['contact_page']['contact_page_header_bg_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload header background image'),
      '#size' => 40,
      '#attributes' => array('enctype' => 'multipart/form-data'),
      '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
      '#element_validate' => array('contact_page_header_bg_validate'),
    );
    $form['settings']['contact_page']['contact_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => theme_get_setting('contact_title', 'epros'),
    );
    $form['settings']['contact_page']['contact_subtitle'] = array(
      '#type' => 'textfield',
      '#title' => t('Subtitle'),
      '#default_value' => theme_get_setting('contact_subtitle', 'epros'),
    );
    $form['settings']['contact_page']['contact_address'] = array(
      '#type' => 'textfield',
      '#title' => t('Address'),
      '#default_value' => theme_get_setting('contact_address', 'epros'),
    );
    $form['settings']['contact_page']['contact_email'] = array(
      '#type' => 'textfield',
      '#title' => t('Email'),
      '#default_value' => theme_get_setting('contact_email', 'epros'),
    );
    $form['settings']['contact_page']['contact_phone'] = array(
      '#type' => 'textfield',
      '#title' => t('Phone'),
      '#default_value' => theme_get_setting('contact_phone', 'epros'),
    );
    $form['settings']['contact_page']['google'] = array(
      '#type' => 'details',
      '#title' => t('Googlemaps'),
      '#open' => FALSE,
    );
    $form['settings']['contact_page']['google']['googlemaps'] = array(
      '#type' => 'textarea',
      '#title' => t('Address (Googlemaps)'),
      '#description' => t('Location on maps'),
      '#default_value' => theme_get_setting('googlemaps', 'epros'),
    );
    $form['settings']['contact_page']['google']['googlemaps'] = array(
      '#type' => 'textarea',
      '#title' => t('Address (Googlemaps)'),
      '#description' => t('Location on maps'),
      '#default_value' => theme_get_setting('googlemaps', 'epros'),
    );
    //other page
    $form['settings']['other_page'] = array(
      '#type' => 'details',
      '#title' => t('Other pages'),
      '#open' => FALSE,
    );
    $form['settings']['other_page']['other_page_header_bg'] = array(
      '#type' => 'textfield',
      '#title' => t('URL of the header background image'),
      '#default_value' => theme_get_setting('other_page_header_bg'),
      '#description' => t('Enter a URL background image.'),
      '#size' => 40,
      '#maxlength' => 512,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['settings']['other_page']['other_page_header_bg_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload header background image'),
      '#size' => 40,
      '#attributes' => array('enctype' => 'multipart/form-data'),
      '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
      '#element_validate' => array('other_page_header_bg_validate'),
    );
    //footer settings
    $form['settings']['footer'] = array(
      '#type' => 'details',
      '#title' => t('Footer settings'),
      '#open' => FALSE,
    );
    $form['settings']['footer']['footer_image'] = array(
      '#type' => 'details',
      '#title' => t('Footer image'),
      '#open' => FALSE,
    );
    $form['settings']['footer']['footer_image_popup_newslester'] = array(
      '#type' => 'details',
      '#title' => t('Footer image popup newslester'),
      '#open' => FALSE,
    ); 
    $form['settings']['footer']['footer_style'] = array(
      '#type' => 'select',
      '#options' => array(
        'style1' => t('Style 1 (Default)'),
        'style2' => t('Style 2'),
        'style3' => t('Style 3'),
        'style4' => t('Style 4'),
        'style5' => t('Style 5'),
        'style6' => t('Style 6'),
        'style7' => t('Style 7'),
        'style8' => t('Style 8'),
        'style9' => t('Style 9'),
        'style10' => t('Style 10'),
        ),
      '#required' => TRUE,
      '#title' => t('Footer style'),
      '#default_value' => theme_get_setting('footer_style', 'epros'),
    ); 
    $form['settings']['footer']['footer_image']['footer_image_bg'] = array(
      '#type' => 'textfield',
      '#title' => t('URL of the footer background image'),
      '#default_value' => theme_get_setting('footer_image_bg'),
      '#description' => t('Enter a URL background image.'),
      '#size' => 40,
      '#maxlength' => 512,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['settings']['footer']['footer_image']['footer_image_bg_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload footer background image'),
      '#size' => 40,
      '#attributes' => array('enctype' => 'multipart/form-data'),
      '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
      '#element_validate' => array('footer_image_bg_validate')
    );
    $form['settings']['footer']['footer_image_popup_newslester']['footer_image_popup_newslester_bg'] = array(
      '#type' => 'textfield',
      '#title' => t('URL of the footer image popup newslester'),
      '#default_value' => theme_get_setting('footer_image_popup_newslester_bg'),
      '#description' => t('Enter a URL image popup newslester.'),
      '#size' => 40,
      '#maxlength' => 512,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['settings']['footer']['footer_image_popup_newslester']['footer_image_popup_newslester_bg_upload'] = array(
      '#type' => 'file',
      '#title' => t('Upload footer image popup newslester'),
      '#size' => 40,
      '#attributes' => array('enctype' => 'multipart/form-data'),
      '#description' => t('If you don\'t jave direct access to the server, use this field to upload your background image. Uploads limited to .png .gif .jpg .jpeg .apng .svg extensions'),
      '#element_validate' => array('footer_image_popup_newslester_bg_validate')
    );
    $form['settings']['footer']['copyright_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Copyright text'),
      '#default_value' => theme_get_setting('copyright_text', 'epros'),
    );     
}
function blog_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('blog_page_header_bg_upload', $validators, "public://blog_listing", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('blog_page_header_bg', $file_url);
    }
 }
}
function blog_tags_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('blog_tags_page_header_bg_upload', $validators, "public://blog_tags", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('blog_tags_page_header_bg', $file_url);
    }
 }
}
function shop_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('shop_page_header_bg_upload', $validators, "public://shop_listing", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('shop_page_header_bg', $file_url);
    }
 }
}

function cart_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('cart_page_header_bg_upload', $validators, "public://cart_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('cart_page_header_bg', $file_url);
    }
 }
}

function checkout_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('checkout_page_header_bg_upload', $validators, "public://checkout_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('checkout_page_header_bg', $file_url);
    }
 }
}
function review_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('review_page_header_bg_upload', $validators, "public://review_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('review_page_header_bg', $file_url);
    }
 }
}
function complete_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('complete_page_header_bg_upload', $validators, "public://complete_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('complete_page_header_bg', $file_url);
    }
 }
}

function contact_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('contact_page_header_bg_upload', $validators, "public://contact_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('contact_page_header_bg', $file_url);
    }
 }
}
function header_logo_image_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('header_logo_image_bg_upload', $validators, "public://header_logo_image", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('header_logo_image_bg', $file_url);
    }
 }
}
function other_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('other_page_header_bg_upload', $validators, "public://other_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('other_page_header_bg', $file_url);
    }
 }
}
function footer_image_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('footer_image_bg_upload', $validators, "public://footer_image", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('footer_image_bg', $file_url);
    }
 }
}
function footer_image_popup_newslester_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('footer_image_popup_newslester_bg_upload', $validators, "public://footer_image_popup_newslester", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('footer_image_popup_newslester_bg', $file_url);
    }
 }
}
/*function tags_page_header_bg_validate($element, FormStateInterface $form_state) {
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('tags_page_header_bg_upload', $validators, "public://product_tags_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('tags_page_header_bg', $file_url);
    }
 }
}
function blog_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('blog_page_header_bg_upload', $validators, "public://blog_listing", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('blog_page_header_bg', $file_url);
    }
 }
}
function other_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('other_page_header_bg_upload', $validators, "public://other_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('other_page_header_bg', $file_url);
    }
 }
}
function contact_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('contact_page_header_bg_upload', $validators, "public://contact_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('contact_page_header_bg', $file_url);
    }
 }
}
function login_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('login_page_header_bg_upload', $validators, "public://login_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('login_page_header_bg', $file_url);
    }
 }
}
function register_page_header_bg_validate($element, FormStateInterface $form_state){
  global $base_url;

  $validators = array('file_validate_extensions' => array('png gif jpg jpeg apng svg'));
  $file = file_save_upload('register_page_header_bg_upload', $validators, "public://register_page", NULL, FILE_EXISTS_REPLACE);

  if (!empty($file)) {
    // change file's status from temporary to permanent and update file database
    if ((is_object($file[0]) == 1)) {
      $file[0]->status = FILE_STATUS_PERMANENT;
      $file[0]->save();
      $uri = $file[0]->getFileUri();
      $file_url = file_create_url($uri);
      $file_url = str_ireplace($base_url, '', $file_url);
      $form_state->setValue('register_page_header_bg', $file_url);
    }
 }
}*/