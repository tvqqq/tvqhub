<?php

if (!function_exists('tvqhub_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function tvqhub_setup()
    {
        // Hide admin bar
        add_filter('show_admin_bar', '__return_false');

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on tvqhub, use a find and replace
         * to change 'tvqhub' to the name of your theme in all the template files.
         */
        load_theme_textdomain('tvqhub', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => __('Primary Menu'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }
endif;
add_action('after_setup_theme', 'tvqhub_setup');

/**
 * Enqueue scripts and styles.
 */
add_action('wp_enqueue_scripts', 'tvqhub_enqueue_scripts');
function tvqhub_enqueue_scripts()
{
    // Bootstrap 4
    wp_enqueue_style('bs-style', get_template_directory_uri() . '/vendor/bootstrap/bootstrap.min.css');
    wp_enqueue_script('bs-script', get_template_directory_uri() . '/vendor/bootstrap/bootstrap.bundle.min.js', array('jquery'));

    // Fontawesome
    wp_enqueue_style('fa', get_template_directory_uri() . '/vendor/fontawesome/css/all.min.css');

    // Google Fonts
    wp_enqueue_style('ggfonts', '//fonts.googleapis.com/css?family=Open+Sans:400,700');

    // Animate.css
    wp_enqueue_style('animate', get_template_directory_uri() . '/vendor/animate/animate.min.css');

    // Sharethis
    wp_enqueue_script('sharethis', 'https://platform-api.sharethis.com/js/sharethis.js#property=5dec7b5e2e495700120c8448&product=inline-share-buttons#asyncload');

    // Base css & js
    wp_enqueue_style('tvqhub', get_stylesheet_uri());
    wp_enqueue_script('tvqhub-js', get_template_directory_uri() . '/assets/js/script.js', array('jquery'));
}

/**
 * Javascript for old browser IE 8,7,6.
 */
add_action('wp_head', 'ie_scripts');
function ie_scripts()
{
    echo '<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->';
    echo '<!-- WARNING: Respond.js doesn\'t work if you view the page via file:// --> ';
    echo '<!--[if lt IE 9]>';
    echo '<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
    echo '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
    echo '<![endif]-->';
}

// Include all PHP files in folder /inc
function includeInc($dir, $depth = 0)
{
    $scan = glob("{$dir}/*");
    foreach ($scan as $path) {
        // TODO: combine 2 regex
        if (preg_match('/\.php$/', $path) && !preg_match('/v-.*$/', basename($path))) {
            require_once $path;
        } elseif (is_dir($path)) {
            includeInc($path, $depth + 1);
        }
    }
}

includeInc(get_template_directory() . '/inc');

add_filter('clean_url', 'tvqhub_async_load', 11, 1);
function tvqhub_async_load($url)
{
    if (strpos($url, '#asyncload') === false) {
        return $url;
    } else if (is_admin()) {
        return str_replace('#asyncload', '', $url);
    } else {
        return str_replace('#asyncload', '', $url) . "' async='async";
    }
}
