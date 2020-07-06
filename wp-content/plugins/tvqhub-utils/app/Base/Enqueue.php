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
        if ($hook !== 'toplevel_page_' . Constants::HYPHEN_NAME) {
            return;
        }

        wp_enqueue_script(
            Constants::HYPHEN_NAME . '-js',
            TVQHUB_UTILS_PLUGIN_URL . 'dist/bundle.js',
            null,
            TVQHUB_UTILS_PLUGIN_VERSION,
            true // Load JS in footer so that templates in DOM can be referenced.
        );

        // Add initial data to plugin so it can be rendered without fetch.
        $data = [
            'data' => [
                'base_url' => home_url('/') . 'wp-json/' . Constants::HYPHEN_NAME
            ]
        ];
        wp_localize_script(Constants::HYPHEN_NAME . '-js', 'WpvrJs', $data);
    }
}
