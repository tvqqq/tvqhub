<?php

namespace Tvqhub\Api;

class Functions extends BaseController
{
    public function convertTitle($request)
    {
        $data = $request['data'];

        $url = 'https://hvtvvyct8h.execute-api.ap-southeast-1.amazonaws.com/default/convertTitleWp?title=' . $data['title'];
        $args = [
            'headers' => [
                'x-api-key' => $this->getOptions()['lambda_secret_key'] ?? null
            ]
        ];
        $result = wp_remote_get($url, $args);
        $body = json_decode($result['body']);
        if (!empty($body->message)) {
            return $this->fail($body->message);
        }

        return $this->ok($body);
    }
}
