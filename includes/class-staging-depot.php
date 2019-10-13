<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://duaneleem.com
 * @since      1.0.0
 *
 * @package    Staging_Depot
 * @subpackage Staging_Depot/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Staging_Depot
 * @subpackage Staging_Depot/includes
 * @author     Duane Leem <duane@leemfamily.com>
 */
class Staging_Depot {

  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      Staging_Depot_Loader    $loader    Maintains and registers all hooks for the plugin.
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $plugin_name    The string used to uniquely identify this plugin.
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
  protected $version;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function __construct() {
    if ( defined( 'STAGING_DEPOT_VERSION' ) ) {
      $this->version = STAGING_DEPOT_VERSION;
    } else {
      $this->version = '1.0.0';
    }
    $this->plugin_name = 'staging-depot';

    $this->load_dependencies();
    $this->set_locale();
    $this->define_admin_hooks();
    $this->define_public_hooks();

  }

  /**
   * Load the required dependencies for this plugin.
   *
   * Include the following files that make up the plugin:
   *
   * - Staging_Depot_Loader. Orchestrates the hooks of the plugin.
   * - Staging_Depot_i18n. Defines internationalization functionality.
   * - Staging_Depot_Admin. Defines all hooks for the admin area.
   * - Staging_Depot_Public. Defines all hooks for the public side of the site.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function load_dependencies() {

    /**
     * The class responsible for orchestrating the actions and filters of the
     * core plugin.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-staging-depot-loader.php';

    /**
     * The class responsible for defining internationalization functionality
     * of the plugin.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-staging-depot-i18n.php';

    /**
     * The class responsible for defining all actions that occur in the admin area.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-staging-depot-admin.php';

    /**
     * The class responsible for defining all actions that occur in the public-facing
     * side of the site.
     */
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-staging-depot-public.php';
    
    /**
     * EZRentOut Application
     */
    // Admin Product Fields
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/ezrentout/class-ezrentout-product-fields.php';
    // Front-End buttono changes.
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/ezrentout/class-ezrentout-product-buttons.php';

    $this->loader = new Staging_Depot_Loader();

  }

  /**
   * Define the locale for this plugin for internationalization.
   *
   * Uses the Staging_Depot_i18n class in order to set the domain and to register the hook
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function set_locale() {

    $plugin_i18n = new Staging_Depot_i18n();

    $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

  }

  /**
   * Register all of the hooks related to the admin area functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_admin_hooks() {

    $plugin_admin = new Staging_Depot_Admin( $this->get_plugin_name(), $this->get_version() );

    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

    // EZR Main Functions
    $ezrentout_product_fields = new Staging_Depot_EZRentOut_Product_Fields();
    
    // EZRentOut: Details in General Tab (Simple)
    $this->loader->add_action( "woocommerce_product_options_general_product_data", $ezrentout_product_fields, "add_field_details");
    $this->loader->add_action( "woocommerce_process_product_meta", $ezrentout_product_fields, "save_field_details");

    // EZRentOut: Add to Cart in General Tab (Simple)
    $this->loader->add_action( "woocommerce_product_options_general_product_data", $ezrentout_product_fields, "add_field_add_to_cart");
    $this->loader->add_action( "woocommerce_process_product_meta", $ezrentout_product_fields, "save_field_add_to_cart");

    // EZRentOut: ID in General Tab (Simple)
    $this->loader->add_action( "woocommerce_product_options_general_product_data", $ezrentout_product_fields, "add_field_ezr_id");
    $this->loader->add_action( "woocommerce_process_product_meta", $ezrentout_product_fields, "save_field_ezr_id");

    // EZRentOut: Item Type in General Tab (Simple)
    $this->loader->add_action( "woocommerce_product_options_general_product_data", $ezrentout_product_fields, "add_field_ezr_item_type");
    $this->loader->add_action( "woocommerce_process_product_meta", $ezrentout_product_fields, "save_field_ezr_item_type");

    // EZRentOut: Details Custom Field in Variations Tab
    $this->loader->add_action( "woocommerce_variation_options_pricing", $ezrentout_product_fields, "add_variations_field_details", 10, 3);
    $this->loader->add_action( "woocommerce_save_product_variation", $ezrentout_product_fields, "save_variations_field_details", 10, 2);
    $this->loader->add_action( "woocommerce_available_variation", $ezrentout_product_fields, "add_custom_field_variations_field_details");

    // EZRentOut: Add to Cart Custom Field in Variations Tab
    $this->loader->add_action( "woocommerce_variation_options_pricing", $ezrentout_product_fields, "add_variations_field_add_to_cart", 10, 3);
    $this->loader->add_action( "woocommerce_save_product_variation", $ezrentout_product_fields, "save_variations_field_add_to_cart", 10, 2);
    $this->loader->add_action( "woocommerce_available_variation", $ezrentout_product_fields, "add_custom_field_variations_field_add_to_cart");

    // EZRentOut: ID Custom Field in Variations Tab
    $this->loader->add_action( "woocommerce_variation_options_pricing", $ezrentout_product_fields, "add_variations_field_id", 10, 3);
    $this->loader->add_action( "woocommerce_save_product_variation", $ezrentout_product_fields, "save_variations_field_id", 10, 2);
    $this->loader->add_action( "woocommerce_available_variation", $ezrentout_product_fields, "add_custom_field_variations_field_id");
  }

  /**
   * Register all of the hooks related to the public-facing functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_public_hooks() {

    $plugin_public = new Staging_Depot_Public( $this->get_plugin_name(), $this->get_version() );

    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

    // Define EZR button change functionality.
    add_filter( 'woocommerce_is_purchasable', '__return_false'); // Disable WC Products
    $ezrentout_product_buttons = new Staging_Depot_EZRentOut_Product_Buttons();

    // EZRentOut Simple: WC to EZR Button
    $this->loader->add_action( "woocommerce_single_product_summary", $ezrentout_product_buttons, "change_to_ezr_simple_button", 30);

    // NOT IN USE - EZRentOut Variations: WC to EZR Button
    // Modifies: /plugins/woocommerce/templates/single-product/add-to-cart/variation.php
    // $this->loader->add_filter("woocommerce_available_variation", $ezrentout_product_buttons, "custom_load_variation_settings_products_fields");
    // $this->loader->add_action( "woocommerce_single_variation", $ezrentout_product_buttons, "change_to_ezr_variations_button", 30);

  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since    1.0.0
   */
  public function run() {
    $this->loader->run();
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     1.0.0
   * @return    string    The name of the plugin.
   */
  public function get_plugin_name() {
    return $this->plugin_name;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since     1.0.0
   * @return    Staging_Depot_Loader    Orchestrates the hooks of the plugin.
   */
  public function get_loader() {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     1.0.0
   * @return    string    The version number of the plugin.
   */
  public function get_version() {
    return $this->version;
  }

}
