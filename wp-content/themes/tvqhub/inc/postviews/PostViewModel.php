<?php

class PostViewModel
{
    const POST_VIEW_COUNT = 'tvqhub_post_view_count';

    /**
     * Set meta view value when viewing a post
     * @param $postId
     */
    public static function setPostView($postId)
    {
        $count = get_post_meta($postId, self::POST_VIEW_COUNT, true);
        if ($count) {
            $count = $count + 0.5; // TODO research loop 2 times
            update_post_meta($postId, self::POST_VIEW_COUNT, $count);
        } else {
            add_post_meta($postId, self::POST_VIEW_COUNT, 1);
        }
    }

    public static function getTotalViews()
    {
        global $wpdb;
        $sql = "SELECT SUM(meta_value) FROM wp_postmeta WHERE meta_key = 'tvqhub_post_view_count'";
        return $wpdb->get_var($sql);
    }

    public static function getTop10Posts()
    {
        return new WP_Query([
            'meta_key' => self::POST_VIEW_COUNT,
            'orderby' => 'meta_value_num',
            'post_type' => 'post',
            'posts_per_page' => 10,
            'ignore_sticky_posts' => 1
        ]);
    }

    public static function getRandomPosts()
    {
        return new WP_Query([
            'post_type' => 'post',
            'orderby' => 'rand',
            'posts_per_page' => 5,
            'ignore_sticky_posts' => 1
        ]);
    }

    public static function getRelatedPosts()
    {
        global $post;
        $cateIdArr = [];
        $categories = get_the_category($post->ID);
        foreach ($categories as $category) {
            $cateIdArr[] = $category->term_id;
        }
        return new WP_Query([
            'category__in' => $cateIdArr,
            'post__not_in' => [$post->ID],
            'posts_per_page' => 4,
            'ignore_sticky_posts' => 1,
        ]);
    }
}
