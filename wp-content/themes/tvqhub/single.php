<?php
get_header();
?>

    <div class="container">
    <div class="row">
    <div id="primary" class="content-area col-12 col-lg-9 px-0 px-lg-2">
        <main id="main" class="site-main" role="main">
            <?php
            while (have_posts()) : the_post();
                get_template_part('template-parts/posts/detail', get_post_format());

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </main>
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
