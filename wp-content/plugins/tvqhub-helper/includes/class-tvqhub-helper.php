<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://tvqhub.com
 * @since      1.0.0
 *
 * @package    Tvqhub_Helper
 * @subpackage Tvqhub_Helper/includes
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
 * @package    Tvqhub_Helper
 * @subpackage Tvqhub_Helper/includes
 * @author     TVQ <quyen@tvqhub.com>
 */
class Tvqhub_Helper
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Tvqhub_Helper_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $plugin_name The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The unique identifier of this plugin (display).
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $plugin_name_display The string used to uniquely identify this plugin.
     */
    protected $plugin_name_display;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
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
    public function __construct()
    {
        if (defined('TVQHUB_HELPER_VERSION')) {
            $this->version = TVQHUB_HELPER_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'tvqhub-helper';
        $this->plugin_name_display = 'TVQhub Helper';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

        add_action('admin_menu', [$this, 'registerAdminMenu']);
    }

    public function registerAdminMenu()
    {
        add_menu_page(
            $this->plugin_name_display,
            $this->plugin_name_display,
            'manage_options',
            $this->plugin_name, [$this, 'loadAdminDisplay'],
            'dashicons-star-empty'
        );
    }

    public function loadAdminDisplay()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/tvqhub-helper-admin-display.php';
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Tvqhub_Helper_Loader. Orchestrates the hooks of the plugin.
     * - Tvqhub_Helper_i18n. Defines internationalization functionality.
     * - Tvqhub_Helper_Admin. Defines all hooks for the admin area.
     * - Tvqhub_Helper_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-tvqhub-helper-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-tvqhub-helper-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-tvqhub-helper-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-tvqhub-helper-public.php';

        $this->loader = new Tvqhub_Helper_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Tvqhub_Helper_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {

        $plugin_i18n = new Tvqhub_Helper_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {

        $plugin_admin = new Tvqhub_Helper_Admin($this->get_plugin_name(), $this->get_version());
        if (strpos($_SERVER['REQUEST_URI'], $this->get_plugin_name()) !== false) {
            $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
            $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        }

    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {

        $plugin_public = new Tvqhub_Helper_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @return    string    The name of the plugin.
     * @since     1.0.0
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @return    Tvqhub_Helper_Loader    Orchestrates the hooks of the plugin.
     * @since     1.0.0
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @return    string    The version number of the plugin.
     * @since     1.0.0
     */
    public function get_version()
    {
        return $this->version;
    }

}