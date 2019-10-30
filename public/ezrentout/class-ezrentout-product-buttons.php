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
      $ezrItemType = $product->get_meta( 'ezrentout_item_type' );
      $ezrID = $product->get_meta( 'ezrentout_id' );

      $headboardOffer = $product->get_attribute('headboard');

      // Formulate the EZRentOut Details button.
      $styleCSS = "margin-right: 14px;";
      switch (strtolower($ezrItemType)) {
      case "item":
        $anchorTag_addToCart = "<a class='single_add_to_cart_button button' style='{$styleCSS}' id='ezr-cart-widget-item-{$ezrID}' onclick='ezrAddItemToCartDialog({$ezrID}, this)' href='#_'>Add To Cart</a>";
        $anchorTag_calendar  = "<a class='single_add_to_cart_button button' style='{$styleCSS}' id='ezr-cart-widget-item-{$ezrID}' onclick='ezrLoadCalendarDialog({$ezrID}, this)' href='#_'>Availability Calendar</a>";
        $anchorTag_details   = "<a class='single_add_to_cart_button button' style='{$styleCSS}' id='ezr-cart-widget-item-{$ezrID}' onclick='ezrShowAssetDetails({$ezrID}, this)' href='#_'>Item Detail</a>";
        //$anchorTag_calByName = "<a class='single_add_to_cart_button button' style='{$styleCSS}' onclick='ezrLoadCalendarDialog({$ezrID}, this, {availabilityByName: true})' href='#_'>Availability by Name</a>";
        break;
      case "bundle":
        $anchorTag_addToCart = "<a class='single_add_to_cart_button button' style='{$styleCSS}' id='ezr-cart-widget-bundle-{$ezrID}' onclick='ezrAddBundleToCartDialog(\'{$ezrID}-b\', this)' href='#_'>Add To Cart</a>";
        $anchorTag_calendar  = "";
        $anchorTag_details   = "<a class='single_add_to_cart_button button' style='{$styleCSS}' id='ezr-cart-widget-bundle-{$ezrID}' onclick='ezrShowBundleDetails(\'{$ezrID}-b\', this)' href='#_'>Item Detail</a>";
        break;
      }
      if ($ezrID) {
        //echo "<div style='margin-bottom: 1em;'>{$anchorTag_addToCart}{$anchorTag_calendar}{$anchorTag_details}{$anchorTag_calByName}</div>";
        echo "<div style='margin-bottom: 1em;'>{$anchorTag_addToCart}{$anchorTag_calendar}{$anchorTag_details}</div>";
      }

      //this is just for debug purposes
      //echo "headboard offer: {$headboardOffer}<br/>";

      //check if the headboard attribute is set, and if it is, lets get all the products that correspond.
      if ($headboardOffer) {
        $headboardOfferedProducts = wc_get_products(array('title' => $headboardOffer));

        foreach ($headboardOfferedProducts as $hbKey => $hbProduct) {
          $hbP_ezrItemType = $hbProduct->get_meta( 'ezrentout_item_type' );
          $hbP_ID = $hbProduct->get_meta( 'ezrentout_id' );
          $hbP_anchorTag_addToCart = "<a class='single_add_to_cart_button button' style='{$styleCSS}' id='ezr-cart-widget-bundle-{$hbP_ID}' onclick='ezrAddBundleToCartDialog(\'{$hbP_ID}-b\', this)' href='#_'>Add {$headboardOffer} To Cart</a>";
          //this is just for debug purposes
          //echo "<pre>" . print_r($hbProduct->id, true) . "</pre>";
          //echo "<pre>" . $hbP_ezrItemType . "</pre>";
          //echo "<pre>" . $hbP_ID . "</pre>";
        }
        echo "
          <blockquote title='Headboard Offer'>
            <small>
              <p>Based on your selection, unless you have your own boxspring & mattress, you will need to pick \"Bed setup\" based on the size of the headboard.</p>
              <p>We do NOT use inflatables, as in the past, too many times Stagers have had to return to the property to re-inflate.</p>
              <p>We use instead a combination of lightweight supports, portable frames, and mattresses.  You just supply the bed sheets.</p>
            </small>
          </blockquote>
          {$hbP_anchorTag_addToCart}
        ";
      } //headboardOffer
    } // change_to_ezr_details_button()

    public function custom_load_variation_settings_products_fields( $variations ) {
      $variations['ezrentout_variations_id'] = get_post_meta( $variations[ 'variation_id' ], '_text_field', true );
      return $variations;
    }

  } // Staging_Depot_EZRentOut_Product_Buttons
} // if (!class_exists("Staging_Depot_EZRentOut_Product_Buttons"))
