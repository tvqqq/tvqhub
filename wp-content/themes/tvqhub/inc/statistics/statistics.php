<?php

function tvqhub_statistics()
{
    $since = '2019-12-17';
    return [
        'since' => $since,
        'days' => tvqhub_stat_get_days($since),
        'posts' => wp_count_posts()->publish,
        'views' => _roundThousand(PostViewModel::getTotalViews()),
    ];
}

function tvqhub_stat_get_days($since)
{
    $startDate = date_create($since);
    $today = date_create(date('Y-m-d'));
    return date_diff($startDate, $today)->days;
}

function _roundThousand($num)
{
    if ($num > 1000) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int)$x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        return $x_display;
    }
    return $num;
}
