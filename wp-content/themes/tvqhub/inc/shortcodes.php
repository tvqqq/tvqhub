<?php

/**
 * Register shortcode here !!!
 */
$shortcodes = [

    'tvqhub' => 'common/v-tvqhub-label',
    'qod' => 'qod/v-qod',
    'statistics' => 'statistics/v-statistics',
    'tvqhub_me' => 'pages/me',
    'tvqhub_contact' => 'pages/contact',
    '581a' => '581a/v-581a',
    'ama' => 'ama/v-ama'

];

/**
 * Add shortcode with file view
 */
foreach ($shortcodes as $key => $value) {
    add_shortcode($key, fn() => render($value));
}

/**
 * Render view by using shortcode on WP.
 * @param $view
 * @return false|string
 */
function render($view)
{
    ob_start();
    get_template_part('inc/' . $view);
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}
