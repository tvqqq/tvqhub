<?php

namespace Tvqhub\Base;

class Menu
{
    public function register()
    {
        add_action('admin_menu', [$this, 'buildMenu']);
    }

    public function buildMenu()
    {
        add_menu_page('TVQhub Utils', 'TVQhub Utils', 'manage_options', 'tvqhub-utils', [$this, 'buildApp'], 'dashicons-rest-api');
    }

    public function buildApp()
    {
        echo '<div id="tvqhub-utils-app"><app></app></div>';
    }
}
