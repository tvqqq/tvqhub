<?php
get_header();
?>

    <div class="container">
    <div class="row">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            while (have_posts()) : the_post(); ?>
                <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1 class="page-title"><?php the_title(); ?></h1><!--TODO: option display title or not-->
                    <div class="entry-content"><?php the_content(); ?></div>
                </article><!-- #post-## -->

                <?php
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
