<?php

/**
 * Provide an additional variable to products.
 *
 * @link       https://duaneleem.com
 * @since      1.0.0
 *
 * @package    Staging_Depot
 * @subpackage Staging_Depot/admin/partials
 */

if (!class_exists("Staging_Depot_Product_Fields")) {
  /**
   * Adds a text input field to General tab.
   */
  function add_ezrentout_add_to_cart() {
    $args = array(
      'label' => 'EZRenOut Add to Cart', // Text in the label in the editor.
      'placeholder' => '', // Give examples or suggestions as placeholder
      'class' => '',
      'style' => '',
      'wrapper_class' => '',
      'value' => '', // if empty, retrieved from post_meta
      'id' => 'ezrentout_add_to_cart', // required, will be used as meta_key
      'name' => 'ezrentout_add_to_cart', // name will be set automatically from id if empty
      'type' => '',
      'desc_tip' => '',
      'data_type' => '',
      'custom_attributes' => '', // array of attributes you want to pass 
      'description' => ''
    );
    woocommerce_wp_text_input( $args );
  }
} // if (!class_exists("Staging_Depot_Product_Fields"))

// add_action( 'woocommerce_product_options_pricing', 'add_ezrentout_add_to_cart' );

?>


