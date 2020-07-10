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
    /**
     * Clean up database by remove revision posts.
     *
     * @return \WP_REST_Response
     */
    public function cleanUpDb()
    {
        global $wpdb;
        $sql = 'DELETE a,b,c FROM wp_posts a LEFT JOIN wp_term_relationships b ON (a.ID = b.object_id) LEFT JOIN wp_postmeta c ON (a.ID = c.post_id) WHERE a.post_type = "revision"';
        $result = $wpdb->query($sql);
        return $this->ok($result);
    }
}
