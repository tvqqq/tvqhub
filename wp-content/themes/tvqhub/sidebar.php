<div class="col-12 col-lg-4" id="sidebar">
    <aside id="secondary" class="widget-area" role="complementary">
        <?php
        if (is_home()) { ?>
            <div class="home-sidebar">
                <?php if (function_exists('postviews_top10')) {
                    postviews_top10();
                }
                ?>

                <i class="fas fa-ellipsis-h my-3 text-muted text-center d-block"></i>

                <div class="sidebar-qod">
                    <?php echo do_shortcode('[qod]') ?>
                </div>
                <div class="statistics m-3">
                    <?php echo do_shortcode('[statistics]') ?>
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
