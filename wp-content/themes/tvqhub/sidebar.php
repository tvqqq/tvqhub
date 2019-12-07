<div class="col-12 col-lg-4" id="sidebar">
    <aside id="secondary" class="widget-area" role="complementary">
        <?php
        if (is_home()) { ?>
            <div class="home-sidebar">
                <?php if (function_exists('postviews_top10')) {
                    postviews_top10();
                }
                ?>
                <div class="my-3 text-muted text-center">
                    <i class="fas fa-ellipsis-h"></i>
                </div>
                <div class="sidebar-qod">
                    <?php echo do_shortcode('[qod]') ?>
                </div>
                <div class="statistics m-3">
                    <div class="row no-gutters">
                        <div class="col">
                            <div class="card border-info">
                                <div class="card-body text-center p-2">
                                    <h4><strong>10</strong></h4>
                                    <h5>days</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col mx-2">
                            <div class="card border-primary">
                                <div class="card-body text-center p-2">
                                    <h4><strong>10</strong></h4>
                                    <h5>posts</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card border-success">
                                <div class="card-body text-center p-2">
                                    <h4><strong>10</strong></h4>
                                    <h5>views</h5>
                                </div>
                            </div>
                        </div>
                    </div>
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
