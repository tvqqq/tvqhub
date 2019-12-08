<?php

function tvqhub_statistics()
{
    $since = '2019-12-01';
    return [
        'since' => $since,
        'days' => tvqhub_stat_get_days($since),
        'posts' => wp_count_posts()->publish,
        'views' => PostViewModel::getTotalViews(),
    ];
}

function tvqhub_stat_get_days($since)
{
    $startDate = date_create($since);
    $today = date_create(date('Y-m-d'));
    return date_diff($startDate, $today)->days;
}
