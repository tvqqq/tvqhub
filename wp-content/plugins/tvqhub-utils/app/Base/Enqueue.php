<?php

namespace Tvqhub\Base;

class Enqueue
{
    public function register()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue()
    {
        // CSS
//        wp_enqueue_style(
//            'tvqhub-utils-css',
//            TVQHUB_UTILS_PLUGIN_URL . 'assets/scss/style.css',
//            null,
//            TVQHUB_UTILS_PLUGIN_VERSION
//        );

        // JS
        wp_enqueue_script(
            'tvqhub-utils-js',
            TVQHUB_UTILS_PLUGIN_URL . 'dist/bundle.js',
            null,
            TVQHUB_UTILS_PLUGIN_VERSION,
            true // Load JS in footer so that templates in DOM can be referenced.
        );

        // Add initial data to plugin so it can be rendered without fetch.
        $data = [
            'data' => [
                'test' => 'Test data'
            ],
            'nonce' => wp_create_nonce('tvqhub-utils')
        ];
        wp_localize_script('tvqhub-utils-js', 'TvqhubJs', $data);
    }
}