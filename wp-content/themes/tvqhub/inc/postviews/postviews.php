<?php

function postviews_set($postId)
{
    PostViewModel::setPostView($postId);
}

function postviews_top10()
{
    $posts = PostViewModel::getTop10Posts();
    echo '<h3 class="sidebar-title"><span>Top 10</span></h3>';
    echo '<div class="sidebar-posts-list">';
    while ($posts->have_posts()) {
        $posts->the_post();
        include(locate_template('inc/postviews/v-sidebar-post.php'));
    }
    echo '</div>';
    wp_reset_postdata();
}

function postviews_random()
{
    $posts = PostViewModel::getRandomPosts();
    echo '<h3 class="sidebar-title"><span>Random</span></h3>';
    echo '<div class="sidebar-posts-list">';
    while ($posts->have_posts()) {
        $posts->the_post();
        include(locate_template('inc/postviews/v-sidebar-post.php'));
    }
    echo '</div>';
    wp_reset_postdata();
}

function postviews_related()
{
    $posts = PostViewModel::getRelatedPosts();
    echo '<div class="related-posts">';
    echo '<div class="title"><i class="fas fa-layer-group"></i>&nbsp;Related Posts</div>';
    echo '<div class="row my-2 p-0 p-md-2 mx-auto">';
    while ($posts->have_posts()) {
        $posts->the_post();
        include(locate_template('inc/postviews/v-related-post.php'));
    }
    echo '</div></div>';
    wp_reset_postdata();
}
