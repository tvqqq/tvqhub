<div class="col-12 col-lg-4" id="sidebar">
    <aside id="secondary" class="widget-area" role="complementary">
        <?php
        if (is_home()) { ?>
            <div class="home-sidebar">
                <?php if (function_exists('postviews_top10')) {
                    postviews_top10();
                }
                ?>
                <div class="mt-2 text-muted text-center">
                    <i class="fas fa-ellipsis-h"></i>
                </div>
                <div class="widget-border-event mt-3">
                    <?php echo do_shortcode('[qod]') ?>
                </div>
            </div>
            <?php
        } else { ?>
            <div class="post-sidebar">
                <?php if (function_exists('postviews_random')) {
                    postviews_random();
                }
                ?>
            </div>
        <?php } ?>
    </aside>
</div>
