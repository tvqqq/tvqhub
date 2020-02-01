<div class="sidebar-post">
    <a href="<?php the_permalink() ?>">
        <div class="sidebar-post-image"
             style="background:url(<?php the_post_thumbnail_url() ?>) 50% 50% no-repeat; background-size:cover;">
            <small>
                <i class="far fa-eye"></i>&nbsp;
                <?php echo number_format(get_post_meta(get_the_ID(), PostViewModel::POST_VIEW_COUNT, true)) ?>
            </small>
        </div>
        <div class="sidebar-post-title"><?php the_title() ?></div>
    </a>
    <div class="clearfix"></div>
</div>
