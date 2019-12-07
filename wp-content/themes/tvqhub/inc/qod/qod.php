<?php
add_action('wp', function () {
    if (!wp_next_scheduled('tvqhub_cron_rest_qod')) {
        wp_schedule_event(strtotime('00:05:00'), 'daily', 'tvqhub_cron_rest_qod');
    }
});

add_action('tvqhub_cron_rest_qod', 'tvqhub_rest_qod');
function tvqhub_rest_qod()
{
    $json = file_get_contents('https://quotes.rest/qod.json');
    $obj = json_decode($json, true);
    $quotes = $obj['contents']['quotes'][0];

    if ((int)$quotes['length'] > 255) {
        return;
    }

    global $wpdb;
    $table = $wpdb->prefix . 'qod';
    $data = [
        'quote' => $quotes['quote'],
        'author' => $quotes['author'],
        'date' => $quotes['date'],
    ];
    $wpdb->insert($table, $data);
}

function tvqhub_get_data_qod()
{
    global $wpdb;
    $table = $wpdb->prefix . 'qod';
    $sql = "SELECT * FROM {$table} ORDER BY RAND() LIMIT 1";
    $result = $wpdb->get_row($sql);
    return $result;
}
