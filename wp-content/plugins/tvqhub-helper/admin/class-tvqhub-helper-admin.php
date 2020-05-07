<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://tvqhub.com
 * @since      1.0.0
 *
 * @package    Tvqhub_Helper
 * @subpackage Tvqhub_Helper/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tvqhub_Helper
 * @subpackage Tvqhub_Helper/admin
 * @author     TVQ <quyen@tvqhub.com>
 */
class Tvqhub_Helper_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Tvqhub_Helper_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Tvqhub_Helper_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style('bs4_css', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css', array(), $this->version, 'all');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/tvqhub-helper-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Tvqhub_Helper_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Tvqhub_Helper_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script('bs4_script', plugin_dir_url(__FILE__) . 'js/bootstrap.bundle.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/tvqhub-helper-admin.js', array('jquery'), $this->version, false);

    }

}
