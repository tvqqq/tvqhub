<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://tvqhub.com
 * @since      1.0.0
 *
 * @package    Tvqhub_Helper
 * @subpackage Tvqhub_Helper/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Tvqhub_Helper
 * @subpackage Tvqhub_Helper/includes
 * @author     TVQ <quyen@tvqhub.com>
 */
class Tvqhub_Helper_i18n
{


    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain()
    {

        load_plugin_textdomain(
            'tvqhub-helper',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );

    }


}
