<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="card card-post-detail px-2 mb-5">
        <div class="card-body">
            <div class="arrow"></div>
            <h2 class="entry-title"><?php echo get_the_title() ?></h2>

            <div class="entry-meta mb-3">
                <time class="entry-date"
                      datetime="<?php echo esc_attr(get_the_date('c')) ?>"><?php echo esc_attr(get_the_date()) ?></time>
                <span>•</span>
                <?php $category = get_the_category(get_the_ID())[0];
                $tagsList = get_the_tag_list(null, ',&nbsp;'); ?>
                <a href="<?php echo esc_url(home_url('/category/') . $category->slug) ?>"><?php echo $category->name ?></a>
                <?php if ($tagsList) { ?>
                    • <i class="fas fa-tags"></i>
                    <span class="tags-links"><?php echo $tagsList ?></span>
                <?php } ?>
            </div>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <div class="entry-footer">
                <?php
                if (function_exists('postviews_related')) {
                    postviews_related();
                }
                if (function_exists('postviews_set')) {
                    postviews_set(get_the_ID());
                }
                ?>
            </div>
        </div>
    </div>
</article>
<!-- #post-## -->
