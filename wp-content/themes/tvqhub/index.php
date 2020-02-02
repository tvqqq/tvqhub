<?php
get_header();
?>

    <div class="container">
    <div class="row">
    <div id="primary" class="content-area col-12 col-lg-8 px-0 px-lg-2">
        <main id="main" class="site-main" role="main">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    get_template_part('template-parts/posts/list');
                endwhile;
                bs_pagination();
            else :
                get_template_part('template-parts/posts/soon');
            endif; ?>
        </main>
    </div><!--#primary-->

<?php
get_sidebar();
get_footer();
