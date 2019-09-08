<?php

/**
 * Changes the buttons to use EZRentOut's anchor tags.
 *
 * @link       https://duaneleem.com
 * @since      1.0.0
 *
 * @package    Staging_Depot
 * @subpackage Staging_Depot/public/ezrentout
 */


if (!class_exists("Staging_Depot_EZRentOut_Product_Buttons")) {
  class Staging_Depot_EZRentOut_Product_Buttons {
    /**
     * EZR Simple : Changes simple buttons from WC to EZR.
     */
    public function change_to_ezr_simple_button() {
      global $post;

      // Grab which product is being viewed.
      $product = wc_get_product( $post->ID );
      $ezr_anchor_tag = $product->get_meta( 'ezrentout_add_to_cart' );
      $ezrID = substr($ezr_anchor_tag, -1);

      // Formulate the EZRentOut Details button.
      if ($ezr_anchor_tag) {
        echo "<div>
          <a class='single_add_to_cart_button button' href='#_' id='" . $ezr_anchor_tag . "' onclick='ezrShowAssetDetails(" . $ezrID . ", this)' style='margin-bottom: 1.618em; margin-right: 14px;'>View Details</a>
          <a class='single_add_to_cart_button button' id='" . $ezr_anchor_tag . "' onclick='ezrAddItemToCartDialog(" . $ezrID . ", this)' href='#_'>Add To Cart</a>
        </div>";
      }
    } // change_to_ezr_details_button()

    /**
     * EZR Variations: Changes variations button from WC to EZR.
     */
    public function change_to_ezr_add_to_cart_button() {
      global $post;

      // Grab which product is being viewed.
      
    } // change_to_ezr_add_to_cart_button()
  } // Staging_Depot_EZRentOut_Product_Buttons
} // if (!class_exists("Staging_Depot_EZRentOut_Product_Buttons"))