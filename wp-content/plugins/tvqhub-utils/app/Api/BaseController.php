<?php

namespace Tvqhub\Api;

use WP_Error;
use WP_REST_Response;

class BaseController
{
    /**
     * Return OK.
     * @param $data
     * @return WP_REST_Response
     */
    public function ok($data)
    {
        return new WP_REST_Response(['success' => true, 'data' => $data], 200);
    }

    /**
     * Return not OK.
     * @param $message
     * @return WP_REST_Response
     */
    public function fail($message)
    {
        return new WP_REST_Response(['success' => false, 'message' => $message], 500);
    }
}
