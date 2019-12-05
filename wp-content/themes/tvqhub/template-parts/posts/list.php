<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="card card-post mb-4">
        <div class="card-body">
            <div class="row no-gutters">

                <div class="col-12 col-md-3">
                    <div class="thumb mb-3 mb-md-0">
                        <a href="<?php the_permalink() ?>"
                           style="background:url(<?php the_post_thumbnail_url('full') ?>)no-repeat center center; display: block; height:100% ;background-size:cover"
                           class="thumb-hover">
                            <span class="thumb-overlay"></span>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-md-9 pl-md-3">
                    <h2 class="entry-title"><a
                            href="<?php echo esc_url(get_permalink()) ?>"><?php echo get_the_title() ?></a></h2>
                    <div class="entry-meta">
                        <time class="entry-date"
                              datetime="<?php echo esc_attr(get_the_date('c')) ?>"><?php echo esc_attr(get_the_date()) ?></time>
                        <span>•</span>
                        <?php $category = get_the_category(get_the_ID())[0] ?>
                        <a class="category-highlight"
                           href="<?php echo esc_url(home_url('/') . 'category/' . $category->slug) ?>"><?php echo $category->name ?></a>
                    </div>
                    <div class="entry-content mt-2">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<!-- #post-## -->
