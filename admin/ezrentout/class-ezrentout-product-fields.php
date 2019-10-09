<?php

/**
 * Provide an additional variables to products.
 *
 * @link       https://duaneleem.com
 * @since      1.0.0
 *
 * @package    Staging_Depot
 * @subpackage Staging_Depot/admin/ezrentout
 */

if (!class_exists("Staging_Depot_EZRentOut_Product_Fields")) {
  class Staging_Depot_EZRentOut_Product_Fields {
    /**
     * EZRentOut - Details Custom Field
     * Step 1: Display Text Field
     */
    public function add_field_details() {
      $args = array(
        'label' => 'EZR Anchor: Details', // Text in the label in the editor.
        'placeholder' => 'ezr-cart-widget-item-304', // Give examples or suggestions as placeholder
        'class' => 'short',
        'style' => '',
        'wrapper_class' => '',
        'id' => 'ezrentout_details', // required, will be used as meta_key
        'type' => '',
        'desc_tip' => false,
        'data_type' => '',
        'custom_attributes' => '', // array of attributes you want to pass 
        'description' => 'The anchor tags provided by EZRentOut.'
      );
      woocommerce_wp_text_input( $args );
    } // add_field_details()

    /**
     * EZRentOut - Details Custom Field
     * Step 2: Save Field
     */
    public function save_field_details( $post_id ) {
      // grab the content value
      $content = isset( $_POST[ 'ezrentout_details' ] ) ? sanitize_text_field( $_POST[ 'ezrentout_details' ] ) : '';
      
      // grab the product
      $product = wc_get_product( $post_id );
      
      // save the custom content meta field
      $product->update_meta_data( 'ezrentout_details', $content );
      $product->save();
    }
    
    /**
     * EZRentOut - Add to Cart Custom Field
     * Step 1: Display Text Field
     */
    public function add_field_add_to_cart() {
      $args = array(
        'label' => 'EZR Anchor: Add to Cart', // Text in the label in the editor.
        'placeholder' => 'ezr-cart-widget-item-304', // Give examples or suggestions as placeholder
        'class' => 'short',
        'style' => '',
        'wrapper_class' => '',
        'id' => 'ezrentout_add_to_cart', // required, will be used as meta_key
        'type' => '',
        'desc_tip' => false,
        'data_type' => '',
        'custom_attributes' => '', // array of attributes you want to pass 
        'description' => 'The anchor tags provided by EZRentOut.'
      );
      woocommerce_wp_text_input( $args );
    }

    /**
     * EZRentOut - Add to Cart Custom Field
     * Step 2: Save Field
     */
    public function save_field_add_to_cart( $post_id ) {
      // grab the SKU value
      $content = isset( $_POST[ 'ezrentout_add_to_cart' ] ) ? sanitize_text_field( $_POST[ 'ezrentout_add_to_cart' ] ) : '';
      
      // grab the product
      $product = wc_get_product( $post_id );
      
      // save the custom SKU meta field
      $product->update_meta_data( 'ezrentout_add_to_cart', $content );
      $product->save();
    }

    /**
     * EZRentOut - EZR ID Custom Field
     * Step 1: Display Text Field
     */
    public function add_field_ezr_id() {
      $args = array(
        'label' => 'EZR Anchor: ID', // Text in the label in the editor.
        'placeholder' => '304', // Give examples or suggestions as placeholder
        'class' => 'short',
        'style' => '',
        'wrapper_class' => '',
        'id' => 'ezrentout_id', // required, will be used as meta_key
        'type' => '',
        'desc_tip' => false,
        'data_type' => '',
        'custom_attributes' => '', // array of attributes you want to pass 
        'description' => 'Last digits from EZR anchor tags.'
      );
      woocommerce_wp_text_input( $args );
    }

    /**
     * EZRentOut - EZR ID Custom Field
     * Step 2: Save Field
     */
    public function save_field_ezr_id( $post_id ) {
      // grab the SKU value
      $content = isset( $_POST[ 'ezrentout_id' ] ) ? sanitize_text_field( $_POST[ 'ezrentout_id' ] ) : '';
      
      // grab the product
      $product = wc_get_product( $post_id );
      
      // save the custom SKU meta field
      $product->update_meta_data( 'ezrentout_id', $content );
      $product->save();
    }

    /**
     * EZRentOut - Item Type, Select Single Item or Bundle
     * Step 1: Display Select Field
     */
    public function add_field_ezr_item_type() {
      $args = array(
        'label' => 'EZR Item Type', // Text in the label in the editor.
        'placeholder' => '304', // Give examples or suggestions as placeholder
        'class' => 'short',
        'style' => '',
        'wrapper_class' => '',
        'id' => 'ezrentout_item_type', // required, will be used as meta_key
        'type' => '',
        'desc_tip' => false,
        'data_type' => '',
        'custom_attributes' => '', // array of attributes you want to pass 
        'description' => 'Select if the EZR ID is for a single item, or a bundle',
        'options' => array(
          ''   => __( '- Select -', 'woocommerce' ),
          'item'   => __( 'Item', 'woocommerce' ),
          'bundle'   => __( 'Bundle', 'woocommerce' )
        )
      );
      woocommerce_wp_select( $args );
    }

    /**
     * EZRentOut - Item Type, Select Single Item or Bundle
     * Step 2: Save Field
     */
    public function save_field_ezr_item_type( $post_id ) {
      // grab the select value
      $content = isset( $_POST[ 'ezrentout_item_type' ] ) ? sanitize_text_field( $_POST[ 'ezrentout_item_type' ] ) : '';
      
      // grab the product
      $product = wc_get_product( $post_id );
      
      // save the custom SKU meta field
      $product->update_meta_data( 'ezrentout_item_type', $content );
      $product->save();
    }

  } // Staging_Depot_EZRentOut_Product_Fields
} // if (!class_exists("Staging_Depot_EZRentOut_Product_Fields"))
