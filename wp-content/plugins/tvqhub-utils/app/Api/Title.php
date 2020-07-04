<?php

namespace Tvqhub\Api;

use WP_REST_Response;

class Title extends BaseController
{
    public function handle()
    {
        return $this->ok(['title' => 'damn-so-good']);
    }
}
