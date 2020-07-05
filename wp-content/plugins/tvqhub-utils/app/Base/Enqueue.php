<?php

namespace Tvqhub\Base;

class Enqueue
{
    public function register()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue($hook)
    {
        // Only load script inside this plugin
        if ($hook !== 'toplevel_page_tvqhub-utils') {
            return;
        }

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
                'base_url' => home_url('/') . 'wp-json/tvqhub-utils'
            ],
            'nonce' => wp_create_nonce('tvqhub-utils')
        ];
        wp_localize_script('tvqhub-utils-js', 'TvqhubJs', $data);
    }
}
