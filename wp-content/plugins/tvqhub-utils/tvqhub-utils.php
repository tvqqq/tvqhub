<?php

/**
 * Plugin Name: TVQhub Utils
 * Plugin URI: https://tvqhub.com
 * Description: TVQhub Utils is a helper WordPress plugin for some basic settings.
 * Version: 1.0.0
 * Author: Tat Vi Quyen
 * Author URI: https://tvqhub.com
 * License: GPL v3
 * Text Domain: tvqhub-utils
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * Version.
 */
if (!defined('TVQHUB_UTILS_PLUGIN_VERSION')) {
    define('TVQHUB_UTILS_PLUGIN_VERSION', '1.0.0');
}

/**
 * The code that runs during plugin activation
 */
function tvqhub_utils_activate_plugin()
{
    \Tvqhub\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'tvqhub_utils_activate_plugin');

/**
 * The code that runs during plugin deactivation
 */
function tvqhub_utils_deactivate_plugin()
{
    \Tvqhub\Base\Deactivate::deactivate();
}
register_activation_hook(__FILE__, 'tvqhub_utils_deactivate_plugin');

/**
 * Register services for plugin.
 */
\Tvqhub\Init::registerServices();
