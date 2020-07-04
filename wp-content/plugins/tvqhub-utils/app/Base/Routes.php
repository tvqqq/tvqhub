<?php

namespace Tvqhub\Base;

use Tvqhub\Api\Title;
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
            [
                'slug' => 'title',
                'method' => WP_REST_Server::READABLE,
                'callback' => [new Title(), 'handle']
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
        $version = '1';
        $namespace = 'tvqhub-utils/v' . $version;
        foreach (self::routes() as $route) {
            register_rest_route($namespace, '/' . $route['slug'], [
                [
                    'methods' => $route['method'],
                    'callback' => $route['callback'],
                ]
            ]);
        }
    }
}
