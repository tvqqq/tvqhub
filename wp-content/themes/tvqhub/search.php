<?php
get_header();
?>

    <div class="container">
    <div class="row">
        <section id="primary" class="content-area col-12">
            <main id="main" class="site-main" role="main">
                <?php
                if (have_posts()) : ?>
                    <h3 class="text-muted border-bottom pb-3 mb-4">
                        <?php printf(_x('<i class="fas fa-search"></i> Searching: <b>%s</b>', 'tvqwp'), '<span class="text-info">' . get_search_query() . '</span>'); ?>
                    </h3>
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('template-parts/posts/list');
                    endwhile;
                    bs_pagination();
                else :
                    get_template_part('template-parts/posts/none');
                endif; ?>
            </main>
        </section>
    </div>

<?php
get_footer();
