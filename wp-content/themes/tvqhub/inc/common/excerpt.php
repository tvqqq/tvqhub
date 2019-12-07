<?php

add_filter('excerpt_more', function () {
    global $post;
    return '<a class="more-link" href="' . get_permalink($post->ID) . '">... <i class="fas fa-angle-double-right"></i></a>';
});

add_filter('excerpt_length', function () {
    return 35;
});
