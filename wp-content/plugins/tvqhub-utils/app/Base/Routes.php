<?php

namespace Tvqhub\Base;

use Tvqhub\Api\Functions;
use Tvqhub\Api\Home;
use WP_REST_Server;

class Routes
{
    /**
     * Defines all routes of application here.
     * @return array[]
     */
    private function routes()
    {
        return [
            // Home
            [
                'slug' => 'home',
                'method' => 'GET',
                'callback' => [new Home(), 'index']
            ],
            [
                'slug' => 'home',
                'method' => 'POST',
                'callback' => [new Home(), 'store']
            ],
            [
                'slug' => 'title',
                'method' => 'POST',
                'callback' => [new Functions(), 'convertTitle']
            ],
            // ...
            [
                'slug' => 'clean-up',
                'method' => 'GET',
                'callback' => [new Functions(), 'cleanUpDb']
            ],
        ];
    }

    public function register()
    {
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }

    /**
     * Register the routes for the objects of the controller.
     */
    public function registerRoutes()
    {
        foreach (self::routes() as $route) {
            register_rest_route(Constants::HYPHEN_NAME, '/' . $route['slug'], [
                [
                    'methods' => $route['method'],
                    'callback' => $route['callback'],
                ]
            ]);
        }
    }
}
